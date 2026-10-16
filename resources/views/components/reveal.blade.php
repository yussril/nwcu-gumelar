@props([
    'as' => 'div',
    'delay' => 0,
])

{{--
    Animasi pembuka halaman, sama dengan section hero & statistik di beranda.
    Berikan nilai $delay (ms) berbeda tiap blok agar efeknya berundain.
--}}
<{{ $as }} {{ $attributes->class('opacity-0 animate-fade-up')->merge(['style' => 'animation-delay: '.$delay.'ms; animation-fill-mode: forwards;']) }}>
    {{ $slot }}
</{{ $as }}>