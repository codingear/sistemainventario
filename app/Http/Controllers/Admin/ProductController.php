<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ImageRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::where('status', 'ACTIVO')->orWhere('status', 'INACTIVO')
            ->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $images = Image::query()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.products.create', compact('categories', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        // $product = Product::create($request->all());
        // return response()->json($product);
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
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request['name'],
            'sku' => $request['sku'],
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'stock' => $request['stock'],
            'sale_price' => $request['sale_price']
        ]);

        return response()->json(['success' => 'Producto Editado correctamente.']);
    }


    /**
     * Cambia el status del producto
     * @param int $id
     * @return Response
     */
    public function changeProductStatus($id)
    {
        $product = Product::findOrFail($id);
        if ($product->status == 'ACTIVO') {
            $product->update([
                'status' => 'INACTIVO'
            ]);
            $msg = 'Producto Desactivado exitosamente.';
        } else if ($product->status == 'INACTIVO') {
            $product->update([
                'status' => 'ACTIVO'
            ]);
            $msg = 'Producto activado exitosamente.';
        }

        return redirect()
            ->route('productos.index')
            ->with('info', $msg);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'status' => 'ELIMINADO'
        ]);
        return redirect()->route('productos.index')
            ->with('info', 'Producto Eliminado exitosamente.');
    }
}
