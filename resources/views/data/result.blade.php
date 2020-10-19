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
