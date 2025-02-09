<div class="flex items-center space-x-2 text-sm text-gray-600">
    @if (isset($before))
        <a href="{{ $before['url'] }}" class="text-gray-400 hover:text-gray-600">
            {{ $before['name'] }}
        </a>
        <i class="fas fa-chevron-right text-xs"></i>
    @endif

    <div class="">
        <span>{{ $current }}</span>
    </div>

</div>
