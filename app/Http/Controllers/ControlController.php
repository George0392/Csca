<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Control;
use App\User;
use App\Order;
use App\OrderService;
use App\Service;

class ControlController extends Controller
{
    public function inicio()
    {
        $controls = Control::where('id_desc', '=', 1)
                    ->where('caja_abierta', '=', 1)
                    ->get();
        $titulo = "Listado de caja inicial";
        
        return view('control.caja.inicio', compact('controls', 'titulo'));
    }

    public function cierre()
    {
        \DB::table('controls')
            ->where('caja_abierta', 1)
            ->update(['caja_abierta' => 0]);

        return redirect()->route('control.caja.inicio');
    }

    public function retiros()
    {
        $controls = \DB::table('controls')
                    ->where('caja_abierta', 1)
                    ->where('id_desc', '=', 6)
                    ->get();

        $titulo = "Retiros del día";
        return view('control.caja.retiros', compact('controls', 'titulo'));
    }

    public function historial_retiros(Request $request)
    {
        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', 6)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();
        
        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Retiros desde el " . $desde . " hasta el " . $hasta;
        
        return view('control.caja.retiros', compact('controls', 'titulo'));
    }

    public function gastos()
    {
        if (\Request::is('*/limpieza')) 
        { 
            $nombre = "limpieza"; $id_desc = 3;  
        }
        else if(\Request::is('*/servicios'))
        {
            $nombre = "servicios"; $id_desc = 4;
        }
        else if(\Request::is('*/mercaderias'))
        {
            $nombre = "mercaderias"; $id_desc = 7;
        }
        else {}
          
        $controls = \DB::table('controls')
                    ->where('caja_abierta', 1)
                    ->where('id_desc', '=', $id_desc)
                    ->get();
                    
        $titulo = "Gastos de " . $nombre . " del día";
        
        return view('control.gastos.index', compact('controls', 'titulo', 'nombre', 'id_desc'));
    }

    public function historial_gastos(Request $request)
    {
        if (\Request::is('*/limpieza'))
        {
            $nombre = "limpieza"; $id_desc = 3;
        }
        else if(\Request::is('*/servicios'))
        { 
            $nombre = "servicios"; $id_desc = 4; 
        }
        else if(\Request::is('*/mercaderias'))
        { 
            $nombre = "mercaderias"; $id_desc = 7; 
        }
        else {}

        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();
        
        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Gastos de " . $nombre . " desde " . $desde . " hasta " . $hasta;
        
        return view('control.gastos.index', compact('controls', 'titulo', 'nombre'));
    }

    public function sueldos()
    {
        if (\Request::is('*/profesores')) 
        { 
            $tipo = "profesores";  
            $id_desc = 3;  
        }
        else if(\Request::is('*/otros'))
        {
            $tipo = "otros empleados";
            $id_desc = 4;
        }
        else {}
          
        $users = \DB::table('users')->select('id', 'profesor_id', 'servicio_id')->get();
        $trainers = \DB::table('trainers')->select('id','nombre')->orderBy('id')->get();
        $services = \DB::table('services')->select('id','monto')->get();

        $titulo = "Sueldos de " . $tipo;
        
        return view('control.sueldos.profesores', compact('users', 'titulo', 'tipo', 'trainers', 'services'));
    }

    public function historial_sueldos_all(Request $request)
    {
        if (\Request::is('*/profesores'))
        {
            $tipo = "profesores"; $id_desc = 5;
        }
        else if(\Request::is('*/otros'))
        { 
            $tipo = "otros empleados"; $id_desc = 5; 
        }
        else {}

        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();
        
        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Sueldos de " . $tipo . " desde " . $desde . " hasta " . $hasta;
        
        return view('control.sueldos.profesores', compact('controls', 'titulo', 'tipo'));
    }

    public function historial_sueldos_one(Request $request, $nombre)
    {
        if (\Request::is('*/profesores/*'))
        {
            $tipo = "profesores";
            $id_desc = 5;
        }
        else if(\Request::is('*/otros'))
        { 
            $id_desc = 5;
            $tipo = "otros";
        }
        else {}

        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->where('detalle', 'like', '%'.$nombre.'%')
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();
        
        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Historial de sueldos para " . $nombre . " desde " . $desde . " hasta " . $hasta;
        
        return view('control.sueldos.profesores', compact('controls', 'titulo', 'nombre', 'tipo'));
    }

    public function ordenes()
    {
        if (\Request::is('*/productos')) 
        { 
            $tipo = "productos";
            $id_type = 1;
        }
        else if(\Request::is('*/servicios'))
        {
            $tipo = "servicios";
            $id_type = 2;
        }
        $orders = \DB::table('orders')->where('id_type', $id_type)->where('deHoy', 1)->get();
        $empleados = \DB::table('users')->select('id', 'nombre')->where('id_uType', 2)->orderBy('nombre')->get();
        $clientes = \DB::table('users')->select('id', 'nombre')->where('id_uType', 3)->orderBy('nombre')->get();
        $titulo = "Ingresos por " . $tipo . " del día";
        
        return view('control.ingresos.index', compact('titulo', 'tipo', 'empleados', 'clientes', 'id_type', 'orders'));
    }

