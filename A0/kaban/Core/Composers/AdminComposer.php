<?php
namespace Kaban\Core\Composers;


use Auth;
use Kaban\Core\Menus\AdminMenu;
use Route;

class AdminComposer
{
    public function compose($view)
    {
        $routeName = Route::currentRouteName();

        if ($view->offsetExists('title')) {
            $title = $view->offsetGet('title');
        } else {
            $title = $routeName;
        }

        $view
            ->with('title', $title);
    }
}
