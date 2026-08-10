<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('labels.create_label') }}
        </h2>
    </x-slot>

     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('labels.create') }}">
                {{ __('labels.create') }}
            </a>
        </div>
    </div>
    @foreach ($labels as $label)
        <h2>
            {{ $label->id }}.
            <a href="{{ route('labels.show', $label) }}">
                {{ $label->name }}
            </a>
            {{ $label->created_at->format('Y-m-d H:i:s') }}
            <a href="{{ route('labels.edit', $label) }}">
                {{ __('labels.edit') }}
        </h2>
    @endforeach
</x-app-layout>