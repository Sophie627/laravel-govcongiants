<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div style="padding: 20px">
                    <div class="divide-y divide-gray-400">
                        @foreach ($data as $element)
                            <div class="text-left py-2">
                                <p class="text-purple-700 text-opacity-100">{{ $element->title }}</p>
                                <p><span class="font-bold">Notice ID: </span>{{ $element->notice_id }}</p>
                                <p><span class="font-bold">Department: </span>{{ $element->department }}</p>
                                <p><span class="font-bold">Description: </span>{{ $element->description }}</p>
                                <p><span class="font-bold">Current Response Date: </span>{{ $element->response_deadline }}</p>
                            </div>
                        @endforeach
                    </div>
                    
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>