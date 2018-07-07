<?php
//fer
namespace App\Http\Controllers;

use App\User;
use App\UserType;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $id_uType = UserType::where('nombre', $type)->first()->id;
        //dd($id_uType);
        $users = User::all()->where('id', '!=', 1)->where('id_uType', $id_uType);
        
        return view('users.index', compact('users', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        //$type_id = \DB::table('user_types')->where('nombre', $type)->value('id');
        $userType = UserType::where('nombre', $type)->first();
        
        return view('users.create', compact('type','userType'));
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
            'telefono' => $request['telefono'],
            'email' => $request['email'],
            'direccion' => $request['direccion'],
            'nacimiento' => $request['nacimiento'],
            'id_uType' => $request['id_uType'],
            'password' => bcrypt($request['password'])
        ]);
        
        $id_uType = $request->id_uType;
        $userType = UserType::find($id_uType);
        $type = $userType->nombre;

        return redirect()->route('users.index', compact('type'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type, $nombre)
    {
        $user = User::where('nombre', $nombre)->first();
        //dd($type);
        if ($user == null) 
        {
            return view('errors.404');
        }

        return view('users.show', compact('user', 'type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($type, $nombre)
    {
        $user = User::where('nombre', $nombre)->first();
        return view('users.edit', compact('user', 'type'));
    }

    public function update($type, User $user)
    {
        //dd($user);
        $data = request()->validate([
            'nombre' => 'required',
            'telefono' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'direccion' => 'required',
            'nacimiento' => 'required',
            'password' => 'required',
            'id_uType' => 'required',
        ]);
        
        $data['password'] = bcrypt($data['password']);
        //dd($data);
        $user->update($data);
        
        $users = User::all()->where('id_uType', $data['id_uType']);

        return redirect()->route('users.index', compact('type'));
    }

    public function delete($type, User $user)
    {
        $user->delete();
        return redirect()->route('users.index', compact('type'));
    }
}