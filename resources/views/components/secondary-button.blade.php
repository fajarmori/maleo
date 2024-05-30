@props([
    'type' => 'submit',
    'as' => 'button',
])

@if ($as === 'button')
<button type="{{ $type }}" {{ $attributes->merge(['class' => 'text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800']) }} >
    {{ $slot }}
</button>
@else
<a {{ $attributes->merge(['class' => 'inline-block text-white text-center bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800']) }}>
    {{ $slot }}
</a>
@endif