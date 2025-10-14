@props(['label', 'name', 'id', 'note' => ''])

@php
    $defaults = [
        'type' => 'text',
        'name' => $name,
        'id' => $id,
        'class' => 'block w-full date border border-gray-800 bg-gray-900 p-2 rounded-md text-gray-500 font-medium focus:outline-none focus:ring-1 focus:ring-green-700',
        'value' => old($name)
    ];
@endphp

<div>
    @if ($label)
        <x-forms.label :$name :$label />
    @endif

    <div class="mt-1">
        <div class="relative">
            <input {{ $attributes($defaults) }}>

            <button type="button"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 cursor-pointer"
                    onclick="document.querySelector('#{{ $id }}')._flatpickr?.open()"
                    aria-label="Open date picker">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M6 2a1 1 0 1 1 2 0v1h4V2a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v2H3V5a2 2 0 0 1 2-2h1V2z"/>
                    <path d="M3 9h14v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9z"/>
                </svg>
            </button>
        </div>

        @if(!empty($note))
            <small class="text-gray-500 text-sm">{{ $note }}</small>
        @endif

        <x-forms.error :error="$errors->first($name)" />
    </div>
</div>
