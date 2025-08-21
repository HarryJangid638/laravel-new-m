@props(['files'])
@foreach ($files as $file)
    <script
        src="{{ asset($file['path']) }}"
        @foreach ($file['attributes'] ?? [] as $attr => $value)
            {{ $attr }}="{{ $value }}"
        @endforeach
    ></script>
@endforeach
