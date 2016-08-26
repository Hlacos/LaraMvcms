<?php

namespace Hlacos\LaraMvcms\Http\Controllers\Administration;

use Illuminate\Http\Request;
use Hlacos\LaraMvcms\Models\Permission;
use Hlacos\LaraMvcms\Http\Controllers\LaraMvcmsController;

class PermissionController extends LaraMvcmsController
{
    public function __construct()
    {
        $this->middleware('lara-mvcms.has-permission:manage-permissions');
    }

    public function index(Request $request)
    {
        $size = $request->input('size') ?: config()->get('lara-mvcms.defaults.per-page');
        $permissions = Permission::paginate($size);

        return view('lara-mvcms::administration.permissions.index')
            ->with('permissions', $permissions);
    }

    public function create(Request $request)
    {
        $permission = new Permission;

        return view('lara-mvcms::administration.permissions.create')
            ->with('permission', $permission);
    }

    public function store(Request $request)
    {
        $defaultLocale = config('translatable.fallback_locale');

        $this->validate($request, [
            "name" => "required|alpha_dash|unique:permissions",
            "{$defaultLocale}.title" => "required",
            "{$defaultLocale}.description" => "required"
        ]);

        $permission = Permission::create($request->except('_token'));

        $request->session()->flash('success', trans('lara-mvcms::permissions.create-success'));

        return redirect()->route('lara-mvcms.administration.permissions.index');
    }

    public function edit(Request $request, $permissionId)
    {
        $permission = Permission::find($permissionId);
        if (!$permission) {
            abort(404);
        }

        return view('lara-mvcms::administration.permissions.edit')
            ->with('permission', $permission);
    }

    public function update(Request $request, $permissionId)
    {
        $defaultLocale = config('translatable.fallback_locale');

        $permission = Permission::find($permissionId);
        if (!$permission) {
            abort(404);
        }

        $this->validate($request, [
            "name" => "required|alpha_dash|unique:permissions",
            "{$defaultLocale}.title" => "required",
            "{$defaultLocale}.description" => "required"
        ]);

        $permission->update($request->except(['_token', '_method']));

        $request->session()->flash('success', trans('lara-mvcms::permissions.update-success'));

        return redirect()->route('lara-mvcms.administration.permissions.index');
    }

    public function delete(Request $request, $permissionId)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        $permission = Permission::find($permissionId);
        if (!$permission) {
            abort(404);
        }

        return response()->json([
            'modal' => view('lara-mvcms::administration.permissions._delete', [
                'status' => 'danger',
                'title' => trans('lara-mvcms::permissions.delete-title'),
                'closeButtonTitle' => trans('lara-mvcms::permissions.buttons.cancel'),
                'okButtonTitle' => trans('lara-mvcms::permissions.buttons.destroy'),
                'action' => route('lara-mvcms.administration.permissions.destroy', $permission->id),
                'method' => 'delete'
            ])->render()
        ]);
    }

    public function destroy(Request $request, $permissionId)
    {
        $permission = Permission::find($permissionId);
        if (!$permission) {
            abort(404);
        }
        $permission->delete();

        $request->session()->flash('success', trans('lara-mvcms::permissions.delete-success'));

        return redirect()->route('lara-mvcms.administration.permissions.index');
    }
}
