<?php

namespace Hlacos\LaraMvcms\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ApplicationLayoutComposer
{
    protected $adminUser;
    protected $sessionId;

    public function __construct()
    {
        $this->sessionId = Session::getId();
        $this->adminUser = Auth::admin()->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('adminUser', $this->adminUser)
            ->with('sessionId', $this->sessionId);
    }
}
