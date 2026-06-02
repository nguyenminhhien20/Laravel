@if ($menu_list!=null)
<li><a href="{{ $menu_item->link}}" class="hover:text-gray-300">{{$menu_item->name}}</a>
    <ul>
        @foreach ($menu_list as $item )
            <li><a href="{{ $item->link}}"></a>{{$item->name}}</li>
        @endforeach

    </ul>
</li>
@else
<li><a href="{{ $menu_item->link}}" class="hover:text-gray-300">{{$menu_item->name}}</a>
@endif
