<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Str;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::query()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {

        //Password aleatorio que se envía al usuario antes de encriptar
        $temp_password = Str::random(8);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            //'password' => Hash::make($temp_password),
            'password' => Hash::make($request['password']),
        ]);

        $user->assignRoles($request['rol']);

        return redirect()
            ->route('usuarios.index')
            ->with('info', 'El usuario ha sido agregado exitosamente.');
    }
    //
    //    /**
    //     * Display the specified resource.
    //     *
    //     * @param  $id
    //     * @return void
    //     */
    //    public function show($id)
    //    {
    //        //
    //    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        return view('admin.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return void
     */
    public function update(Request $request, User $user)
    {

        $u = User::findOrFail($user->id);

        if ($u->id == 1) {
            $typeMsg = 'error';
            $msg = 'No se puede editar este usuario.';
        } else {
            $typeMsg = 'info';
            $msg = 'El usuario ha sido exitado exitosamente.';

            $u->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'status' => $request['status'] ? true : false,
            ]);
            $u->syncRoles($request['rol']);
        }
        return redirect()
            ->route('usuarios.index')
            ->with($typeMsg, $msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $u = User::findOrFail($id);

        if ($u->id == 1) {
            $typeMsg = 'error';
            $msg = 'No se puede editar este usuario.';
        } else {
            $u->delete();
            $typeMsg = 'info';
            $msg = 'El usuario ha sido exitado exitosamente.';
        }

        return redirect()
            ->route('usuarios.index')
            ->with($typeMsg, $msg);
    }
}
