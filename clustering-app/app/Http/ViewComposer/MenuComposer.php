<?php

namespace App\Http\ViewComposer;

use App\Http\Repository\MenuRepository;
use Illuminate\View\View;

class MenuComposer
{

    public function compose(View $view)
    {
        $menu = (new MenuRepository())->getByRole();
        $view->with('sidebar', $menu);
    }
}
