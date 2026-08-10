<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tasks.create') }}
        </h2>
    </x-slot>
    {{ html()->modelForm($task, 'POST', route('tasks.store'))->open() }}
    {{  html()->label(__('tasks.name'), 'name') }}
    {{  html()->text('name') }}<br>
    {{  html()->label(__('tasks.description'), 'description') }}
    {{  html()->textarea('description') }}<br>
    {{  html()->label(__('tasks.status'), 'status_id') }}
    {{  html()->select('status_id', $taskStatuses->pluck('name', 'id')) }}<br>
    {{  html()->label(__('tasks.assigned_to'), 'assigned_to_id') }}
    {{  html()->select('assigned_to_id', $users->pluck('name', 'id')) }}<br>
    {{ html()->submit(__('tasks.create')) }}
    @if ($errors->any())
    <ul class="text-red-500">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
    {{ html()->closeModelForm() }}

</x-app-layout>