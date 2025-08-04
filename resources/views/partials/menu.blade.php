<ul id="js-nav-menu" class="nav-menu">
    <li>
        <a href="{{route('backoffice.dashboard')}}" title="Dashboard" data-filter-tags="dashboard">
            <i class="fal fa-desktop"></i>
            <span class="nav-link-text">Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{route('film.index')}}" title="Film" data-filter-tags="Film">
            <i class="fal fa-warehouse"></i>
            <span class="nav-link-text">Film</span>
        </a>
    </li>
    <li>
        <a href="{{route('kategori.index')}}" title="Kategori" data-filter-tags="Kategori">
            <i class="fal fa-warehouse"></i>
            <span class="nav-link-text">Kategori</span>
        </a>
    </li>
    <li>
        <a href="{{route('shop.index')}}" title="Shop" data-filter-tags="Shop">
            <i class="fal fa-warehouse"></i>
            <span class="nav-link-text">Shop</span>
        </a>
    </li>
    <li>
        <a href="{{route('article.index')}}" title="Article" data-filter-tags="Article">
            <i class="fal fa-warehouse"></i>
            <span class="nav-link-text">Article</span>
        </a>
    </li>
    <li>
        <a href="{{route('job.index')}}" title="Career" data-filter-tags="Career">
            <i class="fal fa-warehouse"></i>
            <span class="nav-link-text">Career</span>
        </a>
    </li>
    <li>
        <a href="{{route('casting.index')}}" title="Casting" data-filter-tags="Casting">
            <i class="fal fa-warehouse"></i>
            <span class="nav-link-text">Casting</span>
        </a>
    </li>
    @isset($menu)
    @foreach ($menu as $parent_menu)
    <li class="">
        <a href="{{$parent_menu->route_name ? route($parent_menu->route_name): '#'}}"
            title="{{$parent_menu->menu_title ? $parent_menu->menu_title:''}}">
            <i class="{{$parent_menu->icon_class ? $parent_menu->icon_class:''}}"></i>
            <span class="nav-link-text">{{$parent_menu->menu_title ?$parent_menu->menu_title:''}}</span>
        </a>
        @if (count($parent_menu->childs))
        <ul>
            @include('partials.submenu',['submenu' => $parent_menu->childs])
        </ul>
        @endif
    </li>
    @endforeach
    @endisset
</ul>