<div>
    <div class="flex flex-wrap justify-center space-x-2 space-y-2 sm:space-y-0 sm:flex-row">
        @php
        $rowData = json_encode($row);
        $rowData1 = json_encode($row);
        @endphp
        <a class="px-2 py-2 ml-2 text-xs font-bold text-white bg-green-600 rounded-lg hover:bg-green-700 hover:no-underline" 
        href="{{route('doctor.consulta.show', $row)}}">
            <i class="fa fa-eye"> </i>
        </a>
        <a class="px-2 py-2 ml-2 text-xs font-bold text-white bg-blue-600 rounded-lg hover:bg-blue-700 hover:no-underline"
            href="{{ route('doctor.consulta.create', ['id' => $row->id]) }}">
            <i class="fa fa-pen"></i>
        </a>
        <a class="px-2 py-2 ml-2 text-xs font-bold text-white bg-red-600 rounded-lg hover:bg-red-700 hover:no-underline"
                wire:click="confirm({{ $rowData }})">
            <i class="fa fa-trash"></i>
        </a>
    </div>
</div>
