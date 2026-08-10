<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tasks.title') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('tasks.create') }}">
                {{ __('tasks.create') }}
            </a>
        </div>
        @foreach ($tasks as $task)
            <h2>
                {{ $task->id }}.
                {{ __('task_statuses.' . $task->status->name) }} -
                <a href="{{ route('tasks.show', $task) }}">
                    {{ $task->name }}
                </a>
                {{ $task->createdBy ? $task->createdBy->name : 'Unknown' }}
                {{ $task->assignedTo ? $task->assignedTo->name : 'Unassigned' }} -
                {{ $task->created_at->format('Y-m-d H:i:s') }}
                <a href="{{ route('tasks.edit', $task) }}">
                    {{ __('tasks.edit') }}
            </h2>   
        @endforeach
    </div>
</x-app-layout>