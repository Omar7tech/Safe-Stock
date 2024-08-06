<nav aria-label="breadcrumb" style="width: fit-content">
    <ol class="breadcrumb" >
        @foreach ($items as $item)
            @if ($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $item['name'] }}</li>
            @else
                <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['name'] }}</a></li>
            @endif
        @endforeach
    </ol>
</nav>
