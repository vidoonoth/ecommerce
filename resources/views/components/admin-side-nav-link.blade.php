@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#e1c5a6] font-semibold text-base leading-5 text-white focus:outline-none hover:bg-[#8e6e43] transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-semibold text-base leading-5 text-white hover:text-white hover:bg-[#8e6e43] hover:border-[#8e6e60] focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
