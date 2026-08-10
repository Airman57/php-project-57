<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('task_statuses.title') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('task_statuses.create') }}">
                {{ __('task_statuses.create') }}
            </a>
        </div>

    <div class="py-12">
        <div class="max-w-7xl text-red-500 mx-auto sm:px-6 lg:px-8">
            
        </div>
        @foreach ($taskStatuses as $status)

    <h2>
        <a>
            {{ __('task_statuses.'.$status->name) }}
        </a>
    </h2>

    <a href="{{ route('task_statuses.edit', $status) }}">
        {{ __('task_statuses.edit') }}
    </a>

    <form method="POST" action="{{ route('task_statuses.destroy', $status) }}">
        @csrf
        @method('DELETE')

        <button type="submit">
            {{ __('task_statuses.delete_button') }}
        </button>
    </form>

        @endforeach
    </div>
</x-app-layout>

