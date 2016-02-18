<?php

namespace Hlacos\LaraMvcms\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use \Dimsav\Translatable\Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

    public $translatedAttributes = ['title', 'description'];

    protected $fillable = ['name', 'title', 'description'];

    public function permissions()
    {
        return $this->belongsToMany('Hlacos\LaraMvcms\Models\Permission', 'permissions_roles');
    }

    public function users()
    {
        return $this->belongsToMany('Hlacos\LaraMvcms\Models\AdminUser', 'roles_users');
    }

    public function scopePermit($query, $permission)
    {
        return $query->whereHas('permissions', function($q) use ($permission) {
            $q->where('id', $permission->id);
        });
    }

    public function hasPermission($permission)
    {
        return in_array($permission->id, array_fetch($this->permissions->toArray(), 'id'));
    }

    public function addPermission($permission)
    {
        $this->permissions()->attach($permission);
    }

    public function addPermissionByName($permissionName)
    {
        $permission = Permission::where('name', $permissionName)->first();
        if ($permission) {
            $this->addPermission($permission);
        }
    }
}
