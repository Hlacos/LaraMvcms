<?php

namespace Hlacos\LaraMvcms\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use \Dimsav\Translatable\Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'posts';

    public $translatedAttributes = ['slug', 'title', 'description', 'content'];

    protected $fillable = ['slug', 'title', 'description', 'content'];

    public function category()
    {
        return $this->belongsTo('Hlacos\LaraMvcms\Models\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('Hlacos\LaraMvcms\Models\Tag', 'posts_tags');
    }
}
