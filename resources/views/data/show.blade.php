<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/jquery.dropdown.css') }}" />
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
                                <input class="resize-none border border-gray-900 focus:border-blue-600 text-gray-900 focus:text-blue-600 w-full" type="text" id="keywords">
                                <p>Clear All</p>
                            </div>
                            <div>
                                <p class="font-black">NAICS</p>
                                {{-- <input class="resize-none border border-gray-900 focus:border-blue-600 text-gray-900 focus:text-blue-600 w-full" type="text" id="naics"> --}}
                                <div class="dropdown-mul-1 w-full">
                                    <select style="display:none" name="" id="" multiple placeholder="Select"> </select>
                                </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
<script src="{{ url('/js/jquery.dropdown.js') }}"></script>
<script type="text/javascript">
    $(function() {
        var json1 = {
            data : [{
                disable: true,
                groupID: 2,
                groupName: 'Group Name',
                id: 1,
                name: 'Joseph Mark Martin',
                selected: false,
            }, {
                disable: true,
                groupID: 2,
                groupName: 'Group Name',
                id: 2,
                name: 'Joseph Mark Martin1',
                selected: false,
            }, {
                disable: true,
                groupID: 2,
                groupName: 'Group Name',
                id: 3,
                name: 'Joseph Mark Martin2',
                selected: false,
            }, {
                disable: true,
                groupID: 2,
                groupName: 'Group Name',
                id: 4,
                name: 'Joseph Mark Martin3',
                selected: false,
            }, ]
        };
        console.log(json1);
        $('.dropdown-mul-1').dropdown({
            data: json1.data,
            limitCount: 40,
            multipleMode: 'label',
            choice: function() {
                // console.log(arguments,this);
            }
        });
        $('#keywords').tagsInput({
            'height': '120px',
            'width': '24vw',
            'interactive': true,
            'defaultText': '',
            'onAddTag': function(tag) {
                console.log("Added a tag: " + tag)
            },
            'onRemoveTag': function(tag) {
                console.log("Removed a tag: " + tag);
            },
            'removeWithBackspace': true,
            'minChars': 2,
            'maxChars': 30,
            'placeholderColor': '#777'
        });
        $('#naics').tagsInput({
            'height': '120px',
            'width': '24vw',
            'interactive': true,
            'defaultText': '',
            'onAddTag': function(tag) {
                console.log("Added a tag: " + tag)
            },
            'onRemoveTag': function(tag) {
                console.log("Removed a tag: " + tag);
            },
            'removeWithBackspace': true,
            'minChars': 2,
            'maxChars': 30,
            'placeholderColor': '#777'
        });
    });
</script>