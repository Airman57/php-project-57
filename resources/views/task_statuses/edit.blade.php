<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('task_statuses.edit') }}
        </h2>
    </x-slot>

{{ html()->modelForm($taskStatus, 'PUT', route('task_statuses.update', $taskStatus))->open() }}
{{ html()->label(__('task_statuses.name'), 'name') }}
{{ html()->text('name') }}<br>
{{ html()->submit(__('task_statuses.update_button')) }}
{{ html()->closeModelForm() }}
</x-app-layout>