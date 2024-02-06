<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        return view('Categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('addcat', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages= $this->messages();
        $data = $request->validate([
            'categoryname'=>'required|string',
        ], $messages);

        Category::create($data);
        return 'your category has been added';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
        $category = Car::findOrFail($id);
        return view('cat',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('editcat',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages= $this->messages();
        $data = $request->validate([
            'categoryname'=>'required|string',
        ], $messages);

        Category::where('id', $id)->update($data);
        return 'Updated';

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id):RedirectResponse
    {
        Category::where('id', $id)->delete();
        return redirect('Categories');
    }
}
