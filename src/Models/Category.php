<?php

namespace Hlacos\LaraMvcms\Models;

use Baum\Node;

class Category extends Node
{
    use \Dimsav\Translatable\Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    public $translatedAttributes = ['slug', 'title', 'description'];

    protected $fillable = ['slug', 'title', 'description'];

    public function posts()
    {
        return $this->hasMany('Hlacos\LaraMvcms\Models\Post');
    }
}
