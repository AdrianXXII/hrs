<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AdminStoreCategoryPostRequest as StoreCategoryPostRequest;

class CategoriesController extends Controller
{
    public function index(Category $categories)
    {
        $categories = $categories->all()->where('active', true);
        return view('backend.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function edit(Category $category)
    {
        return view('backend.categories.edit',compact('category'));
    }

    public function update(StoreCategoryPostRequest $request, Category $category)
    {

        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->number_of_beds = $request->get('number_of_beds');

        $category->update();

        return redirect(route('backend.categories.index'));
    }

    public function store(StoreCategoryPostRequest $request)
    {
        (new Category([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'number_of_beds' => $request->get('number_of_beds'),
            'active' => 1
        ]))->save();

        return redirect(route('backend.categories.index'));
    }

    public function destroy(Category $category)
    {
        $category->deactivate();

        return back();
    }
}