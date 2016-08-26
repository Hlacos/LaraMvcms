<?php

namespace Hlacos\LaraMvcms\Http\Controllers\ContentManagement;

use Illuminate\Http\Request;
use Hlacos\LaraMvcms\Models\Gallery;
use Hlacos\LaraMvcms\Models\GalleryImage;
use Hlacos\LaraMvcms\Http\Controllers\LaraMvcmsController;

class GalleryController extends LaraMvcmsController
{
    public function __construct()
    {
        $this->middleware('lara-mvcms.has-permission:manage-galleries');
    }

    public function index(Request $request)
    {
        $size = $request->input('size') ?: config()->get('lara-mvcms.defaults.per-page');
        $gridView = $request->input('grid') ? true : false;

        $currentGallery = $request->input('parent_id') ? Gallery::find($request->input('parent_id')) : Gallery::root();
        $galleries = $currentGallery::where('parent_id', $currentGallery->id)
            ->orderBy('is_directory', 'desc')
            ->orderBy('title', 'asc')
            ->paginate($size);

        return view('lara-mvcms::content-management.galleries.index')
            ->with('gridView', $gridView)
            ->with('galleries', $galleries)
            ->with('currentGallery', $currentGallery)
            ->with('parentId', $currentGallery->id)
            ->with('ancestors', $currentGallery->getAncestors());
        }

    public function create(Request $request)
    {
        $gallery = new Gallery;

        return view('lara-mvcms::content-management.galleries.create')
            ->with('gallery', $gallery)
            ->with('parentId', $request->input('parent_id'))
            ->with('isDirectory', $request->input("is_directory") ? true : false);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => "required",
            "parent_id" => "required",
            "attachment" => $request->input("is_directory") ? "" : "required"
        ]);

        $parentGallery = Gallery::find($request->input("parent_id"));

        $gallery = $parentGallery->children()->create($request->except(['_token', 'parent_id', 'attachment']));

        if (!$gallery->is_directory) {
            $file = $request->file("attachment");
            $attachment = new GalleryImage;
            $attachment->addFile($file->getRealPath());
            $attachment->filename = rtrim($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
            $attachment->extension = $file->getClientOriginalExtension();
            $attachment->attachable()->associate($gallery);
            $attachment->save();
        }

        $request->session()->flash('success', trans('lara-mvcms::galleries.create-success'));

        return redirect()->route('lara-mvcms.content-management.galleries.index', ['parent_id' => $request->input('parent_id')]);
    }

    public function edit(Request $request, $galleryId)
    {
        $gallery = Gallery::find($galleryId);
        if (!$gallery) {
            abort(404);
        }

        return view('lara-mvcms::content-management.galleries.edit')
            ->with('gallery', $gallery)
            ->with('parentId', $gallery->parent_id)
            ->with('isDirectory', $gallery->is_directory);
    }

    public function update(Request $request, $galleryId)
    {
        $gallery = Gallery::find($galleryId);
        if (!$gallery) {
            abort(404);
        }

        $this->validate($request, [
            "title" => "required"
        ]);

        $gallery->update($request->except(['_token', '_method', 'attachment']));

        if ($request->input("is_directory") || ($gallery->image()->count() && $request->file("attachment"))) {
            $gallery->image()->delete();
        }

        if (!$gallery->is_directory && $request->file("attachment")) {
            $file = $request->file("attachment");
            $attachment = new GalleryImage;
            $attachment->addFile($file->getRealPath());
            $attachment->filename = rtrim($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
            $attachment->extension = $file->getClientOriginalExtension();
            $attachment->attachable()->associate($gallery);
            $attachment->save();
        }

        $request->session()->flash('success', trans('lara-mvcms::gallery.update-success'));

        return redirect()->route('lara-mvcms.content-management.galleries.index', ['parent_id', $request->input('parent_id')]);
    }

    public function delete(Request $request, $galleryId)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        $gallery = Gallery::find($galleryId);
        if (!$gallery) {
            abort(404);
        }

        return response()->json([
            'modal' => view('lara-mvcms::content-management.galleries._delete', [
                'status' => 'danger',
                'title' => trans('lara-mvcms::galleries.delete-title'),
                'closeButtonTitle' => trans('lara-mvcms::galleries.buttons.cancel'),
                'okButtonTitle' => trans('lara-mvcms::galleries.buttons.destroy'),
                'action' => route('lara-mvcms.content-management.galleries.destroy', [$gallery->id, 'parent_id' => $gallery->parent_id]),
                'method' => 'delete',
                'isDirectory' => $gallery->is_directory ? true : false
            ])->render()
        ]);
    }

    public function destroy(Request $request, $galleryId)
    {
        $gallery = Gallery::find($galleryId);
        if (!$gallery) {
            abort(404);
        }
        $gallery->delete();

        $request->session()->flash('success', trans('lara-mvcms::galleries.delete-success'));

        return redirect()->route('lara-mvcms.content-management.galleries.index', ['parent_id' => $request->input('parent_id')]);
    }
}
