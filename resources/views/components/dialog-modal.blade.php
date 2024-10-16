@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-3">
        <div class="text-lg font-medium text-gray-900">
            {{ $title }}
        </div>

        <div class="text-sm text-gray-600">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-2 py-2 bg-gray-100 text-end">
        {{ $footer }}
    </div>
</x-modal>
