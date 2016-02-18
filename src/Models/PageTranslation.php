<?php

namespace Hlacos\LaraMvcms\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['slug', 'title', 'description', 'content'];
}
