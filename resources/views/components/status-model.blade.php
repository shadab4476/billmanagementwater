@props(['checkId'])
<div>
    <div class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75"></div>

    <!-- Modal Box -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-bold mb-4">Confirm To Change Status</h2>
            <p class="text-sm text-gray-600 mb-4">Are you sure you want to change status</p>
            <div class="flex justify-between mb-6 space-x-4">

                <label>
                    <input type="radio" {{ $checkId == 1 ? 'checked' : '' }} name="status" wire:model.live="status"
                        value="1">
                    Running
                </label>

                <!-- Closed -->
                <label>
                    <input type="radio"{{ $checkId == 2 ? 'checked' : '' }} name="status" wire:model.live="status"
                        value="2">
                    Closed
                </label>

                <!-- Pending -->
                <label>
                    <input type="radio"{{ $checkId == 0 ? 'checked' : '' }} name="status" wire:model.live="status"
                        value="0">
                    Pending
                </label>
                @error('status')
                    <div class="bg-red-500">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-between space-x-4">
                <!-- Cancel Button -->
                <button type="button" wire:click="{{ $closeStatusModel }}"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    Cancel
                </button>

                <!-- Confirm Delete Button -->
                <button type="button" wire:click="{{ $updateStatus }}"
                    class="hover:bg-gray-500 text-white px-4 py-2 rounded-lg bg-gray-600">
                    Update
                </button>
            </div>
        </div>
    </div>
</div>
