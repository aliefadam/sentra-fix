@if (session('notification'))
    @php
        $text = session('notification')['text'];
        $title = session('notification')['title'];
        $icon = session('notification')['icon'];
    @endphp
    <script>
        Swal.fire({
            position: 'top-end',
            icon: '{{ $icon }}',
            title: '{{ $title }}',
            text: '{{ $text }}',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Gagal',
            text: '{{ $errors->first() }}',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
@endif
