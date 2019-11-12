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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

//use Laravolt\Avatar\Avatar;


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
        $roles = Role::all()->take(2);
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
        try {
            //Password aleatorio que se envía al usuario antes de encriptar
            $temp_password = Str::random(6);

            $basePath = "/img/profile_avatar";
            $avatarName = (str_replace(" ", "_", $request['name'])) . '_avatar';
            $avatar = \Avatar::create($request['name'])->getImageObject()->encode('png');
            Storage::put('profile_avatar/' . $avatarName . '.png', (string)$avatar);
            $avatar_url = $basePath . '/' . $avatarName . '.png';

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($temp_password),
                'avatar' => $avatar_url
            ]);


            $user->temp_pass = $temp_password;
            $user->assignRoles($request['rol']);

            $user->notify(new NewAdmin($user));

            return response()->json(['msg' => 'El registro se ha creado correctamente.',]);
        } catch (\Exception $ex) {
            return response('No se pudo crear, intente mas tarde', 500)
                ->header('Content-Type', 'text/plain');
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        $roles = Role::all()->take(2);
        return view('admin.administrators.edit', compact('roles', 'user'));
    }


    public function editAdminProfile()
    {
        return view('admin.administrators.edit-profile', ['user' => Auth::User()]);
    }

    public function updateAdminProfile(AdministratorUpdateProfile $request)
    {

        try {
            $user = User::findOrFail(Auth::User()->id);
            $password = '';
            $changedPassword = false;
            if ($request['password'] == null) {
                $password = Auth::User()->password;
            } else {
                $password = Hash::make($request['password']);
                $changedPassword = true;
            }

            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $password,
                'change_password' => $changedPassword
            ]);


            return response()->json(['msg' => 'El registro se ha editado correctamente.']);
        } catch (\Exception $ex) {
            return response('No se pudo editar, intente mas tarde', 400)
                ->header('Content-Type', 'text/plain');
        }
    }

    public function updateAvatarAdministrator(Request $request)
    {
        try {
            $user = Auth::User();
            unlink(public_path($user->avatar));
            $urlAvatar = $request->file('avatar')->store('profile_avatar');
            $user->update([
                'avatar' => Storage::url($urlAvatar),
            ]);
            return response()->json(['msg' => 'El registro se ha editado correctamente.']);
        } catch (\Exception $ex) {
            return response('No se pudo editar, intente mas tarde', 400)
                ->header('Content-Type', 'text/plain');
        }
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
        try {
            $u = User::findOrFail($user->id);

            if ($u->id == 1) {
                $msg = 'No se puede editar este administrador.';
            } else {
                $msg = 'El registro se ha editado correctamente.';

                $u->update([
                    'status' => $request['status'] ? true : false,
                ]);
                $u->syncRoles($request['rol']);
            }

            return response()->json(['msg' => $msg]);
        } catch (\Exception $ex) {
            return response('No se pudo editar, intente mas tarde', 400)
                ->header('Content-Type', 'text/plain');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $u = User::findOrFail($id);

            if ($u->id == 1) {
                $msg = 'No se puede eliminar este administrador.';
            } else {
                $u->delete();
                $msg = 'El registro se ha eliminado correctamente';
            }
            return response()->json(['msg' => $msg]);
        } catch (\Exception $ex) {
            return response('No se pudo eliminar, intente mas tarde', 400)
                ->header('Content-Type', 'text/plain');
        }
    }
}
