<li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#"
        @if(config('adminlte.sidebar_collapse_remember'))
            data-enable-remember="true"
        @endif
        @if(!config('adminlte.sidebar_collapse_remember_no_transition'))
            data-no-transition-after-reload="false"
        @endif
        @if(config('adminlte.sidebar_collapse_auto_size'))
            data-auto-collapse-size="{{ config('adminlte.sidebar_collapse_auto_size') }}"
        @endif>
        <i class="fas fa-bars"></i>
        <span class="sr-only">{{ __('adminlte::adminlte.toggle_navigation') }}</span>
    </a>
</li>
<span class="navbar-text" id="currentDateTime">
        <i class="far fa-calendar-alt" style="color: #ffa600;"></i> <!-- Font Awesome icon for date -->
        <span id="currentDate"></span> <!-- Span for displaying date -->
        &nbsp;&nbsp; <!-- Add space between date and time -->
        <i class="far fa-clock" style="color: #ffa600;"></i> <!-- Font Awesome icon for time -->
        <span id="currentTime"></span> <!-- Span for displaying time -->
    </span>
    

