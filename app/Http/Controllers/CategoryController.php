<?php

namespace App\Http\Controllers;


use App\Actions\Category\CreateCategoryAction;
use App\Actions\Category\DetroyCategoryAction;
use App\Actions\Category\GetAllCategoriesAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Actions\Category\GetCategoryWithCoursesAction;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index(GetAllCategoriesAction $action)
    {
        $categories = $action->execute();
        return Inertia::render('Category/Index', ['categories' => $categories]);
    }

    public function create()
    {
        return Inertia::render('Category/CreateEdit');
    }


    public function store(CreateCategoryRequest $request, CreateCategoryAction $action)
    {
        $action->execute($request->validated());
        return redirect()->route('categories.index')->with('message', 'Category created successfully.');
    }

    public function edit(Category $category, GetCategoryWithCoursesAction $action)
    {
        $category = $action->execute($category);

        return Inertia::render('Category/CreateEdit', ['category' => $category]);
    }


    public function update(UpdateCategoryRequest $request, Category $category, UpdateCategoryAction $action)
    {

        $category = $action->execute($category, $request->validated());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category, DetroyCategoryAction $action)
    {
        $action->execute($category);
        return redirect()->route('categories.index')->with('message', 'Category deleted successfully.');
    }






}
