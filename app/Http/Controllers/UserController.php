<?php
//fer
namespace App\Http\Controllers;

use App\User;
use App\Trainer;
use App\Service;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $trainers = Trainer::all();
        $services = Service::all();
        
        $titulo = "Listado de Socios";

        return view('users.index', compact('users','titulo','trainers','services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trainers = Trainer::all();
        $services = Service::all();
        
        return view('users.create', compact('trainers','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create([
            'nombre' => $request['nombre'],
            'username' => $request['username'],
            'profesor_id' => $request['profesor_id'],
            'servicio_id' => $request['servicio_id'],
            'email' => $request['email'],
            'direccion' => $request['direccion'],
            'inicio' => $request['inicio'],
            'nacimiento' => $request['nacimiento'],
            'dni' => $request['dni'],
            'edad' => $request['edad'],
            'peso' => $request['peso'],
            'altura' => $request['altura'],
            'password' => bcrypt($request['password'])
        ]);
        
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $trainers = Trainer::all(['id', 'nombre']);
        $services = Service::all();

        if ($user == null) 
        {
            return view('errors.404');
        }

        return view('users.show', compact('user', 'trainers', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $trainers = Trainer::all(['id', 'nombre']);
        $services = Service::all();

        return view('users.edit', compact('user', 'trainers', 'services'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'nombre' => 'required',
            'username' => 'required',
            'profesor_id' => 'required',
            'servicio_id' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'direccion' => 'required',
            'inicio' => 'required',
            'nacimiento' => 'required',
            'dni' => 'required',
            'edad' => 'required',
            'peso' => 'required',
            'altura' => 'required',
            'password' => 'required',
        ]);
        
        $data['password'] = bcrypt($data['password']);
        
        $user->update($data);
        
        //return redirect("admin/socios/{$user->id}/editar");
        return redirect("/admin/socios/");
        
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect('/admin/socios/');
    }
}