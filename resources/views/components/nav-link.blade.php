@props(['active'])

@php
$classes = ($active ?? false)
            ? 'items-center px-1 py-2 m-0 border-b-2 text-sm font-medium leading-5 text-white border-gray-300 bg-gray-600 rounded-r-sm focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
            : 'items-center px-1 py-2 m-0 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:bg-gray-600 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
