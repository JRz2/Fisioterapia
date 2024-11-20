<div class="w-full flex justify-center">
    <div class="card card-outline card-primary shadow-lg rounded-lg w-11/12 sm:w-10/12 md:w-7/12 lg:w-7/12">
        <div class="card-body flex flex-col items-center text-center p-4">
            @if (strpos($user->imagen, 'image/') !== false)
                <img src="{{ asset($user->imagen) }}" class="rounded-full w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48 lg:w-56 lg:h-56 object-cover mb-4">
            @else
                <img src="{{ asset('storage/app/public/' . $user->imagen) }}" class="rounded-full w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48 lg:w-56 lg:h-56 object-cover mb-4">
            @endif
            <div>
                <label class="text-lg font-semibold text-gray-800">{{ $user->name }}</label>
            </div>
            <div>
                <label class="text-sm text-gray-600">{{ $user->email }}</label>
            </div>
        </div>
        <div class="card-footer flex justify-center">
            @livewire('user-edit', ['userId' => $user->id])
        </div>
        <div class="card-footer flex justify-center">
            @livewire('update-password', ['userId' => $user->id])
        </div>
    </div>
</div>

