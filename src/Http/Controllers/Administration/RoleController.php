<?php

namespace Hlacos\LaraMvcms\Http\Controllers\Administration;

use Illuminate\Http\Request;
use Hlacos\LaraMvcms\Models\Role;
use Hlacos\LaraMvcms\Models\Permission;
use Hlacos\LaraMvcms\Http\Controllers\LaraMvcmsController;

class RoleController extends LaraMvcmsController
{
    public function __construct()
    {
        $this->middleware('lara-mvcms.has-permission:manage-roles');
    }

    public function index(Request $request)
    {
        $size = $request->input('size') ?: config()->get('lara-mvcms.defaults.per-page');
        $roles = Role::paginate($size);

        return view('lara-mvcms::administration.roles.index')
            ->with('roles', $roles);
        }

    public function create(Request $request)
    {
        $role = new Role;

        $permissions = Permission::all();

        return view('lara-mvcms::administration.roles.create')
            ->with('role', $role)
            ->with('permissions', $permissions);
    }

    public function store(Request $request)
    {
        $defaultLocale = config('translatable.fallback_locale');

        $this->validate($request, [
            "name" => "required|alpha_dash|unique:roles",
            "{$defaultLocale}.title" => "required",
            "{$defaultLocale}.description" => "required"
        ]);

        $role = Role::create($request->except('_token'));
        $role->permissions()->sync((array)$request->input('permissions'));

        $request->session()->flash('success', trans('lara-mvcms::roles.create-success'));

        return redirect()->route('lara-mvcms.administration.roles.index');
    }

    public function edit(Request $request, $roleId)
    {
        $role = Role::find($roleId);
        if (!$role) {
            abort(404);
        }

        $permissions = Permission::all();

        return view('lara-mvcms::administration.roles.edit')
            ->with('role', $role)
            ->with('permissions', $permissions);
    }

    public function update(Request $request, $roleId)
    {
        $defaultLocale = config('translatable.fallback_locale');

        $role = Role::find($roleId);
        if (!$role) {
            abort(404);
        }

        $this->validate($request, [
            "name" => "required|alpha_dash|unique:roles,name,{$role->id}",
            "{$defaultLocale}.title" => "required",
            "{$defaultLocale}.description" => "required"
        ]);

        $role->update($request->except(['_token', '_method']));
        $role->permissions()->sync((array)$request->input('permissions'));

        $request->session()->flash('success', trans('lara-mvcms::roles.update-success'));

        return redirect()->route('lara-mvcms.administration.roles.index');
    }

    public function delete(Request $request, $roleId)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        $role = Role::find($roleId);
        if (!$role) {
            abort(404);
        }

        return response()->json([
            'modal' => view('lara-mvcms::administration.roles._delete', [
                'status' => 'danger',
                'title' => trans('lara-mvcms::roles.delete-title'),
                'closeButtonTitle' => trans('lara-mvcms::roles.buttons.cancel'),
                'okButtonTitle' => trans('lara-mvcms::roles.buttons.destroy'),
                'action' => route('lara-mvcms.administration.roles.destroy', $role->id),
                'method' => 'delete'
            ])->render()
        ]);
    }

    public function destroy(Request $request, $roleId)
    {
        $role = Role::find($roleId);
        if (!$role) {
            abort(404);
        }
        $role->delete();

        $request->session()->flash('success', trans('lara-mvcms::roles.delete-success'));

        return redirect()->route('lara-mvcms.administration.roles.index');
    }
}
