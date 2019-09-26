<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdministratorRequest;
use App\Http\Requests\AdministratorUpdateProfile;
use App\Notifications\NewAdmin;
use Illuminate\Support\Str;
use App\User;

class AdministratorController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:administradores.create')->only(['create', 'store']);
        $this->middleware('can:administradores.index')->only('index');
        $this->middleware('can:administradores.edit')->only(['edit', 'update']);
        $this->middleware('can:administradores.show')->only('show');
        $this->middleware('can:administradores.destroy')->only('destroy');
    }


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
        return view('admin.administrators.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('admin.administrators.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdministratorRequest $request
     * @return Response
     */
    public function store(AdministratorRequest $request)
    {

        //Password aleatorio que se envía al usuario antes de encriptar
        $temp_password = Str::random(6);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($temp_password),
        ]);

        $user->temp_pass = $temp_password;
        $user->assignRoles($request['rol']);

        $user->notify(new NewAdmin($user));
        return redirect()
            ->route('administradores.index')
            ->with('info', 'Administrador registrado, accesos enviados exitosamente.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        return view('admin.administrators.edit', compact('roles', 'user'));
    }


    public function editAdminProfile()
    {
        return view('admin.administrators.edit-profile', ['user' => Auth::User()]);
    }

    public function updateAdminProfile(AdministratorUpdateProfile $request, User $user)
    {
        $u = User::findOrFail($user->id);
        $u->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $u->change_password = true;
        $u->save();
        return redirect()
            ->route('admin.profile')
            ->with('info', 'Datos editados exitosamente.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param AdministratorRequest $request
     * @param User $user
     * @return void
     */
    public function update(AdministratorRequest $request, User $user)
    {
        $u = User::findOrFail($user->id);

        if ($u->id == 1) {
            $typeMsg = 'error';
            $msg = 'No se puede editar este administrador.';
        } else {
            $typeMsg = 'info';
            $msg = 'Administrador actualizado exitosamente.';

            $u->update([
                'status' => $request['status'] ? true : false,
            ]);
            $u->syncRoles($request['rol']);
        }
        return redirect()
            ->route('administradores.index')
            ->with($typeMsg, $msg);
    }


    /**
     * Cambia el status del usuario
     * @param int $id
     * @return Response
     */
    public function changeUserStatus($id)
    {
        $u = User::findOrFail($id);

        if ($u->id == 1) {
            $typeMsg = 'error';
            $msg = 'No se puede editar este administrador.';
        } else {
            $typeMsg = 'info';
            $msg = 'Administrador actualizado exitosamente.';

            $currentStatus = $u->status;
            $u->update([
                'status' => !$currentStatus,
            ]);
        }

        return redirect()
            ->route('administradores.index')
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
            $msg = 'No se puede editar este administrador.';
        } else {
            $u->delete();
            $typeMsg = 'info';
            $msg = 'El administrador ha sido eliminado exitosamente.';
        }

        return redirect()
            ->route('administradores.index')
            ->with($typeMsg, $msg);
    }
}
