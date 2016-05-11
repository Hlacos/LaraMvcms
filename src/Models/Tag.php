<?php

namespace Hlacos\LaraMvcms\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \Dimsav\Translatable\Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags';

    public $translatedAttributes = ['slug', 'title'];

    protected $fillable = ['slug', 'title'];

    public function posts()
    {
        return $this->belongsToMany('Hlacos\LaraMvcms\Models\Post', 'posts_tags');
    }
}
