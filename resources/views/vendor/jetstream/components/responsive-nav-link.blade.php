@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block pl-3 pr-4 py-2 border-l-4 border-blue-700 text-base font-medium bg-transparent focus:outline-none focus:text-blue-900 transition duration-150 ease-in-out'
                : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium focus:outline-none focus:text-gray-10 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
