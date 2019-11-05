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
        $images = Image::query()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.images.index', compact('images'));
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
    public function store(Request $request)
    {
        $urlImage = $request->file('image')->store('images_library');
        $image = Image::create([
            'url' => Storage::url($urlImage),
        ]);
        return response()->json($image);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::findOrFail($id);
        return response()->json($image);
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
    public function update(ImageRequest $request, $id)
    {
        try {
            $image = Image::findOrFail($id);
            $image->update([
                'title' => $request['title'],
                'text_alt' => $request['text_alt'],
            ]);
            return response()->json(['msg' => 'El registro se ha editado correctamente.',]);
        } catch (\Exception $ex) {
            return response('No se pudo crear, intente mas tarde', 500)
                ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $image = Image::findOrFail($id);
        $image->delete();
        unlink(public_path($image->url));
        return response()->json(['success' => 'Imagen eliminada correctamente.']);
    }
}
