<form {{ $attributes->merge(["class" => "max-w-lg mx-auto mt-8 p-6 space-y-4", "method" => "GET"]) }}>
    @if ($attributes->get('method', 'GET') !== 'GET')
        @csrf
        @method($attributes->get('method'))
    @endif

    {{ $slot }}
</form>
