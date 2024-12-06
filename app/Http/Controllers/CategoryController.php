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
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{

    /**
     * @param GetAllCategoriesAction $action
     * @return \Inertia\Response
     */
    public function index(GetAllCategoriesAction $action): Response
    {
        $categories = $action->execute();

        return Inertia::render('Category/Index', ['categories' => $categories]);
    }


    /**
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Category/CreateEdit');
    }


    /**
     * @param CreateCategoryRequest $request
     * @param CreateCategoryAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateCategoryRequest $request, CreateCategoryAction $action): RedirectResponse
    {
        $action->execute($request->validated());

        return redirect()->route('categories.index')->with('message', 'Category created successfully.');
    }


    /**
     * @param Category $category
     * @param GetCategoryWithCoursesAction $action
     * @return \Inertia\Response
     */
    public function edit(Category $category, GetCategoryWithCoursesAction $action): Response
    {
        $category = $action->execute($category);

        return Inertia::render('Category/CreateEdit', ['category' => $category]);
    }


    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @param UpdateCategoryAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category, UpdateCategoryAction $action): RedirectResponse
    {

        $category = $action->execute($category, $request->validated());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    /**
     * @param Category $category
     * @param DetroyCategoryAction $action
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category, DetroyCategoryAction $action): RedirectResponse
    {
        $action->execute($category);

        return redirect()->route('categories.index')->with('message', 'Category deleted successfully.');
    }






}
