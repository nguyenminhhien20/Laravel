<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class MainmenuItem extends Component
{
    public $menu_item=null;
    public function __construct($menuitem)
    {
        $this->menu_item=$menuitem;
    }


    public function render(): View|Closure|string
    {
        $menu = $this->menu_item;
        $agrs=[
            ['parent_id','=',$menu->id],
            ['position','=','mainmenu'],
            ['status','=','1'],
        ];
        $menu_list = Menu::where( $agrs)->orderBy('sort_order','asc')->get();
        return view('components.main-menu-item',compact('menu_list','menu'));
    }
}
