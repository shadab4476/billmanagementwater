<div>
    <div class="flex justify-between flex-wrap items-end  ">
        <div wire:ignore class=" flex items-center gap-2">
            <x-form-label label_for="perPage" input_label_class="mb-0" input_label="Per Page" />

            <select class="w-full" wire:model.live="perPage" id="perPage">
                @foreach ($validPerPageOptions as $option)
                    <option value="{{ $option }}">{{ $option }}</option>
                @endforeach
            </select>
            @error('perPage')
                <div class="text-red-500">{{ $message }}</div>
            @enderror

        </div>
        {{-- <div class="">
            <button type="button" wire:click="getAlls" wire:loading.attr="disabled"
                wire:target="getAlls"
                class="py-3 px-8 hover:bg-green-600 transition-all capitalize bg-green-500 text-slate-50 rounded ">
                {{ !$getAll ? 'get all' : 'current month' }}
            </button>
        </div> --}}
        {{-- <div class="maintenanceDate flex-wrap  flex justify-between items-end ">
            <div class="">
                <x-form-label label_for="startDate" input_label_class="inline-block" input_label="Start Date" />
                <x-form-input id="startDate" wire:model.live="startDate" class="" type="text" />
                @error('startDate')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="">
                <x-form-label label_for="endDate" input_label_class="inline-block" input_label="End Date" />
                <x-form-input id="endDate" wire:model.live="endDate" class="" type="text" />
                @error('endDate')
                    <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div> --}}
        <div class="searchBar">
            <x-form-input id="search" wire:model.live="search" placeholder="Search" type="text" />
            @error('search')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
