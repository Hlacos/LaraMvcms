<?php

namespace Hlacos\LaraMvcms\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class AdminMenuComposer
{
    public function compose(View $view)
    {
        $view->with('extendedMenu', []);
    }
}
