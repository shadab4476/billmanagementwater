@props(['closeModel'])
<div>
    <div class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75"></div>

    <!-- Modal Box -->
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-bold mb-4">Confirm Deletion</h2>
            <p class="text-sm text-gray-600 mb-4">Are you sure you want to delete
                {{ $message ? 'this ' . $message : '' }}? This action
                cannot
                be undone.</p>

            <div class="flex justify-end space-x-4">
                <!-- Cancel Button -->
                <button type="button" wire:click="{{ $closeModel }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                    Cancel
                </button>

                <!-- Confirm Delete Button -->
                <button type="button" wire:click="{{ $delete }}"
                    class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
