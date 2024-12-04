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
    /**
     * Show the categories page.
     *
     * @param GetAllCategoriesAction $action
     * @return \Inertia\Response
     */
    public function index(GetAllCategoriesAction $action)
    {
        $categories = $action->execute();
        return Inertia::render('Category/Index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Category/CreateEdit');
    }


    /**
     * Store a newly created category in storage.
     *
     * @param  \App\Http\Requests\Category\CreateCategoryRequest  $request
     * @param  \App\Actions\Category\CreateCategoryAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCategoryRequest $request, CreateCategoryAction $action)
    {
        $action->execute($request->validated());
        return redirect()->route('categories.index')->with('message', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  \App\Models\Category  $category
     * @param  \App\Actions\Category\GetCategoryWithCoursesAction  $action
     * @return \Inertia\Response
     */
    public function edit(Category $category, GetCategoryWithCoursesAction $action)
    {
        $category = $action->execute($category);

        return Inertia::render('Category/CreateEdit', ['category' => $category]);
    }


    /**
     * Update the specified category in storage.
     *
     * @param  \App\Http\Requests\Category\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @param  \App\Actions\Category\UpdateCategoryAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category, UpdateCategoryAction $action)
    {

        $category = $action->execute($category, $request->validated());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  \App\Models\Category  $category
     * @param  \App\Actions\Category\DetroyCategoryAction  $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category, DetroyCategoryAction $action)
    {
        $action->execute($category);
        return redirect()->route('categories.index')->with('message', 'Category deleted successfully.');
    }






}
