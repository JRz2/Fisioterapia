<div>
    <div>
        <div class="flex flex-wrap justify-center space-x-2 space-y-2 sm:space-y-0 sm:flex-row">
            <a class="flex items-center px-3 py-2 text-xs font-bold text-white bg-blue-600 border border-red-100 rounded-lg shadow hover:bg-red-700 transition duration-300 ease-in-out transform hover:scale-105"
                href="{{ url('/doctor/reporte/pdf/' . $row->id) }}">
                <i class="fa fa-file-pdf text-lg mr-1"></i>
            </a>
        </div>        
    </div>
</div>
