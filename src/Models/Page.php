<?php

namespace Hlacos\LaraMvcms\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use \Dimsav\Translatable\Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    public $translatedAttributes = ['slug', 'title', 'description', 'content'];

    protected $fillable = ['name', 'slug', 'title', 'description', 'content'];
}
