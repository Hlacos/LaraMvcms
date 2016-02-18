<?php

namespace Hlacos\LaraMvcms\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use \Dimsav\Translatable\Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    public $translatedAttributes = ['title', 'description'];

    protected $fillable = ['name', 'title', 'description'];

    public function roles()
    {
        return $this->belongsToMany('Hlacos\LaraMvcms\Models\Role', 'permissions_roles');
    }
}
