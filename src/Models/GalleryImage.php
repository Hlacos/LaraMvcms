<?php

namespace Hlacos\LaraMvcms\Models;

use Hlacos\Attachment5\Models\Attachment as Attachment;

class GalleryImage extends Attachment
{
    public function __construct()
    {
        $this->sizes = config()->get('lara-mvcms.gallery.image-sizes');

        parent::__construct();
    }
}
