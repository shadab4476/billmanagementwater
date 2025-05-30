<section class="heroSectionHomepage  ">
    {{-- this slot is without container class --}} @slot('container')
        w-full
    @endslot
    <x-slot name="title">
        Home
    </x-slot>
    @if (session()->has('success'))
        <h2 class="text-white py-2  text-center px-5 bg-green-500">{{ session()->get('success') }} </h2>
    @endif
    @if (session()->has('error'))
        <h2 class="text-white py-2  text-center px-5 bg-red-500">{{ session()->get('error') }} </h2>
    @endif
    {{-- 
@php
$a=10;
$b;
$c;
$b=$a++;
$c=$a;
echo $a.$b.$c;
@endphp --}}

    <div class="homeBackgroundImage  md:py-[250px] topSection">
        <div class="mx-auto container px-5">
            <div class="w-full ">
                <h1 class="mb-5 text-blue-700 text-center font-bold md:text-[80px] leading-none	 text-4xl">Pure & Healthy
                    Water
                </h1>
                <div class="btnBoxMain text-center   relative">
                    <a class="relative btnMain inline-block text-center px-10 py-3 lg bg-red-700"
                        href="{{ route('home') }}" wire:navigate>
                        <div class="btn_web_round absolute rounded-lg"></div>
                        <span class="btn_web_txt font-bold">Order Now</span>
                    </a>
                </div>
            </div>
        </div>
    </div>


    <img src="{{ asset('assets/images/app/hdw_2cup_bg.jpg') }}" alt="">
    <img src="{{ asset('assets/images/app/hdw_cup_bottol.jpg') }}" alt="">
    <img src="{{ asset('assets/images/app/hdw_cup_water.jpg') }}" alt="">
    <img src="{{ asset('assets/images/app/hdw_1cup.jpg') }}" alt="">
    {{-- <img class="w-full" src="{{ asset('assets/images/app/water_main_bg_webapp.jpg') }}" alt="">
    <img class="w-full" src="{{ asset('assets/images/app/water_bg_main.jpg') }}" alt="">
    <img class="w-full" src="{{ asset('assets/images/app/water_bg_bottle_little.jpg') }}" alt=""> --}}
    {{-- <h1 class="text-3xl font-bold"><span class="capitalize block">Name:
            {{ auth()->check() ? auth()->user()->name : '' }}
        </span> Home Page...</h1>
    <input type="checkbox" wire:model.live="test"> --}}
    {{--    

    @role(['superAdmin', 'admin'])
        admin|superAdmin
    @endrole
    @role('user')
        user
    @endrole --}}

</section>
