@props(['files'])
@foreach ($files as $file)
    <link
        href="{{ asset($file['path']) }}"
        rel="stylesheet"
        @foreach ($file['attributes'] ?? [] as $attr => $value)
            {{ $attr }}="{{ $value }}"
        @endforeach
    />
@endforeach
