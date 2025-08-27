<x-admin-layout>
    <x-slot name="slot">
        <div class="grid grid-cols-12 gap-4">
            <section class="order-last col-span-full md:col-span-9 md:order-first">
                <x-panel>
                    <x-slot name="heading">
                        <h2 class="text-base font-medium">{{ __('طلبات رخص السلامة') }}</h2>
                    </x-slot>
                    <x-slot name="slot">
                        <div class="overflow-auto">
                            <table>
                                <thead>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('اسم الجهه') }}</th>
                                    <th scope="col">{{ __('نوع الجهة') }}</th>
                                    <th scope="col">{{ __('تاريخ الإصدار') }}</th>
                                    <th scope="col">{{ __('تاريخ الانتهاء') }}</th>
                                    <th scope="col">{{ __('حالة الرخصة') }}</th>
                                    <th scope="col"></th>
                                </thead>
                                <tbody>
                                    @forelse ($licenses as $license)
                                        <tr>
                                            <td class="font-mono">{{ $loop->iteration }}</td>
                                            <td>{{ $license->licenseRequest->institution->name }}</td>
                                            <td>{{ $license->licenseRequest->institution->type }}</td>
                                            <td>{{ $license->issued_at?->toDateString() ?? '' }}</td>
                                            <td>{{ $license->expires_at?->toDateString() ?? '' }}</td>
                                            <td>
                                                    @if ($license->is_active)
                                                        <span class="text-green-600 font-semibold">{{ __('صالحة') }}</span>
                                                    @else
                                                        <span class="text-red-600 font-semibold">{{ __('منتهية') }}</span>
                                                    @endif
                                            </td>
                                            <td class="actions">
                                                <a href="{{ route('licenses.show', $license) }}" class="view">
                                                    <span>{{ __('عرض التفاصيل') }}</span>
                                                    <x-heroicon-o-arrow-long-left class="w-4 h-4" stroke-width="2" />
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-3 py-4 text-center">
                                                @if (request()->has('filter'))
                                                    <span>{{ __('عذرًا, لم نجد ماتبحث عنه.') }}</span>
                                                @else
                                                    <span>{{ __('لم يتم إدراج أي طلبات بعد.') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if ($licenses->hasPages())
                                <tfoot class="bg-transparent">
                                    <tr>
                                        <th colspan="4">{{ $licenses->onEachSide(0)->withQueryString()->links() }}</th>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
                        </div>
                    </x-slot>
                </x-panel>
            </section>

            <aside class="space-y-4 col-span-full md:col-span-3">
            

                <form action="{{ route('licenses.index') }}" method="get">
                    <x-panel>
                        <x-slot name="heading">
                            <h3 class="inline-flex text-sm font-medium licenses-center gap-x-2">
                                <x-heroicon-o-funnel class="w-4 h-4" stroke-width="2" />
                                <span>
                                    <span>{{ __('فرز النتائج') }}</span>
                                    <span>({{ $licenses->total() }})</span>
                                </span>
                            </h3>
                        </x-slot>
                        <x-slot name="slot">
                            <ul class="space-y-4">
                                <li>
                                    <x-inputs.input type="text" id="institution_name" name="filter[institution_name]" class="block w-full mt-0 placeholder:text-xs" :placeholder="__('اسم الجهة')" :value="request()->input('filter.institution_name')" />                                </li>
                            </ul>
                        </x-slot>
                        <x-slot name="footer" class="space-y-3">
                            <x-buttons.primary-button class="justify-center w-full">
                                <x-heroicon-o-magnifying-glass class="w-4 h-4 text-white stroke-white" stroke-width="2" />
                                <span>{{ __('بـحـث') }}</span>
                            </x-buttons.primary-button>

                            <x-buttons.secondary-link :href="route('licenses.index')" class="justify-center w-full">
                                <span>{{ __('مسح حقول الفلتر') }}</span>
                            </x-buttons.secondary-link>
                        </x-slot>
                    </x-panel>
                </form>
            </aside>
        </div>
    </x-slot>
</x-admin-layout>
