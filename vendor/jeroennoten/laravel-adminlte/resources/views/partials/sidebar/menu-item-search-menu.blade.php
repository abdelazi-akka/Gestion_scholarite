<li>

    <div class="form-inline my-2">
        <div class="input-group" data-widget="sidebar-search" data-arrow-sign="&raquo;">

            {{-- Search input --}}
            <input class="form-control form-control-sidebar text-dark" style="background: linear-gradient(to right top, #fffefc, #f6f0e0, #ebe3c5, #dcd7ab, #cccc92);
            transition: 0.5s;overflow: hidden" type="search"
                @isset($item['id']) id="{{ $item['id'] }}" @endisset
                placeholder="{{ $item['text'] }}"
                aria-label="{{ $item['text'] }}">

            {{-- Search button --}}
            <div class="input-group-append ">
                <button class="btn btn-sidebar">
                    <i class="fas fa-fw fa-search" style="color:#ffa600;"></i>
                </button>
            </div>

        </div>
    </div>

</li>
