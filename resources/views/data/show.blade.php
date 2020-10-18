<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-10">
                    <div class="grid grid-cols-3">
                        <div class="md:col-span-1 sm:col-span-3 pr-8">
                            <div class="py-3">
                                <p class="font-black">Keywords</p>
                                <textarea class="resize-none border border-gray-900 focus:border-blue-600 text-gray-900 focus:text-blue-600 w-full" rows="4"></textarea>
                                <p>Clear All</p>
                            </div>
                            <div>
                                <p class="font-black">NAICS</p>
                                <textarea class="resize-none border border-gray-900 focus:border-blue-600 text-gray-900 focus:text-blue-600 w-full" rows="4"></textarea>
                                <p>Clear All</p>
                            </div>
                        </div>
                        <div class="md:col-span-2 sm:col-span-3">
                            {{ $data->links() }}
        
                            <div class="divide-y divide-gray-400">
                                @foreach ($data as $element)
                                    <div class="text-left py-2">
                                    <a class="text-blue-700 font-black text-2xl text-opacity-100 hover:text-orange-700" href="{{ $element->link }}">{{ $element->title }}</a>
                                        <p class="py-5">{{ $element->description }}</p>
                                        <div class="pb-3">
                                            <p class="font-bold">Notice ID</p>
                                            <p>{{ $element->notice_id }}</p>
                                        </div>
                                        <div>
                                            <p class="font-bold">Department/Ind.Agency</p>
                                            <p class="text-blue-700">{{ $element->department }}</p>
                                        </div>
                                        <div>
                                            <p class="font-bold">Sub-tier</p>
                                            <p class="text-blue-700">{{ $element->sub_tier }}</p>
                                        </div>
                                        <div class="pb-3">
                                            <p class="font-bold">Office</p>
                                            <p>{{ $element->office }}</p>
                                        </div>
                                        <p><span class="font-bold">Current Response Date: </span>{{ $element->response_deadline }}</p>
                                    </div>
                                @endforeach
                            </div>
                            
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>