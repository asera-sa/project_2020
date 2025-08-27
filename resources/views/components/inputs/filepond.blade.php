@php
    $mimesTypes = $attributes->has('accept') ? json_encode(explode(',', str_replace(' ', '', $attributes->get('accept')))) : "[]";
    $allowMultiple = $attributes->has('multiple') ? true : false;
    $allowImagePreview = $attributes->has('allowImagePreview') ? $attributes->has('allowImagePreview') : true;
@endphp

<div wire:ignore
    x-data="{
    mimesTypes: '',
    allowMultiple: '',
    allowImagePreview: '',
    maxFileSize: '',

    init() {
        this.mimesTypes = JSON.parse('{{ $mimesTypes }}');
        this.allowMultiple = '{{ $allowMultiple }}';
        this.allowImagePreview = '{{ $allowImagePreview }}';
        this.maxFileSize = '{{ $maxFileSize }}';

        const pond = FilePond.create($refs.input, {
            storeAsFile: true,
            allowMultiple: Boolean(this.allowMultiple),
            acceptedFileTypes: this.mimesTypes,
            allowImagePreview: Boolean(this.allowImagePreview),
            maxFileSize: this.maxFileSize,
        });
    }
}">
    <input type="file" x-ref="input" {!! $attributes->merge(['class' => 'mt-2']) !!} />
</div>