    public function store_orden(Request $request)
    {
        $order = Order::create([
            'id_empleado' => $request['id_empleado'],
            'id_cliente' => $request['id_cliente'],
            'id_type' => $request['id_type'],
            'monto' => $request['monto'],
            'desc' => $request['monto'],
            'completada' => $request['monto'],
            'deHoy' => $request['deHoy']
        ]);
        
        $id_order = $order->id;
        
        switch ($request['id_type']) 
        {
            case '1':
                return redirect()->route('control.ingresos.productos.agregar', compact('id_order'));
                break;
            
            case '2':
                return redirect()->route('control.ingresos.servicios.agregar', compact('id_order'));
                break;
            
            default:
                # code...
                break;
        }
    }

    public function subordenes($id_order)
    {
        if (\Request::is('*/productos/*')) 
        { 
            $tipo = "productos";
            $id_type = 1;
        }
        else if(\Request::is('*/servicios/*'))
        {
            $tipo = "servicios";
            $id_type = 2;
            $servicios = \DB::table('services')->get();
            $orders_indiv = \DB::table('orders_services')->where('id_order', $id_order)->get();
        }
        
        $order = Order::find($id_order);
        if ($order!=null) 
        {
            $empleado = User::find($order->id_empleado);
            $cliente = User::find($order->id_cliente);
            $subtitulo = "Cliente: " . $cliente->nombre . " | Empleado: " . $empleado->nombre;
        }
        else {
            $subtitulo = "La orden todavía no existe";
        }
        
        $titulo = "Orden #" . $id_order;
        
        return view('control.ingresos.create', compact('titulo', 'subtitulo', 'tipo', 'id_type', 'id_order', 'order', 'servicios', 'orders_indiv'));
    }

    public function store_suborden(Request $request, $id_order)
    {
        if (\Request::is('*/productos/*')) 
        { 
            //falta la logica
            return redirect()->route('control.ingresos.productos', compact('id_order'));
        }
        else if(\Request::is('*/servicios/*'))
        {
            $id = $request->id_servicio;
            $service = Service::find($id);
            $monto = $service->monto;
            
            OrderService::create([
                'id_order' => $request['id_order'],
                'id_servicio' => $request['id_servicio'],
                'detalle' => $request['detalle'],
                'monto' => $monto
            ]);
            
            \DB::table('orders')->increment('monto', $monto);
            
            return redirect()->route('control.ingresos.servicios.agregar', compact('id_order'));
        }
    }

    public function descuento_orden(Request $request, $id_order)
    {
        $desc = $request->desc;
        
        \DB::table('orders')->where('id', $id_order)->update(['desc' => $desc]);
        
        if (\Request::is('*/productos/*')) 
        { 
            return redirect()->route('control.ingresos.productos.agregar', compact('id_order'));
        }
        else if(\Request::is('*/servicios/*'))
        {
            return redirect()->route('control.ingresos.servicios.agregar', compact('id_order'));
        }
    }

    public function cerrar_orden($id_order)
    {
        \DB::table('orders')->where('id', $id_order)->update(['completada' => 1]);
        
        if (\Request::is('*/productos/*')) 
        { 
            return redirect()->route('control.ingresos.productos.agregar', compact('id_order'));
        }
        else if(\Request::is('*/servicios/*'))
        {
            return redirect()->route('control.ingresos.servicios.agregar', compact('id_order'));
        }
    }

    public function historial_ingresos(Request $request)
    {
        $id_desc = 2;
        $tipo = "ingresos";
        
        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();
        
        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Historial de " . $tipo . " desde " . $desde . " hasta " . $hasta;
        
        return view('control.caja.ingresos', compact('controls', 'titulo', 'tipo'));
    }

    public function historial_ingreso(Request $request, $nombre)
    {
        $id_desc = 2;
        $tipo = "ingresos";
        
        $desde = $request->desde;
        $hasta = $request->hasta;
        $controls = \DB::table('controls')
                    ->where('id_desc', '=', $id_desc)
                    ->where('detalle', 'like', '%'.$nombre.'%')
                    ->whereBetween('created_at', [$desde, $hasta])
                    ->get();
        
        $desde = date('d/m/y', strtotime($desde));
        $hasta = date('d/m/y', strtotime($hasta));
        $titulo = "Historial de " . $tipo . " para " . $nombre . " desde " . $desde . " hasta " . $hasta;
        
        return view('control.caja.ingresos', compact('controls', 'titulo', 'tipo'));
    }

    public function store(Request $request)
    {
        Control::create([
            'admin' => $request['admin'],
            'monto' => $request['monto'],
            'id_desc' => $request['id_desc'],
            'detalle' => $request['detalle'],
            'caja_abierta' => $request['caja_abierta']
        ]);
        
        switch ($request['id_desc']) 
        {
            case '1':
                return redirect()->route('control.caja.inicio');
                break;
            
            case '2':
                $paid_at = $request->paid_at;
                $id = $request->id;
                
                \DB::table('users')->where('id', $id)->update(['paid_at' => $paid_at]);
                
                return redirect()->route('control.caja.ingresos');
                break;
            
            case '3':
                return redirect()->route('control.gastos.limpieza');
                break;
            
            case '4':
                return redirect()->route('control.gastos.servicios');
                break;
            
            case '5':
                return redirect()->route('control.sueldos.profesores');// SUELDOS O 2 DE EMPLEADOS?
                break;
            
            case '6':
                return redirect()->route('control.caja.retiros');
                break;
            
            case '7':
                return redirect()->route('control.gastos.mercaderias');
                break;
            
            default:
                # code...
                break;
        }
    }
}
