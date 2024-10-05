<section>
    @if ($isActive->count() > 0)
        <span wire:poll.5000ms class="invisible hidden opacity-0">{{ $time }}</span>
    @endif
    @if ($modelmain == true)
        <div class="fixed overflow-y-scroll top-[50%] left-0 bg-zinc-400 z-50 -translate-y-[50%] h-full w-full ">

            <div class="flex justify-center items-center">
                @if ($editModelShop == false)
                    {{-- create form --}}
                    <div class="w-[30%] mx-5">
                        <h1 class="lg:text-3xl text-2xl font-bold text-center xl:text-4xl ">Create Shop</h1>
                        <div class="w-full mt-2 mx-auto">
                            <form class="space-y-4 w-full md:space-y-6" wire:submit.prevent="shopCreate">

                                <div>
                                    <x-form-label label_for="shop_name" star="true" input_label="Shop Name" />
                                    <x-form-input id="shop_name" wire:model.live="shop_name" placeholder="xyz..."
                                        type="text" />
                                    @error('shop_name')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-form-label label_for="shop_image" input_label="Shop Image" />

                                    <input type="file" accept=".jpeg,.jpg,.png" wire:model.live="shop_image"
                                        id="shop_image"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="1234567890">
                                    @error('shop_image')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-form-label label_for="shop_address" star="true" input_label="Shop Address" />
                                    <x-form-input id="shop_address" wire:model.live="shop_address" placeholder="xyz..."
                                        type="text" />
                                    @error('shop_address')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <x-form-label label_for="shop_description" input_label="Shop Description" />
                                    <x-form-input id="shop_description" wire:model.live="shop_description"
                                        placeholder="Shop Description" type="text" />
                                    @error('shop_description')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="flex items-center justify-between ">
                                    <button type="button" class="px-7 bg-red-600 text-slate-50 rounded py-2"
                                        wire:click="mainModelClose">Close</button>
                                    <x-form-button button_text="Create" button_type="submit" class="!w-1/2"
                                        target="shopCreate" />
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- update form --}}

                    <div class="w-[30%] mx-5">
                        <h1 class="lg:text-3xl text-2xl font-bold text-center xl:text-4xl">Update Shop</h1>
                        <div class="w-full mt-2 mx-auto">
                            <form class="space-y-4 w-full md:space-y-6" wire:submit.prevent="shopUpdate">
                                <div>
                                    <x-form-label label_for="shop_name" star="true" input_label="Shop Name" />
                                    <x-form-input id="shop_name" wire:model.live="shop_name" placeholder="xyz..."
                                        type="text" />
                                    @error('shop_name')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-form-label label_for="shop_image" input_label="Shop Image" />

                                    <input type="file" accept=".jpeg,.jpg,.png" wire:model.live="shop_image"
                                        id="shop_image"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="1234567890">
                                    @error('shop_image')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <x-form-label label_for="shop_address" star="true" input_label="Shop Address" />
                                    <x-form-input id="shop_address" wire:model.live="shop_address" placeholder="xyz..."
                                        type="text" />
                                    @error('shop_address')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <x-form-label label_for="shop_description" input_label="Shop Description" />
                                    <x-form-input id="shop_description" wire:model.live="shop_description"
                                        placeholder="Shop Description" type="text" />
                                    @error('shop_description')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex items-center justify-between ">
                                    <button type="button" class="px-7 bg-red-600 text-slate-50 rounded py-2"
                                        wire:click="mainModelClose">Close</button>
                                    <x-form-button button_text="Update" button_type="submit" class="!w-1/2"
                                        target="shopUpdate" />
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    @endif
    @if (session()->has('success'))
        <h2 class="text-white py-2  text-center px-5 bg-green-500">{{ session()->get('success') }} </h2>
    @endif
    @if (session()->has('error'))
        <h2 class="text-white py-2  text-center px-5 bg-red-500">{{ session()->get('error') }} </h2>
    @endif
    {{-- delete model start --}}
    <div>
        <!-- Modal Background Overlay -->
        @if ($showDeleteModal)
            <x-delete-model message="Shop" delete="deleteShop" closeModel="closeDeleteModal" />
        @endif
        @if ($showStatusModal)
            <x-status-model checkId="{{ $status }}" closeStatusModel="closeStatusModal"
                updateStatus="updateStatus" />
            {{-- status Model --}}
        @endif


    </div>
    {{-- delete model end --}}

    <div class="w-full">
        <div class="flex justify-between ">
            <button wire:click="mainModelOpen" type="button"
                class="py-3 px-8 hover:bg-green-400 transition-all bg-green-500 text-slate-50 rounded mb-2">Create</button>
        </div>
        <div class="overflow-x-auto w-full">
            <table class="min-w-full  bg-white border border-gray-200">
                <thead class="w-full">
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">ID</th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">User </th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Shop Status</th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Shop Name</th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Shop Image</th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Shop Address</th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Shop Description</th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="w-full">

                    @forelse ($shops as $shop)
                        <!-- Example row -->
                        <tr class="border-b odd:bg-white  even:bg-gray-100   border-gray-200  hover:bg-gray-200">
                            <td class="px-6 text-center py-4">{{ $shop->id ? $shop->id : '-' }}</td>
                            <td class="px-6 text-center py-4">{{ $shop->users->name ? $shop->users->name : '-' }}
                            </td>
                            @forelse($isActive as $activeUser)
                                @if ($shop->id == $activeUser->id)
                                    <td
                                        class="px-6 text-center  {{ $activeUser->status == 0 ? 'text-yellow-500' : ($activeUser->status == 1 ? 'text-green-500' : ($activeUser->status == 2 ? 'text-red-500' : 'Unknown')) }} font-bold py-4">
                                        {{ $activeUser->status == 0 ? 'Pending' : ($activeUser->status == 1 ? 'Running' : ($activeUser->status == 2 ? 'Closed' : 'Unknown')) }}
                                    </td>
                                @endif
                            @empty
                                <td class="px-6 text-center py-4">{{ '-' }}
                            @endforelse
                            <td class="px-6 text-center py-4">{{ $shop->shop_name ? $shop->shop_name : '-' }}</td>
                            <td class="px-6 text-center py-4">
                                @if ($shop->shop_image)
                                    <img class="w-[70px] h-[70px] object-contain block mx-auto " width="50px"
                                        height="50px"
                                        src="{{ asset('storage/assets/images/' . $shop->shop_image) }}"
                                        alt="">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 text-center    max-w-xs break-words py-4">
                                {{ $shop->shop_address ? $shop->shop_address : '-' }}</td>
                            <td class="px-6 text-center   max-w-xs break-words py-4">
                                {{ $shop->shop_description ? $shop->shop_description : '-' }}
                            </td>
                            <td class="text-center  flex justify-center items-center gap-1 flex-wrap px-4 py-4">
                                <button type="button" wire:click="editShop({{ $shop->id }})"
                                    class="hover:bg-green-400 transition-all origin-bottom-left bg-green-500 px-3 py-1 text-slate-50 rounded">Edit
                                </button>
                                @auth
                                    @role(['superAdmin', 'admin'])
                                        <button type="button" wire:click="openDeleteModel({{ $shop->id }})"
                                            class="hover:bg-red-400 transition-all origin-bottom-left bg-red-500 px-3 py-1 text-slate-50 rounded">Delete
                                        </button>
                                        <button type="button" wire:click="openStatusModel({{ $shop->id }}, 'status')"
                                            class="bg-blue-500 hover:bg-blue-700transition-all origin-bottom-left px-3 py-1 text-slate-50 rounded">
                                            Status
                                        </button>
                                    @endrole
                                @endauth
                            </td>
                        </tr>
                    @empty
                        <tr class="w-full">
                            <th colspan="8" class="text-center px-6 py-3 font-bold uppercase text-green-700">
                                no record
                                found..!!!
                            </th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="flex justify-start gap-x-2">
            {{ $shops->links('pagination::tailwind') }}
        </div>

    </div>
</section>
