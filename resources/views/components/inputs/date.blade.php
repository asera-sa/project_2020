@props(['disabled' => false, 'value' => now()->toDateString()])

@php
    $minDate = $attributes->has('min') ? $attributes->get('min') : null;
    $maxDate = $attributes->has('max') ? $attributes->get('max') : null;
@endphp

<div x-data="{
    value: '{{ $value }}',
    minDate: '{{ $minDate }}',
    maxDate: '{{ $maxDate }}',

    init() {
        let picker = flatpickr(this.$refs.picker, {
            dateFormat: 'Y-m-d',
            defaultDate: this.value,
            minDate: this.minDate,
            maxDate: this.maxDate,
            onChange: (date, dateString) => {
                this.value = dateString
            }
        });

        this.$watch('value', (value) => picker.setDate(value))
    },
}" class="w-full">
    <x-inputs.input x-ref="picker" type="text" class="block w-full" {{ $attributes }} />
</div>

