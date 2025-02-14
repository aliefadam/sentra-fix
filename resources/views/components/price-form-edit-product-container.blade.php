@if (count($variant1) > 0 && count($variant2) == 0)
    @foreach ($variant1 as $v1)
        @include('components.price-form-edit-product-item', [
            'v1' => $v1,
            'v2' => [],
        ])
    @endforeach
@else
    @foreach ($variant1 as $v1)
        @foreach ($variant2 as $v2)
            @include('components.price-form-edit-product-item', [
                'v1' => $v1,
                'v2' => $v2,
            ])
        @endforeach
    @endforeach
@endif
