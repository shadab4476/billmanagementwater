<section>
    {{-- user main model start --}}
    @if ($isActive->count() > 0)
        <span wire:poll.5000ms class="invisible hidden opacity-0">{{ $time }}</span>
    @endif
    @if ($modelmain == true)
        <div class="fixed overflow-y-scroll top-[50%] left-0 bg-zinc-400 -translate-y-[50%] z-50 h-full w-full ">
            <div class="flex justify-center items-center">
                @if ($editModelUser == false)
                    <div class="w-[30%]  mt-2 mx-auto">
                        {{-- create form --}}
                        <form class="space-y-4 w-full md:space-y-6" wire:submit.prevent="register">
                            <div>
                                <x-form-label star="true" label_for="name" input_label="Name" />
                                <x-form-input id="name" input_label="Name" class="" wire:model.live="name"
                                    placeholder="Name" type="text" required />
                                @error('name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <x-form-label star="true" label_for="email" input_label="Email" />
                                <x-form-input id="email" input_label="Email" wire:model.live="email"
                                    placeholder="name@company.com" type="email" required />
                                @error('email')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <x-form-label star="true" label_for="phone" input_label="Phone" />
                                <x-form-input id="phone" wire:model.live="phone" placeholder="1234567890"
                                    type="number" required />
                                @error('phone')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="relative">
                                <x-form-label star="true" label_for="password" input_label="Password" />
                                <div class="relative">
                                    <input type="{{ $passwordType }}" wire:model="password" id="password"
                                        placeholder="••••••••"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <button type="button" class="absolute -translate-y-1/2 top-1/2 right-[20px]"
                                        wire:click="typeToggle">
                                        <span id="eyeIcon"
                                            class="block">{{ $passwordType == 'password' ? '👁️' : '🙈 ' }}</span>
                                        <!-- Eye icon for toggle -->
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="button" class="px-7 bg-red-600 text-slate-50 rounded py-2"
                                    wire:click="mainModelClose">Close</button>

                                <x-form-button button_text="Create an account" class="!w-[50%]" button_type="submit"
                                    target="register" />
                            </div>
                        </form>
                    </div>
                @else
                    {{-- update form --}}

                    <div class="w-[30%]  mt-2 mx-auto">
                        {{-- create form --}}
                        <form class="space-y-4 w-full md:space-y-6" wire:submit.prevent="updateUser">
                            <h1 class="lg:text-3xl text-2xl font-bold text-center xl:text-4xl">{{ $name }}
                                Profile Update</h1>
                            <div>
                                <x-form-label star="true" label_for="name" input_label="Name" />
                                <x-form-input id="name" input_label="Name" class="" wire:model.live="name"
                                    placeholder="Name" type="text" required />
                                @error('name')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <x-form-label star="true" label_for="email" input_label="Email" />
                                <x-form-input id="email" input_label="Email" wire:model.live="email"
                                    placeholder="name@company.com" type="email" required />
                                @error('email')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <x-form-label star="true" label_for="phone" input_label="Phone" />
                                <x-form-input id="phone" wire:model.live="phone" placeholder="1234567890"
                                    type="number" required />
                                @error('phone')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="flex items-center justify-between">
                                <button type="button" class="px-7 bg-red-600 text-slate-50 rounded py-2"
                                    wire:click="mainModelClose">Close</button>
                                <x-form-button class="!w-1/2" button_text="Update" button_type="submit"
                                    target="updateUser" />
                            </div>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    @endif



    {{-- user main model end --}}

    {{-- delete model start --}}
    <div>
        <!-- Modal Background Overlay -->
        @if ($showDeleteModal)
            <x-delete-model message="User" closeModel="closeDeleteModal" delete="deleteUser" />
        @endif
    </div>
    {{-- delete model end --}}

    @if (session()->has('success'))
        <h2 class="text-white py-2  text-center px-5 bg-green-500">{{ session()->get('success') }} </h2>
    @endif
    @if (session()->has('error'))
        <h2 class="text-white py-2  text-center px-5 bg-red-500">{{ session()->get('error') }} </h2>
    @endif
    <div class="w-full">
        <div class="flex justify-between ">
            @auth
                @role('admin')
                    @can('create.user')
                        <button wire:click="mainModelOpen" type="button"
                            class="py-3 px-8 hover:bg-green-400 transition-all bg-green-500 text-slate-50 rounded mb-2">Create
                        </button>
                    @endcan
                @endrole
            @endauth
        </div>
        <div class="overflow-x-auto w-full">
            <table class="min-w-full  bg-white border border-gray-200">
                <thead class="w-full">
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">ID</th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Name </th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Email</th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Phone</th>
                        @auth
                            @role('admin')
                                <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Status</th>
                            @endrole
                        @endauth
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody class="w-full">

                    @forelse ($users as $user)
                        <!-- Example row -->
                        <tr class="border-b odd:bg-white  even:bg-gray-100   border-gray-200  hover:bg-gray-200">
                            <td class="px-6 text-center py-4">{{ $user->id ? $user->id : '-' }}</td>
                            <td class="px-6 text-center py-4">{{ $user->name ? $user->name : '-' }}</td>
                            <td class="px-6 text-center py-4">{{ $user->email ? $user->email : '-' }}</td>
                            <td class="px-6 text-center py-4">{{ $user->phone ? $user->phone : '-' }}</td>
                            @auth
                                @role('admin')
                                    @foreach ($isActive as $activeUser)
                                        @if ($user->id == $activeUser->id)
                                            <td
                                                class="px-6 text-center  text-{{ $activeUser->status == 1 ? 'green-500' : 'yellow-500' }} font-bold py-4">
                                                {{ $activeUser->status == 1 ? 'Active' : 'Inactive' }} </td>
                                        @endif
                                    @endforeach
                                @endrole
                            @endauth

                            <td class="text-center px-4 py-4">
                                @auth
                                    @role('admin')
                                        @can('edit.user')
                                            <button type="button" wire:click="editUser({{ $user->id }})"
                                                class="hover:bg-green-400 transition-all origin-bottom-left bg-green-500 px-3 py-1 text-slate-50 rounded">Edit
                                            </button>
                                        @endcan
                                    @endrole
                                @endauth
                                @auth
                                    @role('admin')
                                        @can('delete.user')
                                            <button type="button" wire:click="openDeleteModel({{ $user->id }})"
                                                class="hover:bg-red-400 transition-all origin-bottom-left bg-red-500 px-3 py-1 text-slate-50 rounded">Delete
                                            </button>
                                        @endcan
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
        {{-- {{ $users->links() }} --}}
        <div class="flex justify-start gap-x-2">
            {{ $users->links('pagination::tailwind') }}
        </div>
    </div>

</section>
