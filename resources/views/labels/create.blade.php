<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('labels.create') }}
        </h2>
    </x-slot>

    {{ html()->modelForm($label, 'POST', route('labels.store'))->open() }}
    {{  html()->label(__('labels.name'), 'name') }}
    {{  html()->text('name') }}<br>
    {{  html()->label(__('labels.description'), 'description') }}
    {{  html()->textarea('description') }}<br>
    @if ($errors->any())
    <ul class="text-red-500">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
    {{ html()->submit(__('labels.create')) }}
    {{ html()->closeModelForm() }}
</x-app-layout>