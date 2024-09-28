    <input 
        {{ $attributes->merge(['class' => 'w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500']) }}>
   

{{-- <div class="mb-4">
    <label for="{{ $input_id }}"
        class="{{ $input_label_class == null ? '' : $input_label_class }} block text-gray-700 font-bold mb-2">{{ $input_label }}</label>
  
        <input wire:model="{{ $model }}"
        placeholder="{{ $input_placeholder == null ? $input_label : $input_placeholder }}"
        type="{{ $input_type == null ? 'text' : $input_type }}" id="{{ $input_id }}"
        class="{{ $input_class == null ? ' ' : $input_class }} w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500">
    @error($input_error)
        <div class="text-red-500">{{ $input_error_message }}</div>
    @enderror
</div> --}}
