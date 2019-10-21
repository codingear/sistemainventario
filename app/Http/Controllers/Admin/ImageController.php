<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {

        if ($request->hasFile('imageProduct')) {
            $image = $request->file('imageProduct')->store('products');

            Image::create([
                'url' => Storage::url($image),
                'is_principal' => $request['is_principal'] === 'true' ? 1 : 0,
                'product_id' => $product->id
            ]);

            return response()->json(['success' => 'Imagen recibida']);
        } else {
            return response()->json(['error' => 'Imagen No guardada']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//Borra la imagen antigua de la carpeta
        $oldImage = Image::findOrFail($request->id);
        unlink(public_path($oldImage->url));

        $image = Image::findOrFail($request->id);

        if ($request->hasFile('imageProduct')) {
            $urlImage = $request->file('imageProduct')->store('products');


            $image->update([
                'url' => Storage::url($urlImage),
            ]);


            return response()->json(['success' => 'Imagen Actualizada']);
        } else {
            return response()->json(['error' => 'Imagen No Actualizada']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $image = Image::findOrFail($request->id);
        $image->delete();
        unlink(public_path($image->url));
        return response()->json(['success' => 'Imagen eliminada correctamente.']);
    }
}
