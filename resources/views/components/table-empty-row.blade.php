@props(['colspan', 'filterText' => __('عذرًا, لم نجد ماتبحث عنه.'), 'text' => __('لم يتم إدراج سجلات بعد.')])
<tr>
    <td colspan="{{ $colspan }}" class="px-3 py-4 text-center">
        @if (request()->has('filter'))
            <span>{{ $filterText }}</span>
        @else
            <span>{{ $text }}</span>
        @endif
    </td>
</tr>
