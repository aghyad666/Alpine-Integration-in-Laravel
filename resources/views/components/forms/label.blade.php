@props(['name', 'label'])

<div class="inline-flex items-center gap-x-2">
    <label class="block text-sm font-medium text-gray-400" for="{{ $name }}">{{ $label }}</label>
</div>
