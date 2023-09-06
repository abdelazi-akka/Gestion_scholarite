<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}"
style="background-color:#FFC75F;transition: 0.5s;overflow: hidden">
<style>
    :root {
--blue: #2a2185;
--white: #fff;
--gray: #f5f5f5;
--black1: #222;
--black2: #999;
}
 .sidebar nav ul li,.nav-treeview  li {
border-top-left-radius: 30px;
border-bottom-left-radius: 30px;
}
.nav .nav-treeview li{
    background:var(--white) !important;
}

.nav .nav-treeview  li a {
    color:#008F7A !important;
}

.sidebar nav ul li a:hover {
border-top-left-radius: 30px !important;
border-bottom-left-radius: 30px !important;
background-image: linear-gradient(to right top, #bfcbdb, #6d6126, #787144, #848162, #bfcbdb);
}
.sidebar nav ul li a:hover {
color: var(--white) !important;
}
.fa-language{
    color: #ffa600 !important;
}
/* .fa-user{
    color: #ffa600 !important;
} */
.sidebar nav ul li a {
color:var(--white) !important;
font-weight: bold;
font-size: 1 rem;
}
.sidebar nav ul li a.active{
margin-top:0;
border-top-left-radius: 30px !important;
border-bottom-left-radius: 30px !important;
background-image: linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd) !important;
color: white !important;

}
  .btn-outline-orange {
    border: 2px solid lightgray;
    background:linear-gradient(to right top, #c8c790, #b2c89a, #a0c8a7, #94c6b3, #8fc2bd);
    color: white;
    transition: background-color 0.3s, color 0.3s;
  }


</style>
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
            </ul>
        </nav>
    </div>

</aside>
