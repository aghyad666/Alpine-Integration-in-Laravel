@props(['label', 'name', 'width', 'note' => ''])

@php
    if (isset($width)) {
        $finalWidth = $width;
    } else {
        $finalWidth = 'w-full';
    }

    $defaults = [
        'id' => $name,
        'name' => $name,
        'class' => 'block ' . $finalWidth . ' border border-gray-800 bg-gray-900 mt-2 p-2 rounded-md text-gray-500 focus:outline-none focus:ring-1 focus:ring-green-700'
    ];
@endphp

<x-forms.field :$label :$name :$note>
    <select {{ $attributes($defaults) }}>
        {{ $slot }}
    </select>

    @if(!empty($note))
        <small class="text-gray-500 text-sm">{{ $note }}</small>
    @endif
</x-forms.field>
