<section>
    @auth
        @role('superAdmin')
            {{-- page title start --}}
            <x-slot name="title">
                Daily Bill </x-slot>
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

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
                <div class="bg-gray-50 shadow-md rounded-lg p-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Create Bill Entry</h2>
                    <form wire:submit.prevent="create" class="space-y-6">
                        <!-- Date -->

                        @error('shop_id')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div wire:ignore>
                            <x-form-label star="true" label_for="shop_id" input_label="Shop" />
                            <select class="w-full" wire:model.live="shop_id" id="shop_id">
                                <option value="">Select Shop</option>
                                @forelse ($shops as $shop)
                                    @if ($shop->status == '1')
                                        <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                                    @endif
                                    @if ($shop->status == '0')
                                        <option disabled value="">{{ $shop->shop_name }} (Pending)</option>
                                    @endif
                                    @if ($shop->status == '2')
                                        <option disabled value="">{{ $shop->shop_name }} (Closed)</option>
                                    @endif
                                    {{-- <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option> --}}
                                @empty
                                    <option value="">Not found</option>
                                @endforelse
                            </select>
                        </div> <!-- Date -->
                        <div>
                            @error('date')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            <x-form-label star="true" label_for="date" input_label="Date" />

                            <x-form-input id="date" readonly input_label="Date" class="" wire:model.live="date"
                                placeholder="Date" type="text" />
                        </div>

                        <!-- Quantity -->
                        <div>
                            @error('quantity')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            <x-form-label star="true" label_for="quantity" input_label="Quantity" />

                            <x-form-input id="quantity" input_label="Quantity" class="" wire:model.live="quantity"
                                placeholder="Quantity" type="number" required />
                        </div>

                        <!-- Rate -->
                        <div>
                            @error('rate')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            <x-form-label star="true" label_for="rate" input_label="Rate" />
                            <x-form-input id="rate" input_label="Rate" class="" wire:model.live="rate"
                                placeholder="Rate" type="number" required />
                        </div>

                        <!-- Note -->
                        <div>
                            @error('note')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            <x-form-label label_for="note" input_label="Note" />

                            <textarea name="note" wire:model.live="note" id="note" rows="2"
                                class="mt-1 block w-full rounded border border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-800 px-4 py-2 sm:text-sm"
                                placeholder="Optional note"></textarea>

                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-between">
                            <button type="button" class="px-7 bg-red-600 text-slate-50 rounded py-2"
                                wire:click="blankInput">Reset</button>
                            <x-form-button button_type="submit" target="create" class="!w-1/2" button_text="Create" />
                        </div>


                    </form>
                </div>
            </div>
            <div>

                @foreach ($bills as $bill)
                    <div class="border-red-600 border">
                        <p>{{ $bill->rate }}</p>
                        <p>{{ $bill->quantity }}</p>
                        <p>{{ $bill->date }}</p>
                        <p>{{ $bill->note }}</p>
                        <p>{{ $bill->shops->shop_name }}</p>
                    </div>
                @endforeach
            </div>








            <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-center mb-4">Monthly Bill Statement</h2>
                <p class="text-gray-700"><strong>Shop Name:</strong> ABC General Store</p>
                <p class="text-gray-700"><strong>Billing Period:</strong> February 1, 2025 - February 28, 2025</p>
                <p class="text-gray-700"><strong>Bill Date:</strong> March 1, 2025</p>

                <table class="w-full mt-4 border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 p-2">Description</th>
                            <th class="border border-gray-300 p-2">Quantity</th>
                            <th class="border border-gray-300 p-2">Rate per Unit</th>
                            <th class="border border-gray-300 p-2">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td class="border border-gray-300 p-2">Camper Entries (Total)</td>
                            <td class="border border-gray-300 p-2">319</td>
                            <td class="border border-gray-300 p-2">$5.00</td>
                            <td class="border border-gray-300 p-2">$1,595.00</td>
                        </tr>
                    </tbody>
                </table>

                <p class="mt-4 text-gray-700"><strong>Total Amount Payable:</strong> $1,595.00</p>
                <p class="text-gray-700"><strong>Payment Due Date:</strong> March 5, 2025</p>
                <p class="text-gray-700"><strong>Payment Method:</strong> Cash / Bank Transfer</p>

                <p class="mt-4 text-center text-gray-600">Thank you for your business! If you have any questions, feel free to
                    contact us.</p>
            </div>




            <script>
                // date input script
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
                });
                //select2 start
                function initializeSelete2() {

                    $('#shop_id').select2({
                        allowClear: true
                    });
                    $('#shop_id').on('change', function(e) {
                        var shop_id_data = $('#shop_id').val();
                        @this.set('shop_id', shop_id_data);
                    });
                }
                initializeSelete2();
                //select2 end
            </script>
        @endrole
    @endauth

</section>
