@props(['input_label_class', 'label_for', 'input_label', 'star'])
<label for="{{ $label_for }}"
    class="block text-sm font-medium text-gray-700 mb-1  {{ $input_label_class == null ? '' : $input_label_class }} ">{{ $input_label }}

    @if ($star)
        <span class="text-red-500">*</span>
    @endif
</label>
