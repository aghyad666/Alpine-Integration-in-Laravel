@props(['label', 'name', 'type' => 'text', 'note' => ''])

@php
    $defaults = [
        'type' => $type,
        'id' => $name,
        'name' => $name,
        'class' => 'block w-full border border-gray-800 bg-gray-900 p-2 rounded-md text-gray-500 font-medium focus:outline-none focus:ring-1 focus:ring-green-700',
        'value' => old($name)
    ];
@endphp

<x-forms.field :$label :$name :$note>
    <input {{ $attributes($defaults) }}>

    @if(!empty($note))
        <small class="text-gray-500 text-sm">{{ $note }}</small>
    @endif
</x-forms.field>

