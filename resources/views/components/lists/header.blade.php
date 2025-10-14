@props(['activeSectionType', 'section'])

<x-headings.heading-simple>Select {{ $section }} type</x-headings.heading-simple>

<div class="max-w-5xl mx-auto">
    <form method="GET" action="/" class="flex justify-center gap-10">
        <x-forms.button id="btn-expenses" name="{{ $section }}Type" value="expense" width="w-30" emphasize="{{ $activeSectionType == 'expense' ? 1 : 0 }}">
            Expenses
        </x-forms.button>
        <x-forms.button id="btn-income" name="{{ $section }}Type" value="income" width="w-30" emphasize="{{ $activeSectionType == 'income' ? 1 : 0 }}">
            Income
        </x-forms.button>
    </form>
</div>
