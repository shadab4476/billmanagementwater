<section>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- select2  --}}
    <!-- Include Select2 CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <!-- Include Select2 JS from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- select2 end --}}


    {{-- page title start --}}
    <x-slot name="title">
        Shop </x-slot>
    {{-- title end --}}
    @if ($isActive->count() > 0)
        <span wire:poll.5s="getStatus" class="invisible hidden opacity-0">{{ $time }}</span>
    @endif
    @if ($modelmain == true)
        <div class="fixed overflow-y-scroll top-[50%] left-0 bg-zinc-400 z-50 -translate-y-[50%] h-full w-full ">
            <div class=" mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="bg-gray-50 shadow-md rounded-lg p-8">

                    <div class="flex justify-center items-center">
                        @if ($editModelShop == false)
                            {{-- create form --}}
                            <div class="w-[100%]  lg:w-[50%]  mx-5">
                                <h1 class="lg:text-3xl text-2xl font-bold text-center xl:text-4xl ">Create Shop</h1>
                                <div class="w-full mt-2 mx-auto">
                                    <form class="space-y-4 w-full md:space-y-6" wire:submit.prevent="shopCreate">

                                        <div>
                                            <x-form-label label_for="shop_name" star="true"
                                                input_label="Shop Name" />
                                            <x-form-input autofocus id="shop_name" wire:model.live="shop_name"
                                                placeholder="xyz..." type="text" />
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
                                            <x-form-label label_for="shop_address" star="true"
                                                input_label="Shop Address" />
                                            <x-form-input id="shop_address" wire:model.live="shop_address"
                                                placeholder="xyz..." type="text" />
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

                            <div class="w-[100%]  lg:w-[50%]   mx-5">
                                <h1 class="lg:text-3xl text-2xl font-bold text-center xl:text-4xl">Update Shop</h1>
                                <div class="w-full mt-2 mx-auto">
                                    <form class="space-y-4 w-full md:space-y-6" wire:submit.prevent="shopUpdate">
                                        <div>
                                            <x-form-label label_for="shop_name" star="true"
                                                input_label="Shop Name" />
                                            <x-form-input autofocus id="shop_name" wire:model.live="shop_name"
                                                placeholder="xyz..." type="text" />
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
                                            <x-form-label label_for="shop_address" star="true"
                                                input_label="Shop Address" />
                                            <x-form-input id="shop_address" wire:model.live="shop_address"
                                                placeholder="xyz..." type="text" />
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
            <x-delete-model message="{{ empty($shop_select) || $shop_id ? 'this Shop' : 'Selected Shop' }}"
                delete="deleteShop" closeModel="closeDeleteModal" />
        @endif
        @if ($showStatusModal)
            <x-status-model checkId="{{ $status }}" closeStatusModel="closeStatusModal"
                updateStatus="updateStatus" />
            {{-- status Model --}}
        @endif


    </div>
    {{-- delete model end --}}

    <div class="w-full">
        <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold ">Shops</h3>
            <button wire:click="exportPdfShop" @if (!$shops || $shops->isEmpty()) disabled @endif type="button"
                wire:loading.attr="disabled"
                class="py-3 px-8   hover:bg-green-400 transition-all bg-green-500 text-slate-50 rounded mb-2">
                <span class="w-full flex justify-between items-center" wire:loading.remove
                    wire:target="exportPdfShop">PDF <img class="w-[20px] h-[20px]"
                        src="{{ asset('/assets/images/app/downloadImage.png') }} "
                        alt="download image for PDF"></span>

                <div wire:loading wire:target="exportPdfShop" role="status">
                    <span>Loading...</span>
                    <svg aria-hidden="true"
                        class="inline w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-500"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg ">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                </div>
            </button>
            <button wire:click="mainModelOpen" type="button"
                class="py-3 px-8 hover:bg-green-400 transition-all bg-green-500 text-slate-50 rounded mb-2">Create</button>
            @if (!empty($shop_select))
                <button type="button" wire:click="openDeleteModel" {{ empty($shop_select) ? 'disabled' : '' }}
                    class="py-3 px-8 hover:bg-red-600 transition-all bg-red-500 text-slate-50 rounded mb-2">Delete All
                </button>
            @endif
        </div>
        {{-- filter bar start --}}
        <x-filterbar />

        {{-- filter bar end --}}
        <div class="overflow-x-auto w-full">
            <table class="min-w-full  bg-white border border-gray-200">
                <thead class="w-full">
                    <tr class="bg-gray-100 border-b border-gray-200">

                        <th><input type="checkbox" wire:model.live="selectAll"></th>
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
                            <td><input type="checkbox" value="{{ $shop->id }}" wire:model.live="shop_select">
                            </td>
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
                            <td class="text-center  flex justify-center items-center gap-1  px-4 py-4">
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
            {{-- {{ $shops->links('pagination::tailwind') }} --}}
            {{ $shops->links() }}
        </div>

    </div>

    <script>
        function initializeSelete2() {

            $('#perPage').select2({
                allowClear: false
            });
            $('#perPage').on('change', function(e) {
                var perPage_data = $('#perPage').val();
                @this.set('perPage', perPage_data);
            });
        }
        initializeSelete2();
    </script>
</section>
