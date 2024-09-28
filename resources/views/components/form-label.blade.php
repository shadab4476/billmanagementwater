@props(['input_label_class', 'label_for', 'input_label', 'star'])
<label for="{{ $label_for }}"
    class="block text-gray-700 font-bold mb-2  {{ $input_label_class == null ? '' : $input_label_class }} ">{{ $input_label }}

    @if ($star)
        <span class="text-red-500">*</span>
    @endif
</label>
