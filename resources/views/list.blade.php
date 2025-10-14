<x-layout>
    <x-headings.heading-with-btn btn_link="create" btn_title="+ Add category">Categories list</x-headings.heading-with-btn>

    <div class="max-w-5xl mx-auto p-4">

        <!-- Select buttons -->
        <x-lists.header :activeSectionType="$activeCategoryType" section="category"/>
        <x-forms.divider />

        <!-- Categories -->
        @foreach($parentCategories as $parent)
            <div class="flex justify-between border-b border-gray-900 bg-gray-900 mt-8 px-4 py-2">
                <!-- Category name -->
                <div class="flex gap-2">
                    <a href="{{ route('edit', $parent->id) }}" class="font-medium text-lg hover:text-green-700 transition">
                        {{ $parent->name }}
                    </a>
                </div>
                <div class="flex gap-2">
                    <!-- Edit -->
                    <a href="{{ route('edit', $parent->id) }}" title="Edit">
                        <img src="{{ Vite::asset('resources/images/pencil.svg') }}" alt="Pencil" class="inline-block align-middle h-4 pr-1">
                    </a>
                    <!-- Delete -->
                    <form action="{{ route('destroy', $parent->id) }}" method="POST" onsubmit="return confirm('Confirm deletion of this parent category. All children will be deleted too.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete">
                            <img src="{{ Vite::asset('resources/images/trash.svg') }}" alt="Trash" class="inline-block align-middle h-5 cursor-pointer">
                        </button>
                    </form>
                </div>
            </div>

            <!-- Subcategories -->
            @if ($parent->children->count())
                <ul>
                    @foreach($parent->children as $child)
                        <li class="flex items-center justify-between px-4 py-2 border-b border-gray-900">
                            <div class="flex gap-2">
                                <a href="{{ route('edit', $child->id) }}" class="text-md hover:text-green-700 transition">
                                    {{ $child->name }}
                                </a>
                            </div>
                            <div class="flex gap-2">
                                <!-- Edit -->
                                <a href="{{ route('edit', $child->id) }}" title="Edit">
                                    <img src="{{ Vite::asset('resources/images/pencil.svg') }}" alt="Pencil" class="inline-block align-middle h-4 pr-1">
                                </a>
                                <!-- Delete -->
                                <form action="{{ route('destroy', $child->id) }}" method="POST" onsubmit="return confirm('Confirm deletion of this subcategory.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete">
                                        <img src="{{ Vite::asset('resources/images/trash.svg') }}" alt="Trash" class="inline-block align-middle h-5 cursor-pointer">
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach

    </div>
</x-layout>
