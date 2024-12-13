<div>
    <div class="flex flex-wrap justify-center space-x-2 space-y-2 sm:space-y-0 sm:flex-row">
        @php
            $rowData = json_encode($row);
        @endphp

        <a class="px-2 py-2 ml-2 text-xs font-bold text-white bg-red-600 rounded-lg hover:bg-red-700 hover:no-underline"
            wire:click="confirm({{ $rowData }})">
            <i class="fa fa-trash"></i>
        </a>
    </div>
</div>
