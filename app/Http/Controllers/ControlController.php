<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Control;
use App\User;

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
            $nombre = "limpieza";  
            $id_desc = 3;  
        }
        else if(\Request::is('*/servicios'))
        {
            $nombre = "servicios";
            $id_desc = 4;
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

    public function ingresos()
    {
        $tipo = "socios";
        $users = \DB::table('users')->select('id', 'nombre', 'servicio_id', 'created_at', 'paid_at')->orderBy('id')->get();
        $services = \DB::table('services')->select('id','nombre','monto')->get();

        $titulo = "Cuotas de " . $tipo;
        
        return view('control.caja.ingresos', compact('users', 'titulo', 'tipo', 'services'));
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
            
            default:
                # code...
                break;
        }
    }
}
