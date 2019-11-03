<?php

namespace App\Http\Controllers\Admin;

use App\Image;
use App\Product;
use App\Category;
use App\ProductImage;
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

        $products = Product::where('status', 'Publicado')->orWhere('status', 'Inactivo')
            ->get();
        return view('admin.products.index', compact('products'));
    }

    public function getProducts(Request $request){
        $products = Product::with(['category','image'])->where('status', 'Publicado')->orWhere('status', 'Inactivo')->get();
        if($request->ajax()) {
            return response()->json($products);
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

        // foreach($request->gallery as  $item){
        //     echo $item['key'];
        // }
        // dd($request->gallery);

        $product = Product::create(
            [
                'name' => $request['name'],
                'sku' => $request['sku'],
                'description' => $request['description'],
                'category_id' => $request['category_id'],
                'stock' => $request['stock'],
                'sale_price' => $request['sale_price'],
                'principal_image' => $request['principal_image']
            ]
        );
        foreach($request->gallery as  $item){
            ProductImage::create(
                [
                    'product_id' => $product->id,
                    'image_id' => $item['key']
                ]
            );
        }

        // $product = Product::create($request->all());
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $images = Image::query()
            ->orderBy('created_at', 'asc')
            ->get();
        return view('admin.products.edit', compact('categories', 'product' , 'images'));
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
            'sale_price' => $request['sale_price'],
            'principal_image' => $request['principal_image']
        ]);

        ProductImage::where('product_id', $id)->delete();
        foreach($request->gallery as  $item){
            ProductImage::create(
                [
                    'product_id' => $product->id,
                    'image_id' => $item['key']
                ]
            );
        }
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
        if ($product->status == 'Publicado') {
            $product->update([
                'status' => 'Inactivo'
            ]);
            $msg = 'Producto Desactivado exitosamente.';
        } else if ($product->status == 'Inactivo') {
            $product->update([
                'status' => 'Publicado'
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
    public function destroy($id){
        try{
            $product = Product::findOrFail($id);
            $product->update([
                'status' => 'ELIMINADO'
            ]);
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
