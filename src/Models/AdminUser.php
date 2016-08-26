<?php

namespace Hlacos\LaraMvcms\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Auth\Passwords\CanResetPassword;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kbwebs\MultiAuth\PasswordResets\CanResetPassword;
use Kbwebs\MultiAuth\PasswordResets\Contracts\CanResetPassword as CanResetPasswordContract;
use Hlacos\LaraMvcms\Models\Role;

class AdminUser extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'firstname', 'lastname', 'is_active'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function accessMediasAll()
    {
        // return true for access to all medias
        return true;
    }

    public function accessMediasFolder()
    {
        // return true for access to one folder
        return true;
    }

    public function roles()
    {
        return $this->belongsToMany('Hlacos\LaraMvcms\Models\Role', 'roles_users');
    }

    public function getNameAttribute()
    {
        return $this->firstname." ".$this->lastname;
    }

    public function getReadableRolesAttribute()
    {
        return implode(',', $this->roles()->lists('name')->toArray());
    }

    public function hasRole($role)
    {
        return in_array($role->id, array_fetch($this->roles->toArray(), 'id'));
    }

    public function addRole($role)
    {
        $this->roles()->attach($role);
    }

    public function addRoleByName($roleName)
    {
        $role = Role::where('name', $roleName)->first();
        if ($role) {
            $this->addRole($role);
        }
    }

    public function hasPermission($permission)
    {
        $rolesHasPermission = Role::permit($permission)->get();
        $myRoles = $this->roles;

        if ($rolesHasPermission->isEmpty() || $myRoles->isEmpty()) {
            return false;
        }

        $intersect = $rolesHasPermission->intersect($myRoles);

        return count($intersect) == 0 ? false : true;
    }
}
