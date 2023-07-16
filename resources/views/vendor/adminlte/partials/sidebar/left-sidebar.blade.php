<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')

                @if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->role == 'admin')
                    <li class="nav-link">
                        <a href="{{route('authors.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Authors list
                            </p>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{route('categories.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Categories list
                            </p>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{route('publishers.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Publishers list
                            </p>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="{{route('books.index')}}" class="nav-link">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>
                                Book list
                            </p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    </div>

</aside>
