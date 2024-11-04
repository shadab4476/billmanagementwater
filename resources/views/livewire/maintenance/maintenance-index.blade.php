<section>
    @auth
        @role('superAdmin')
            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <!-- jQuery UI CSS -->
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <!-- jQuery UI JS -->
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
            {{-- end datepicker css --}}

            @if ($showDeleteModal)
                <x-delete-model
                    message="{{ empty($maintenance_select) || $maintenance_id ? 'this Maintenance' : 'Selected Maintenance' }}"
                    delete="deleteMaintenance" closeModel="closeDeleteModal" />
            @endif
            @if (session()->has('success'))
                <h2 class="text-white py-2  text-center px-5 bg-green-500">{{ session()->get('success') }} </h2>
            @endif
            @if (session()->has('error'))
                <h2 class="text-white py-2  text-center px-5 bg-red-500">{{ session()->get('error') }} </h2>
            @endif
            <div class="w-full">
                <div class="flex justify-between pb-4 items-center">
                    <h3 class="text-2xl font-bold "> Maintenance Bills</h3>
                    <a wire:navigate href="{{ route('index.maintenance') }}"
                        class="py-3 px-8 hover:bg-green-400 transition-all bg-green-500 text-slate-50 rounded ">Create</a>
                    <button type="button" wire:click="openDeleteModel" {{ empty($maintenance_select) ? 'disabled' : '' }}
                        class="py-3 px-8 hover:bg-red-600 transition-all bg-red-500 text-slate-50 rounded mb-2">Delete All
                    </button>
                </div>
                <div class="overflow-x-auto p-1 w-full">
                    <div class="flex justify-between items-center ">
                        <div class="maintenanceDate flex-wrap   flex justify-between items-center ">
                            <div class="w-[48%]">
                                <x-form-label label_for="start-date" input_label_class="inline-block"
                                    input_label="Start Date:" />
                                <x-form-input id="start-date" wire:model.live="start-date" class="w-[65%]" type="text" />
                                @error('start-date')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="w-[48%]">
                                <x-form-label label_for="end-date" input_label_class="inline-block" input_label="End Date:" />
                                <x-form-input id="end-date" wire:model.live="end-date" class="w-[65%]" type="text" />
                                @error('start-date')
                                    <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="maintenanceSearch">
                            <x-form-input id="search" wire:model.live="search" placeholder="Search" type="text" />
                            @error('search')
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
                                                <button type="button" wire:click="editUser({{ $maintenance->id }})"
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
                    {{ $maintenances->links('pagination::tailwind') }}
                </div>




                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                        <li class="me-2">
                            <button wire:click="amountTabs('all')"
                                class="inline-block hover:text-blue-600   {{ $amountTabsActive == 'all' ? 'text-blue-600  border-blue-600 ' : '' }}  p-4 border-b-2 rounded-t-lg"
                                type="button">All Amount</button>
                        </li>
                        <li class="me-2">
                            <button wire:click="amountTabs('current')"
                                class="inline-block p-4 border-b-2 rounded-t-lg hover:text-blue-600   {{ $amountTabsActive == 'current' ? 'text-blue-600  border-blue-600 ' : '' }} "
                                type="button">Current Month</button>
                        </li>

                    </ul>
                </div>
                <div class="amount-of-maintenance flex font-bold text-lg justify-between items-center">
                    <h3 class="text-green-500">{{ $amountTabsActive == 'all' ? 'All' : '' }} Income: <span
                            class="text-black">₹{{ $income }}</span></h3>
                    <h3 class="text-red-500">{{ $amountTabsActive == 'all' ? 'All' : '' }} Expense: <span
                            class="text-black">₹{{ $expense }}</span> </h3>
                    <h3 class="text-black"> {{ $amountTabsActive == 'all' ? 'All' : $monthName }} Amount: <span
                            class="text-black">₹{{ $amount }}/-</span>
                    </h3>
                </div>
            </div>
        @endrole
    @endauth


    <script>
        $(document).ready(function() {
            // Initialize the start date
            $("#start-date").datepicker({
                dateFormat: "yy-mm-dd",
                onSelect: function(selectedDate) {
                    // Set the minimum date for the end date
                    $("#end-date").datepicker("option", "minDate", selectedDate);
                }
            });

            // Initialize the end date
            $("#end-date").datepicker({
                dateFormat: "yy-mm-dd",
                onSelect: function(selectedDate) {
                    // Set the maximum date for the start date
                    $("#start-date").datepicker("option", "maxDate", selectedDate);
                }
            });
        });
    </script>
</section>
