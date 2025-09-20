<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <span class="align-middle">{{ config('app.name') }}</span>
        </a>

        <ul class="sidebar-nav">
            @foreach($menu as $item)
                @if($item['type'] == 'label')
                    <li class="sidebar-header">
                        {{ $item['title'] }}
                    </li>
                @endif
                @if($item['type'] == 'link')
                    <li @class(["sidebar-item", "active" => $item['active']])>
                        <a class="sidebar-link" href="{{ $item['href'] }}">
                            <i class="align-middle" data-feather="{{$item['icon']}}"></i>
                            <span class="align-middle">{{ $item['title'] }}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>
