<?php

namespace Hlacos\LaraMvcms\Models;

use Illuminate\Database\Eloquent\Model;

class RoleTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'description'];
}
