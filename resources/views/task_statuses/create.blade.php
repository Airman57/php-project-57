<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('task_statuses.create') }}
        </h2>
    </x-slot>
    {{ html()->modelForm($taskStatus, 'POST', route('task_statuses.store'))->open() }}
    {{  html()->label(__('task_statuses.name'), 'name') }}
    {{  html()->text('name') }}<br>
    @error('name')
    <div class="text-red-500">
        {{ $message }}
    </div>
@enderror
    {{ html()->submit(__('task_statuses.create_button')) }}
{{ html()->closeModelForm() }}

</x-app-layout> 