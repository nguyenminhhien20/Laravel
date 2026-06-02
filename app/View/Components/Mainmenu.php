<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class Mainmenu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $agrs=[
            ['parent_id','=',0],
            ['position','=','mainmenu'],
            ['status','=','1'],
        ];
        $menu_list = Menu::where( $agrs)->orderBy('sort_order','asc')->get();
        return view('components.main-menu',compact('menu_list'));
    }
}
