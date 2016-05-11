<?php

namespace Hlacos\LaraMvcms\Http\Controllers\Blog;

use Illuminate\Http\Request;
use Hlacos\LaraMvcms\Models\Category;
use Hlacos\LaraMvcms\Http\Controllers\LaraMvcmsController;

class CategoryController extends LaraMvcmsController
{
    public function __construct()
    {
        $this->middleware('lara-mvcms.has-permission:manage-categories');
    }

    public function index(Request $request)
    {
        $size = $request->input('size') ?: config()->get('lara-mvcms.defaults.per-page');
        $categories = Category::paginate($size);

        return view('lara-mvcms::blog.categories.index')
            ->with('categories', $categories);
        }

    public function create(Request $request)
    {
        $category = new Category;

        $categories = Category::all();

        return view('lara-mvcms::blog.categories.create')
            ->with('category', $category)
            ->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $defaultLocale = config('translatable.fallback_locale');

        $this->validate($request, [
            "{$defaultLocale}.slug" => "required|alpha_dash|unique:page_translations,slug",
            //TODO add slug uniqueness in all language
            "{$defaultLocale}.title" => "required",
            "{$defaultLocale}.description" => "required",
        ]);

        if ($request->has('parent_id')) {
            $parentCategory = Category::find($request->input("parent_id"));
            $category = $parentCategory->children()->create($request->except(['_token', 'parent_id']));
        } else {
            $category = Category::create($request->except(['_token']));
        }

        $request->session()->flash('success', trans('lara-mvcms::categories.create-success'));

        return redirect()->route('lara-mvcms.blog.categories.index');
    }

    public function edit($categoryId)
    {
        $category = Category::find($categoryId);
        if (!$category) {
            abort(404);
        }

        $categories = Category::where('id', '<>', $categoryId)->get();

        return view('lara-mvcms::blog.categories.edit')
            ->with('category', $category)
            ->with('categories', $categories);
    }

    public function update(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);
        if (!$category) {
            abort(404);
        }

        $defaultLocale = config('translatable.fallback_locale');

        $this->validate($request, [
            "{$defaultLocale}.slug" => "required|alpha_dash|unique:page_translations,slug,{$category->translate($defaultLocale)->id}",
            //TODO add slug uniqueness in all language
            "{$defaultLocale}.title" => "required",
            "{$defaultLocale}.description" => "required",
        ]);

        $category->update($request->except(['_token', '_method', 'parent_id']));

        if ($request->input("parent_id") != $category->parent_id) {
            if ($request->has("parent_id")) {
                $parentCategory = Category::find($request->input("parent_id"));
                $catgory->makeChildOf($parentCategory);
            } else {
                $category->makeRoot();
            }
        }

        $request->session()->flash('success', trans('lara-mvcms::category.update-success'));

        return redirect()->route('lara-mvcms.blog.categories.index');
    }

    public function delete(Request $request, $categoryId)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        $category = Category::find($categoryId);
        if (!$category) {
            abort(404);
        }

        return response()->json([
            'modal' => view('lara-mvcms::blog.categories._delete', [
                'status' => 'danger',
                'title' => trans('lara-mvcms::categories.delete-title'),
                'closeButtonTitle' => trans('lara-mvcms::categories.buttons.cancel'),
                'okButtonTitle' => trans('lara-mvcms::categories.buttons.destroy'),
                'action' => route('lara-mvcms.blog.categories.destroy', [$category->id]),
                'method' => 'delete'
            ])->render()
        ]);
    }

    public function destroy(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);
        if (!$category) {
            abort(404);
        }
        $category->delete();

        $request->session()->flash('success', trans('lara-mvcms::categories.delete-success'));

        return redirect()->route('lara-mvcms.blog.categories.index');
    }
}
