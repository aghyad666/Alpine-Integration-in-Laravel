@props(['id' => '', 'class' => '', 'width', 'emphasize' => 0, 'onclick' => ''])

@php
    // Set bg color
    if ($emphasize != 0) {
        $bg = 'bg-green-700 hover:bg-green-600';
    } else {
        $bg = 'bg-gray-700 hover:bg-gray-600';
    }

    // Set width
    if (isset($width)) {
        $finalWidth = $width;
    } else {
        $finalWidth = 'w-full';
    }

    $defaults = [
        'id' => $id,
        'class' => 'block ' . $finalWidth . ' px-4 py-2 mt-6 text-white text-center font-bold rounded-lg shadow transition cursor-pointer ' . $class . ' ' . $bg,
        'onclick' => $onclick,
    ];
@endphp

<button {{ $attributes($defaults) }}>
    {{ $slot }}
</button>
