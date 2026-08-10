<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tasks.show') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold">
                {{ __('tasks.view') }} {{ $task->name }}
            </h1>
            <h2>
                {{ $task->name }} <br>
                {{ __('task_statuses.' . $task->status->name) }} <br>
                {{ $task->description }}
            </h2>   
            @can('delete', $task)
                  <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                     @csrf
                     @method('DELETE')

                     <button class="text-red-600">
                            {{ __('tasks.delete_button') }}
                    </button>
                     </form>
            @endcan
        </div>
    </div>
</x-app-layout>