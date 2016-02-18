<?php

namespace Hlacos\LaraMvcms\Http\Controllers\ContentManagement;

use Illuminate\Http\Request;
use Hlacos\LaraMvcms\Models\Page;
use Hlacos\LaraMvcms\Http\Controllers\LaraMvcmsController;

class PageController extends LaraMvcmsController
{
    public function __construct()
    {
        $this->middleware('lara-mvcms.has-permission:manage-pages');
    }

    public function index(Request $request)
    {
        $size = $request->input('size') ?: config()->get('lara-mvcms.defaults.per-page');
        $pages = Page::paginate($size);

        return view('lara-mvcms::content-management.pages.index')
            ->with('pages', $pages);
        }

    public function create()
    {
        $page = new Page;

        return view('lara-mvcms::content-management.pages.create')
            ->with('page', $page);
    }

    public function store(Request $request)
    {
        $defaultLocale = config('translatable.fallback_locale');

        $this->validate($request, [
            "name" => "required|alpha_dash|unique:pages",
            "{$defaultLocale}.slug" => "required|alpha_dash|unique:page_translations,slug",
            //TODO add slug uniqueness in all language
            "{$defaultLocale}.title" => "required",
            "{$defaultLocale}.description" => "required",
            "{$defaultLocale}.content" => "required",
        ]);

        $page = Page::create($request->except('_token'));
        $request->session()->flash('success', trans('lara-mvcms::pages.create-success'));

        return redirect()->route('lara-mvcms.content-management.pages.index');
    }

    public function edit($pageId)
    {
        $page = Page::find($pageId);
        if (!$page) {
            abort(404);
        }

        return view('lara-mvcms::content-management.pages.edit')
            ->with('page', $page);
    }

    public function update(Request $request, $pageId)
    {
        $defaultLocale = config('translatable.fallback_locale');

        $page = Page::find($pageId);
        if (!$page) {
            abort(404);
        }

        $this->validate($request, [
            "name" => "required|alpha_dash|unique:pages,name,{$page->id}",
            "{$defaultLocale}.slug" => "required|alpha_dash|unique:page_translations,slug,{$page->translate($defaultLocale)->id}",
            //TODO add slug uniqueness in all language
            "{$defaultLocale}.title" => "required",
            "{$defaultLocale}.description" => "required",
            "{$defaultLocale}.content" => "required",
        ]);

        $page->update($request->except(['_token', '_method']));

        $request->session()->flash('success', trans('lara-mvcms::pages.update-success'));

        return redirect()->route('lara-mvcms.content-management.pages.index');
    }

    public function delete(Request $request, $pageId)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        $page = Page::find($pageId);
        if (!$page) {
            abort(404);
        }

        return response()->json([
            'modal' => view('lara-mvcms::content-management.pages._delete', [
                'status' => 'danger',
                'title' => trans('lara-mvcms::pages.delete-title'),
                'closeButtonTitle' => trans('lara-mvcms::pages.buttons.cancel'),
                'okButtonTitle' => trans('lara-mvcms::pages.buttons.destroy'),
                'action' => route('lara-mvcms.content-management.pages.destroy', $page->id),
                'method' => 'delete'
            ])->render()
        ]);
    }

    public function destroy(Request $request, $pageId)
    {
        $page = Page::find($pageId);
        if (!$page) {
            abort(404);
        }
        $page->delete();

        $request->session()->flash('success', trans('lara-mvcms::pages.delete-success'));

        return redirect()->route('lara-mvcms.content-management.pages.index');
    }
}
