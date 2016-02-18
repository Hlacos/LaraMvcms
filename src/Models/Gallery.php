<?php

namespace Hlacos\LaraMvcms\Models;

use Baum\Node;

class Gallery extends Node {

    protected $table = 'galleries';

    public function image() {
        return $this->morphOne('Hlacos\LaraMvcms\Models\GalleryImage', 'attachable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
            $model->prepareForDelete();
        });
    }

    public function prepareForDelete()
    {
        if ($this->image()->count()) {
            $this->image->delete();
        }
    }

}
