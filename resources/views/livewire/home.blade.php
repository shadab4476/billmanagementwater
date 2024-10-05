<section>
    <x-slot name="title">
        Home
    </x-slot>
    @if (session()->has('success'))
        <h2 class="text-white py-2  text-center px-5 bg-green-500">{{ session()->get('success') }} </h2>
    @endif
    @if (session()->has('error'))
        <h2 class="text-white py-2  text-center px-5 bg-red-500">{{ session()->get('error') }} </h2>
    @endif

    <h1 class="text-3xl font-bold"><span class="capitalize block">Name: {{ auth()->check() ? auth()->user()->name : '' }}
        </span> Home Page...</h1>

    @role(['superAdmin', "admin"])
        admin|superAdmin
    @endrole
    @role('user')
        user
    @endrole

</section>
