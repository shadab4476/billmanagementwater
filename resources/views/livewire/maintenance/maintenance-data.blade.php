<section>
    @auth
        @role('superAdmin')
            {{-- page title start --}}
            <x-slot name="title">
                Maintenance Data </x-slot>
            {{-- title end --}}
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <!-- jQuery UI CSS -->
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <!-- jQuery UI JS -->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
            {{-- end datepicker css --}}

            {{-- select2  --}}
            <!-- Include Select2 CSS from CDN -->
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


            <!-- Include Select2 JS from CDN -->
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            {{-- select2 end --}}

            @if (session()->has('success'))
                <h2 class="text-white py-2  text-center px-5 bg-green-500">{{ session()->get('success') }} </h2>
            @endif
            @if (session()->has('error'))
                <h2 class="text-white py-2  text-center px-5 bg-red-500">{{ session()->get('error') }} </h2>
            @endif
            {{-- delete model --}}

            @if ($showDeleteModal)
                <x-delete-model
                    message="{{ empty($maintenance_select) || $maintenance_id ? 'this Maintenance' : 'Selected Maintenance' }}"
                    delete="deleteMaintenance" closeModel="closeDeleteModal" />
            @endif

            <div class="flex justify-between items-stretch flex-wrap space-y-4">

                <div class="lg:w-[25%] w-full sm:w-full px-6 py-2 bg-white shadow-md  rounded-lg">
                    <h2 class="text-2xl font-bold mb-6">Create Maintenance Bill</h2>
                    <form class="space-y-4 w-full md:items-center md:justify-between md:flex md:flex-wrap "
                        wire:submit.prevent="store">
                        <!-- Bill Date -->
                        <div wire:ignore class="w-full">
                            <x-form-label label_for="type" input_label="Type" star="true" />
                            <select wire:model.live="type" id="type"
                                class="max-w-[100%] w-full text-slate-950 px-3 py-2 border border-gray-300 bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="1" {{ $type == 1 ? 'selected' : '' }}>Income</option>
                                <option value="0">Expense</option>
                            </select>
                            @error('type')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Amount -->

                        <div class="w-full">
                            <x-form-label label_for="amount" input_label="Amount" star="true" />
                            <x-form-input id="amount" wire:model.live="amount" placeholder="Amount" type="number" />
                            @error('amount')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Note -->

                        <div class="w-full">
                            <x-form-label label_for="note" input_label="Note" star="true" />
                            <x-form-input id="note" wire:model.live="note" placeholder="Note" type="text" />
                            @error('note')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- date --}}
                        <div class="w-full">
                            <x-form-label label_for="date" star="true"
                                input_label="Shop Date (Default Date {{ date('Y-m-d') }})" />
                            <x-form-input type="text" wire:model.live="date" id="date" placeholder="yy-mm-dd"
                                readonly />

                            @error('date')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Submit Button -->
                        <div class="flex w-full items-center justify-between ">
                            <button type="button" class="px-7 bg-red-600 text-slate-50 rounded py-2"
                                wire:click="blankInput">Reset</button>
                            <x-form-button button_text="Create" button_type="submit" class="!w-1/2" target="store" />
                        </div>
                    </form>
                </div>

                <div class="lg:w-[73%] w-full  sm:w-full md:w-[100%]">
                    <div class="flex justify-between pb-4 items-center">
                        <h3 class="text-2xl font-bold ">Today's Maintenance Bills</h3>
                        <a wire:navigate href="{{ route('all.maintenance') }}"
                            class="py-3 px-8 hover:bg-green-400 transition-all bg-green-500 text-slate-50 rounded ">Index</a>
                        @if (!empty($maintenance_select))
                            <button type="button" wire:click="openDeleteModel"
                                {{ empty($maintenance_select) ? 'disabled' : '' }}
                                class="py-3 px-8 hover:bg-red-600 transition-all bg-red-500 text-slate-50 rounded mb-2">Delete
                                All
                            </button>
                        @endif
                    </div>
                    <div class="overflow-x-auto w-full">
                        <table class="min-w-full  bg-white border border-gray-200">
                            <thead class="w-full">
                                <tr class="bg-gray-100 border-b border-gray-200">
                                    <th><input type="checkbox" wire:model.live="selectAll"></th>
                                    <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">ID</th>
                                    <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">User Name </th>
                                    <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Type</th>
                                    <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Amount</th>
                                    <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Note</th>
                                    <th class="text-center px-6 py-3 font-bold uppercase text-gray-700"> Date </th>
                                    <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Action</th>
                                </tr>
                            </thead>
                            @auth
                                @role('superAdmin')
                                    <tbody class="w-full">
                                        @forelse ($maintenances as $maintenance)
                                            <!-- Example row -->
                                            <tr class="border-b odd:bg-white  even:bg-gray-100   border-gray-200  hover:bg-gray-200">
                                                <td><input type="checkbox" value="{{ $maintenance->id }}"
                                                        wire:model.live="maintenance_select"></td>
                                                <td class="px-6 text-center py-4">{{ $maintenance->id ? $maintenance->id : '-' }}</td>
                                                <td class="px-6 text-center py-4">
                                                    {{ $maintenance->users->name }}
                                                </td>
                                                <td class="px-6 text-center py-4">
                                                    <span
                                                        class="font-medium {{ $maintenance->type == 1 ? 'text-green-500' : 'text-red-500' }}">{{ $maintenance->type == 1 ? 'Income' : 'Expense' }}</span>
                                                </td>
                                                <td class="px-6 text-center py-4">
                                                    {{ $maintenance->amount ? $maintenance->amount : '-' }}</td>
                                                <td class="px-6 text-center py-4">{{ $maintenance->note ? $maintenance->note : '-' }}
                                                </td>
                                                <td class="px-6 text-center py-4">{{ $maintenance->date ? $maintenance->date : '-' }}
                                                </td>



                                                <td class="text-center px-4 py-4">
                                                    {{-- <button type="button" wire:click="editModalOpen({{ $maintenance->id }})"
                                                        class="hover:bg-green-400 transition-all origin-bottom-left bg-green-500 px-3 py-1 text-slate-50 rounded">Edit
                                                    </button> --}}
                                                    <button type="button" wire:click="openDeleteModel({{ $maintenance->id }})"
                                                        class="hover:bg-red-400 transition-all origin-bottom-left bg-red-500 px-3 py-1 text-slate-50 rounded">Delete
                                                    </button>
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
                                @endrole
                            @endauth
                        </table>
                    </div>
                    <div class="flex justify-start gap-x-2">
                        {{ $maintenances->links() }}
                        {{-- {{ $maintenances->links('pagination::tailwind') }} --}}
                    </div>
                </div>

            </div>
            <!-- Scripts for  Initialization -->
            <script>
                $(document).ready(function() {

                    today = new Date("Y-m-d");

                    function initializeDatePicker() {

                        $('#date').datepicker({
                            dateFormat: 'yy-mm-dd',
                            changeMonth: true,
                            changeYear: true,
                            maxDate: today, // Disable dates after today
                            onSelect: function(dateText) {
                                // This will send the selected date to Livewire
                                @this.set('date', dateText);

                            }
                        }).datepicker("setDate", today);
                    }
                    initializeDatePicker();

                    function initializeSelete2() {
                        // $('#shop_name').select2({
                        //     allowClear: true
                        // });
                        // $('#shop_name').on('change', function(e) {
                        //     var data = $('#shop_name').val();
                        //     @this.set('user', data);
                        // });
                        $('#type').select2({
                            allowClear: true
                        });
                        $('#type').on('change', function(e) {
                            var type_data = $('#type').val();
                            @this.set('type', type_data);
                        });
                    }
                    initializeSelete2();
                });
            </script>
        @endrole
    @endauth
</section>
