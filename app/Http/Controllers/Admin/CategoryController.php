<?php

namespace App\Http\Controllers\Admin;


use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:categorias.create')->only(['create', 'store']);
        $this->middleware('can:categorias.index')->only('index');
        $this->middleware('can:categorias.edit')->only(['edit', 'update']);
        $this->middleware('can:categorias.show')->only('show');
        $this->middleware('can:categorias.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::query()
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function getCategories(Request $request){
        $categories = Category::query()->orderBy('id', 'asc')->get();
        if($request->ajax()) {
            return response()->json($categories);
        }else{
            abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create([
            'name'          => $request['name'],
            'description'   => $request['description'],
        ]);

        return redirect()
            ->route('categorias.index')
            ->with('info', 'Categoría registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest
     * @param  int  $id
     * @return Response
     */
    public function update(CategoryRequest $request, $id)
    {

        $category = Category::findOrFail($id);
        $category->update([
            'name'          => $request['name'],
            'description'   => $request['description'],
            'status'        => $request['status'] ? 'Publicado' : 'Inactivo',
        ]);

        return redirect()
            ->route('categorias.index')
            ->with('info', 'Categoría editada exitosamente.');
    }


    /**
     * Cambia el status de la categoría
     * @param int $id
     * @return Response
     */
    public function changeCategoryStatus($id)
    {
        $category = Category::findOrFail($id);

        $currentStatus = $category->status;
        $category->update([
            'status' => !$currentStatus,
        ]);

        return redirect()
            ->route('categorias.index')
            ->with('info', 'Categoría editada exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try{
            $category = Category::findOrFail($id);
            $category->delete();
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
