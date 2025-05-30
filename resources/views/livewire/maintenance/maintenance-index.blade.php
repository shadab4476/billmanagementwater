<section>
    @auth
        @role('superAdmin')
            {{-- page title start --}}
            <x-slot name="title">
                Maintenance Index </x-slot>
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
            {{-- delete model start --}}
            @if ($showDeleteModal)
                <x-delete-model
                    message="{{ empty($maintenance_select) || $maintenance_id ? 'this Maintenance' : 'Selected Maintenance' }}"
                    delete="deleteMaintenance" closeModel="closeDeleteModal" />
            @endif
            {{-- delete model end  --}}
            {{-- edit model form start --}}
            {{-- edit model show  start --}}
            @if ($editModelMaintenance == true)
                {{-- edit form --}}
                <div class="fixed overflow-y-scroll top-[50%] left-0 bg-zinc-400 z-50 -translate-y-[50%] h-full w-full ">

                    <div class="w-[100%]">
                        <div class="md:w-[35%] mx-auto max-w-xl px-6 py-2 bg-white shadow-md  rounded-lg">
                            <h2 class="text-2xl font-bold mb-6">Update Maintenance Bill</h2>
                            <form class="space-y-4 w-full md:items-center md:justify-between md:flex md:flex-wrap "
                                wire:submit.prevent="updateMaintenance">
                                <!-- Bill Date -->
                                <div wire:ignore class="w-full">
                                    <x-form-label label_for="type" input_label="Type" star="true" />
                                    <select wire:model.live="type" id="type"
                                        class="w-full text-slate-950 px-3 py-2 border border-gray-300 bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="1">Income</option>
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
                                <div wire:ignore class="w-full">
                                    <x-form-label label_for="date" star="true"
                                        input_label="Shop Date (Default Date {{ date('Y-m-d') }})" />
                                    <x-form-input type="date" wire:model.live="date" id="date" placeholder="yy-mm-dd" />

                                    @error('date')
                                        <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Submit Button -->
                                <div class="flex w-full items-center justify-between ">
                                    <button type="button" class="px-7 bg-red-600 text-slate-50 rounded py-2"
                                        wire:click="closeEditModelMaintenance">Close</button>
                                    <button type="button" class="px-7 bg-green-600 text-slate-50 rounded py-2"
                                        wire:click="blankInput">Reset</button>
                                    <x-form-button button_text="Update" button_type="submit" class="!w-1/2"
                                        target="updateMaintenance" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            {{-- edit model form end --}}
            <div class="w-full">
                <div class="flex justify-between pb-4 items-center">
                    <h3 class="text-2xl font-bold ">{{ $getAllMaintenance ? 'All' : $currentMonthName }} Maintenance Bills</h3>
                    <button wire:click="exportPdf" type="button" @if (!$maintenances || $maintenances->isEmpty()) disabled @endif
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
                    </button>
                    <a wire:navigate href="{{ route('index.maintenance') }}"
                        class="py-3 px-8 hover:bg-green-400 transition-all bg-green-500 text-slate-50 rounded ">Create</a>
                    @if (!empty($maintenance_select))
                        <button type="button" wire:click="openDeleteModel" {{ empty($maintenance_select) ? 'disabled' : '' }}
                            class="py-3 px-8 hover:bg-red-600 transition-all bg-red-500 text-slate-50 rounded mb-2">Delete All
                        </button>
                    @endif
                </div>
                <div class="overflow-x-auto p-1 w-full">
                    <div class="flex justify-between flex-wrap items-end  ">
                        <div wire:ignore class="w-[7%] flex flex-wrap">
                            <x-form-label label_for="perPage" input_label="Per Page" />

                            <select class="w-full" wire:model.live="perPage" id="perPage">
                                @foreach ($validPerPageOptions as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('perPage')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="">
                            <button type="button" wire:click="getAllMaintenances" wire:loading.attr="disabled"
                                wire:target="getAllMaintenances"
                                class="py-3 px-8 hover:bg-green-600 transition-all capitalize bg-green-500 text-slate-50 rounded ">
                                {{ !$getAllMaintenance ? 'get all' : 'current month' }}
                            </button>
                        </div>
                        <div class="maintenanceDate flex-wrap  flex justify-between items-end ">
                            <div class="">
                                <x-form-label label_for="startDate" input_label_class="inline-block"
                                    input_label="Start Date" />
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
                        </div>
                        <div class="maintenanceSearch">
                            <x-form-input id="searchMaintenance" wire:model.live="searchMaintenance" placeholder="Search"
                                type="text" />
                            @error('searchMaintenance')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <table class="min-w-full  bg-white border border-gray-200">
                        <thead class="w-full">
                            <tr class="bg-gray-100 border-b border-gray-200">
                                <th><input type="checkbox" wire:model.live="selectAll"></th>
                                <th
                                    class="text-center
                                        px-6 py-3 font-bold uppercase text-gray-700">
                                    ID</th>
                                <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">User Name </th>
                                <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Type</th>
                                <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Amount</th>
                                <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Note</th>
                                <th class="text-center px-6 py-3 font-bold uppercase text-gray-700">Date</th>

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
                                                    wire:model.live="maintenance_select">
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
                                                <button type="button" wire:click="openEditModelMaintenance({{ $maintenance->id }})"
                                                    class="hover:bg-green-400 transition-all origin-bottom-left bg-green-500 px-3 py-1 text-slate-50 rounded">Edit
                                                </button>
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
                {{-- {{ $maintenances->links() }} --}}
                <div class="flex justify-start gap-x-2">
                    {{ $maintenances->links() }}
                    {{-- {{ $maintenances->links('pagination::tailwind') }} --}}
                </div>




                <div class="amount-of-maintenance flex font-bold text-lg justify-between items-center">
                    <h3 class="text-green-500">{{ $getAllMaintenance ? 'All' : '' }} Income: <span
                            class="text-black">₹{{ $income }}</span></h3>
                    <h3 class="text-red-500">{{ $getAllMaintenance == 'all' ? 'All' : '' }} Expense: <span
                            class="text-black">₹{{ $expense }}</span> </h3>
                    <h3 class="text-black"> {{ $getAllMaintenance ? 'All' : $currentMonthName }} Amount: <span
                            class="text-black">₹{{ $totalAmount }}/-</span>
                    </h3>
                </div>
            </div>
        @endrole
    @endauth


    <script>
        $(document).ready(function() {
            // Initialize the start date
            $("#startDate").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                onSelect: function(selectedDate) {
                    // Set the minimum date for the end date\
                    @this.set('startDate', selectedDate);

                    // $("#startDate").datepicker("option", "minDate", selectedDate);
                }
            });

            // Initialize the end date
            $("#endDate").datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true,
                onSelect: function(selectedDate) {
                    // Set the maximum date for the start date
                    // @this.set('endDate', "maxDate", selectedDate);
                    @this.set('endDate', selectedDate);

                    // $("#endDate").datepicker("option", "maxDate", selectedDate);
                }
            });

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


            //form date picker start

            today = new Date("Y-m-d");

            function initializeDatePickerdate() {

                $('#date').datepicker({
                    dateFormat: 'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true,
                    onSelect: function(dateText) {
                        // This will send the selected date to Livewire
                        @this.set('date', dateText);

                    }
                }).datepicker("setDate", today);
            }
            // initializeDatePickerdate();

            function initializeSeletetype() {
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
            // initializeSeletetype();
            //form date picker end
        });
    </script>
</section>
