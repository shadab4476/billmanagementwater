<section>
    @if (session()->has('success'))
        <h2 class="text-white py-2  text-center px-5 bg-green-500">{{ session()->get('success') }} </h2>
    @endif
    @if (session()->has('error'))
        <h2 class="text-white py-2  text-center px-5 bg-red-500">{{ session()->get('error') }} </h2>
    @endif
    {{-- main model start --}}
    @if ($modelmain == true)
        <h2>Open</h2>
        {{-- create form start bill --}}
        <div class="fixed overflow-y-scroll top-[50%] left-0 bg-zinc-400 -translate-y-[50%] h-full w-full ">

            <div class="max-w-4xl mx-auto p-6 bg-white shadow-md mt-10 rounded-lg">
                <h2 class="text-2xl font-bold mb-6">Create Bill</h2>
                <form wire.submit.prevent="store">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-gray-700 font-bold mb-2">Date</label>
                            <input type="date" id="date" name="date"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500">
                        </div>

                        <!-- Bill Number -->
                        <div class="mb-4">
                            <label for="bill_number" class="block text-gray-700 font-bold mb-2">Bill Number</label>
                            <input type="text" id="bill_number" name="bill_number"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500"
                                placeholder="Enter Bill Number">
                        </div>

                        <!-- Amount -->
                        <div class="mb-4">
                            <label for="amount" class="block text-gray-700 font-bold mb-2">Amount</label>
                            <input type="number" id="amount" name="amount"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500"
                                placeholder="Enter Amount">
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                            <select id="status" name="status"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500">
                                <option value="">Select Status</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                            </select>
                        </div>

                        <!-- Type -->
                        <div class="mb-4">
                            <label for="type" class="block text-gray-700 font-bold mb-2">Type</label>
                            <input type="text" id="type" name="type"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500"
                                placeholder="Enter Type">
                        </div>

                        <!-- Note (will take full width on all screens) -->
                        <div class="mb-4 md:col-span-2">
                            <label for="note" class="block text-gray-700 font-bold mb-2">Note</label>
                            <textarea id="note" name="note"
                                class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500" rows="4"
                                placeholder="Enter Note"></textarea>
                        </div>
                    </div>

                    <!-- Submit Button -->
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

        {{-- create form end bill --}}
    @else
        {{-- update form start bill --}}
        <h2>update</h2>
        {{-- update form end bill --}}
    @endif
    {{-- main model end --}}
    <div class="w-full">
        <div class="flex justify-between ">
            <button wire:click="mainModelOpen" type="button"
                class="py-3 px-8 hover:bg-green-400 transition-all bg-green-500 text-slate-50 rounded mb-2">Create</button>
        </div>
    </div>
</section>
