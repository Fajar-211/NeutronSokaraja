<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->get();
        return view('category', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoryCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Validator::make($request->all(),[
            'category' => 'required|string|unique:'.Category::class
        ],[
            'required' => 'Category wajib diisi',
            'unique' => 'Category sudah ada',
            'string' => 'Hanya string'
        ])->validate();
        if($request->category == 'kelas besar'){
                $color = 'red';
            }else{
                $color = 'blue';
            }
        Category::create([
            'category' => $request->category,
            'slug' => Str::slug($request->category),
            'color' => $color
        ]);
        return redirect('category')->with(['berhasil' => 'Category berhasil ditambah']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $kelas = Kelas::where('category_id', '=', $category->id)->get();
        if(count($kelas) != 0){
            return redirect('category')->with(['berhasil' => 'Sistem secara otomatis menjaga integritas data kelas. Saat ini anda tidak diiznikan untuk menghapus kategori kelas']);
        }
        $category->delete();
        return redirect('category')->with(['berhasil' => 'Category berhasil dihapus']);
    }
}
