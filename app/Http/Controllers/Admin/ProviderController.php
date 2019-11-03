<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderRequest;
use App\Provider;
use App\State;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.providers.index', compact('providers'));
    }
    public function getProviders(Request $request){
        $providers = Provider::get();
        if($request->ajax()) {
            return response()->json($providers);
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::query()
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.providers.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        Provider::create($request->all());
        return response()->json(['success' => 'Proveedor creado correctamente.']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provider = Provider::findOrFail($id);
        return view('admin.providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $states = State::query()
            ->orderBy('name', 'asc')
            ->get();
        $provider = Provider::findOrFail($id);
        return view('admin.providers.edit', compact('states', 'provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request, $id)
    {
        $provider = Provider::findOrFail($id);

        $provider->update([
            'name' => $request['name'],
            'contact_name' => $request['contact_name'],
            'rfc' => $request['rfc'],
            'telephone' => $request['telephone'],
            'email' => $request['email'],
            'website' => $request['website'],
            'state_id' => $request['state_id'],
            'city' => $request['city'],
            'website' => $request['website'],
            'zip_code' => $request['zip_code'],
            'address' => $request['address'],
            'notes' => $request['notes'],
        ]);

        return response()->json(['success' => 'Proveedor Editado correctamente.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $provider = Provider::findOrFail($id);
            $provider->delete();
            return response()->json([
                'msg' => 'Registro Eliminado',
                'id' => $id
            ]);
        }catch(\Exception $ex){
            return response('No se pudo eliminar intente mas tarde', 400)
                    ->header('Content-Type', 'text/plain');
        }
    }
}
