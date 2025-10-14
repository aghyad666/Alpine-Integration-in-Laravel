@props(['btn_link', 'btn_title'])

<div class="grid grid-cols-1 md:grid-cols-[1fr_auto_1fr] items-center gap-y-4 mb-8 p-4">
    <h1 class="text-2xl font-bold text-center md:col-start-2">
        {{ $slot }}
    </h1>
    <a href="{{ route($btn_link) }}" class="px-4 py-2 bg-green-700 hover:bg-green-600 text-white font-bold rounded-lg shadow transition justify-self-center md:justify-self-end md:col-start-3">
        {{ $btn_title }}
    </a>
</div>
