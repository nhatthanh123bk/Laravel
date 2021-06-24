<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\CategoriesFormRequest;


class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories')); 
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(CategoriesFormRequest $request)
    {
        $categories = new Category(array(
            'name' => $request->get('name'),
        ));
        $categories->save();
        return redirect('/admin/categories/create')->
        with('status', 'A new category has been created successfully!');
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
