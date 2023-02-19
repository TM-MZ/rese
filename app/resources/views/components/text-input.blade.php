@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'mx-2 w-full border-t-0 border-r-0 border-l-0 border-b-2 border-gray-400 focus:outline-none focus:ring-indigo-300 rounded-none shadow-sm']) !!}>