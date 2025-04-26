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
        Users </x-slot>
    {{-- title end --}}

    {{-- user main model start --}}
    @if ($isActive->count() > 0)
        <span wire:poll.5s="getStatus" class="invisible hidden opacity-0">{{ $time }}</span>
    @endif
    @if ($modelmain == true)
        <div class="fixed overflow-y-scroll top-[50%] left-0 bg-black -translate-y-[50%] z-50 h-full w-full ">
            <div class=" mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="bg-gray-50 shadow-md rounded-lg p-8">

                    <div class="flex justify-center items-center">
                        @if ($editModelUser == false)
                            <div class="w-[100%]  lg:w-[50%]  mt-2 mx-auto">
                                <h2 class="text-xl font-semibold text-gray-800 mb-6">Create User</h2>
                                {{-- create form --}}
                                <form class="space-y-4 w-full md:space-y-6" wire:submit.prevent="register">
                                    <div>
                                        <x-form-label star="true" label_for="name" input_label="Name" />
                                        <x-form-input id="name" input_label="Name" class=""
                                            wire:model.live="name" placeholder="Name" type="text" required />
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
                                            <button type="button"
                                                class="absolute -translate-y-1/2 top-1/2 right-[20px]"
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

                                        <x-form-button button_text="Create an account" class="!w-[50%]"
                                            button_type="submit" target="register" />
                                    </div>
                                </form>
                            </div>
                        @else
                            {{-- update form --}}

                            <div class="w-[100%]  lg:w-[50%]  mt-2 mx-auto">
                                <h2 class="lg:text-3xl text-2xl font-bold text-center xl:text-4xl">
                                    {{ $name }}
                                    Profile Update</h2>
                                <form class="space-y-4 w-full md:space-y-6" wire:submit.prevent="updateUser">

                                    <div>
                                        <x-form-label star="true" label_for="name" input_label="Name" />
                                        <x-form-input id="name" input_label="Name" class=""
                                            wire:model.live="name" placeholder="Name" type="text" required />
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
            </div>
        </div>
    @endif



    {{-- user main model end --}}

    {{-- delete model start --}}
    <div>
        <!-- Modal Background Overlay -->
        @if ($showDeleteModal)
            <x-delete-model message="{{ empty($user_select) || $user_id ? 'this User' : 'Selected User' }}"
                closeModel="closeDeleteModal" delete="deleteUser" />
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
        <div class="flex justify-between items-center ">
            @auth
                @role(['superAdmin', 'admin'])
                    @can('create.user')
                        <h3 class="text-2xl font-bold ">Users</h3>
                        <button wire:click="exportPdf" type="button" @if (!$users || $users->isEmpty()) disabled @endif
                            wire:loading.attr="disabled"
                            class="py-3 px-8   hover:bg-green-400 transition-all bg-green-500 text-slate-50 rounded mb-2">
                            <span class="w-full flex justify-between items-center" wire:loading.remove wire:target="exportPdf">PDF
                                <img class="w-[20px] h-[20px]" src="{{ asset('/assets/images/app/downloadImage.png') }} "
                                    alt="download image for PDF"></span>

                            <div wire:loading wire:target="exportPdf" role="status">
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
                        </button><button wire:click="mainModelOpen" type="button"
                            class="py-3 px-8 hover:bg-green-400 transition-all bg-green-500 text-slate-50 rounded mb-2">Create
                        </button>
                        <h4 class="py-3 px-8 text-green-400 transition-all font-bold  rounded mb-2">
                            {{ $this->countUser ?? 'fetching....' }}
                        </h4>
                        @if (!empty($user_select))
                            <button type="button" wire:click="openDeleteModel" {{ empty($user_select) ? 'disabled' : '' }}
                                class="py-3 px-8 hover:bg-red-600 transition-all bg-red-500 text-slate-50 rounded mb-2">Delete All
                            </button>
                        @endif
                    @endcan
                @endrole
            @endauth
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
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Name </th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Email</th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Phone</th>
                        <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Role</th>
                        @auth
                            @role(['superAdmin', 'admin'])
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
                            <td><input type="checkbox" value="{{ $user->id }}" wire:model.live="user_select">
                            </td>
                            <td class="px-6 text-center py-4">{{ $user->id ? $user->id : '-' }}</td>
                            <td class="px-6 text-center py-4">{{ $user->name ? $user->name : '-' }}</td>
                            <td class="px-6 text-center py-4">{{ $user->email ? $user->email : '-' }}</td>
                            <td class="px-6 text-center py-4">{{ $user->phone ? $user->phone : '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                @foreach ($user->roles as $role)
                                    <span
                                        class="font-medium capitalize {{ $role->name == 'admin' ? 'text-green-600' : ($role->name == 'user' ? 'text-red-500' : ($role->name == 'superAdmin' ? 'text-blue-500' : '')) }}">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>
                            @auth
                                @role(['superAdmin', 'admin'])
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
                                    @role(['superAdmin', 'admin'])
                                        @can('edit.user')
                                            <button type="button" wire:click="editUser({{ $user->id }})"
                                                class="hover:bg-green-400 transition-all origin-bottom-left bg-green-500 px-3 py-1 text-slate-50 rounded">Edit
                                            </button>
                                        @endcan
                                    @endrole
                                @endauth
                                @auth
                                    @role(['superAdmin', 'admin'])
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
        <div class="flex justify-start gap-x-2">
            {{ $users->links() }}
            {{-- {{ $users->links('pagination::tailwind') }} --}}
        </div>
    </div>

    <script>
        function initializeSelete2() {

            $('#perPage').select2({
                allowClear: true
            });
            $('#perPage').on('change', function(e) {
                var perPage_data = $('#perPage').val();
                @this.set('perPage', perPage_data);
            });
        }
        initializeSelete2();
    </script>
</section>
