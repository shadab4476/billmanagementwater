<section>
    <span wire:poll.5000ms class="invisible hidden opacity-0">{{ $time }}</span>

    @if ($modelmain == true)
        <div class="fixed overflow-y-scroll top-[50%] left-0 bg-zinc-400 -translate-y-[50%] h-full w-full ">

            <div class="flex justify-center items-center">
                @if ($editModelShop == false)
                    {{-- create form --}}
                    <div class="w-[30%] mx-5">
                        <h1 class="lg:text-3xl text-2xl font-bold text-center xl:text-4xl ">Create Shop</h1>
                        <div class="w-full mt-2 mx-auto">
                            <form class="space-y-4 w-full md:space-y-6" wire:submit.prevent="shopCreate">
                                <div>
                                    <label for="shop_name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Shop Name <span class="text-red-500">*</span></label>
                                    </label>
                                    <input type="text" wire:model.live="shop_name" id="shop_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="shop_name">
                                    @error('shop_name')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="shop_image"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Shop Image</label>
                                    <input type="file" accept=".jpeg,.jpg,.png" wire:model.live="shop_image"
                                        id="shop_image"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="1234567890">
                                    @error('shop_image')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="shop_address"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shop
                                        Address <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model.live="shop_address" id="shop_address"
                                        placeholder="xyz..."
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    @error('shop_address')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="shop_description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shop
                                        Description</label>
                                    <textarea wire.model.live="shop_description"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        id="shop_description" placeholder="Message" cols="30" class="w-full" rows="2"></textarea>
                                    @error('shop_description')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex justify-between">
                                    <button type="submit"
                                        class="w-1/2 text-white bg-black hover:opacity-90 transition-all focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        <span class="" wire:loading.remove wire:target="shopCreate">Create
                                            Shop</span>
                                        <div wire:loading wire:target="shopCreate" role="status">
                                            <span class="">Loading...</span>
                                            <svg aria-hidden="true"
                                                class="inline w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-500"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                        </div>
                                    </button> <button type="button" class="px-7 bg-red-600 text-slate-50 rounded py-3"
                                        wire:click="mainModelClose">Close</button>
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
                                    <label for="shop_name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Shop Name <span class="text-red-500">*</span></label>
                                    </label>
                                    <input type="text" value="shop_name" wire:model.live="shop_name" id="shop_name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="shop_name">
                                    @error('shop_name')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="flex items-center  justify-between">
                                    <div class="md:w-[70%] w-full">
                                        <label for="shop_image"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            Shop Image</label>
                                        <input type="file" value="shop_image" accept=".jpeg,.png,.jpg"
                                            wire:model.live="shop_image" id="shop_image"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="1234567890">
                                        @error('shop_image')
                                            <div class="text-red-500">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="md:w-[30%] w-full">
                                        @if ($oldImage)
                                            <img class="w-[70px] h-[70px] object-contain block mx-auto " width="50px"
                                                height="50px" src="{{ asset('storage/assets/images/' . $oldImage) }}"
                                                alt="">
                                        @else
                                            -
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <label for="shop_address"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shop
                                        Address <span class="text-red-500">*</span></label>
                                    <input type="text" value="shop_address" wire:model.live="shop_address"
                                        id="shop_address" placeholder="xyz..."
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                    @error('shop_address')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="shop_description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shop
                                        Description</label>
                                    <textarea wire:model.live="shop_description"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:outline-none block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        id="shop_description" placeholder="Message" cols="30" class="w-full" rows="2">{{ $shop_description }}</textarea>
                                    @error('shop_description')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="flex justify-between ">
                                    <button type="submit"
                                        class="w-1/2 text-white bg-black hover:opacity-90 transition-all focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-3 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        <span class="" wire:loading.remove wire:target="shopUpdate">Update
                                            Shop</span>
                                        <div wire:loading wire:target="shopUpdate" role="status">
                                            <span class="">Loading...</span>
                                            <svg aria-hidden="true"
                                                class="inline w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-500"
                                                viewBox="0 0 100 101" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                        </div>
                                    </button>
                                    <button type="button" class="px-7 bg-red-600 text-slate-50 rounded py-3"
                                        wire:click="mainModelClose">Close</button>
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
            <div class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75"></div>

            <!-- Modal Box -->
            <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                    <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
                    <p class="text-sm text-gray-600 mb-4">Are you sure you want to delete this Shop? This action cannot
                        be undone.</p>

                    <div class="flex justify-end space-x-4">
                        <!-- Cancel Button -->
                        <button wire:click="closeDeleteModal"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                            Cancel
                        </button>

                        <!-- Confirm Delete Button -->
                        <button wire:click="deleteShop"
                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
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
                        <tr
                            class="border-b odd:bg-gray-100 even:bg-white border-gray-200 hover:odd:bg-white hover:even:bg-gray-100">
                            <td class="px-6 text-center py-4">{{ $shop->id ? $shop->id : '-' }}</td>
                            <td class="px-6 text-center py-4">{{ $shop->users->name ? $shop->users->name : '-' }}
                            </td>
                            @auth
                                @role('admin')
                                    @forelse($isActive as $activeUser)
                                        @if ($shop->id == $activeUser->id)
                                            <td
                                                class="px-6 text-center  {{ $activeUser->status == 1 ? ' text-green-500' : 'text-gray-500' }} font-bold py-4">
                                                {{ $activeUser->status == 1 ? 'Running' : 'Closed' }} </td>
                                        @endif
                                    @empty
                                        <td class="px-6 text-center py-4">{{ '-' }}
                                    @endforelse
                                @endrole
                            @endauth
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
                            <td class="text-center px-4 py-4">
                                <button type="button" wire:click="editShop({{ $shop->id }})"
                                    class="hover:bg-green-400 transition-all origin-bottom-left bg-green-500 px-3 py-1 text-slate-50 rounded">Edit
                                </button>
                                @auth
                                    @role('admin')
                                        <button type="button" wire:click="openDeleteModel({{ $shop->id }})"
                                            class="hover:bg-red-400 transition-all origin-bottom-left bg-red-500 px-3 py-1 text-slate-50 rounded">Delete
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

        </div>
    </section>
