<div>
    <x-slot name="title">
        Home
    </x-slot>
    <h1 class="text-3xl font-bold"><span class="capitalize block">Name: {{ auth()->check() ? auth()->user()->name : '' }}
        </span> I AM Home Component...</h1>

    @role('admin')
        admin
    @endrole
    @role('user')
        user
    @endrole

</div>
