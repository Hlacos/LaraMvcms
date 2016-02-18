<?php

namespace Hlacos\LaraMvcms\Http\Controllers\Administration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Hlacos\LaraMvcms\Models\AdminUser;
use Hlacos\LaraMvcms\Models\Role;
use Hlacos\LaraMvcms\Http\Controllers\LaraMvcmsController;

class AdminUserController extends LaraMvcmsController
{
    public function __construct()
    {
        $this->middleware('lara-mvcms.has-permission:manage-admin-users');
    }

    public function index(Request $request)
    {
        $size = $request->input('size') ?: config()->get('lara-mvcms.defaults.per-page');
        $adminUsers = AdminUser::paginate($size);

        return view('lara-mvcms::administration.admin-users.index')
            ->with('adminUsers', $adminUsers);
    }

    public function create()
    {
        $adminUser = new AdminUser;

        $roles = Role::all();

        return view('lara-mvcms::administration.admin-users.create')
            ->with('adminUser', $adminUser)
            ->with('roles', $roles);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "username" => "required|unique:admin_users",
            "email" => "required|email|unique:admin_users",
            "firstname" => "required",
            "lastname" => "required",
            "password" => "required|confirmed"
        ]);

        $adminUser = AdminUser::create($request->except(['_token', 'password', 'password_confirmation']));
        $adminUser->roles()->sync((array)$request->input('roles'));
        $adminUser->is_active = $request->input('is_active') ? 1 : 0;
        $adminUser->password = Hash::make($request->input('password'));
        $adminUser->save();

        $request->session()->flash('success', trans('lara-mvcms::admin-users.create-success'));

        return redirect()->route('lara-mvcms.administration.admin-users.index');
    }

    public function edit($userId)
    {
        $adminUser = AdminUser::find($userId);
        if (!$adminUser) {
            abort(404);
        }
        $roles = Role::all();

        return view('lara-mvcms::administration.admin-users.edit')
            ->with('adminUser', $adminUser)
            ->with('roles', $roles);
    }

    public function update(Request $request, $userId)
    {
        $adminUser = AdminUser::find($userId);
        if (!$adminUser) {
            abort(404);
        }

        $this->validate($request, [
            "username" => "required|unique:admin_users,username,{$adminUser->id}",
            "email" => "required|email|unique:admin_users,email,{$adminUser->email}",
            "firstname" => "required",
            "lastname" => "required",
            "password" => "confirmed"
        ]);

        $adminUser->update($request->except(['_token', '_method', 'password', 'password_confirmation']));
        $adminUser->roles()->sync((array)$request->input('roles'));
        $adminUser->is_active = $request->input('is_active') ? 1 : 0;
        if ($request->input('password')) {
            $adminUser->password = Hash::make($request->input('password'));
            $adminUser->save();
        }
        $request->session()->flash('success', trans('lara-mvcms::admin-users.update-success'));

        return redirect()->route('lara-mvcms.administration.admin-users.index');
    }

    public function delete(Request $request, $userId)
    {
        if (!$request->ajax()) {
            abort(404);
        }

        $adminUser = AdminUser::find($userId);
        if (!$adminUser) {
            abort(404);
        }

        return response()->json([
            'modal' => view('lara-mvcms::administration.admin-users._delete', [
                'status' => 'danger',
                'title' => trans('lara-mvcms::admin-users.delete-title'),
                'closeButtonTitle' => trans('lara-mvcms::admin-users.buttons.cancel'),
                'okButtonTitle' => trans('lara-mvcms::admin-users.buttons.destroy'),
                'action' => route('lara-mvcms.administration.admin-users.destroy', $adminUser->id),
                'method' => 'delete'
            ])->render()
        ]);
    }

    public function destroy(Request $request, $userId)
    {
        $adminUser = AdminUser::find($userId);
        if (!$adminUser) {
            abort(404);
        }
        $adminUser->delete();

        $request->session()->flash('success', trans('lara-mvcms::admin-users.delete-success'));

        return redirect()->route('lara-mvcms.administration.admin-users.index');
    }
}
