<x-admin-layout>
    <x-slot name="slot">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-semibold">{{ __('طلبات الترخيص') }}</h1>
            <x-buttons.primary-link :href="route('license_requests.create')">
                {{ __('إضافة طلب جديد') }}
            </x-buttons.primary-link>
        </div>

        @if(session('success'))
            <div class="p-4 mb-4 text-green-800 bg-green-100 rounded">
                {{ session('success') }}
            </div>
        @endif

        <x-panel>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="text-right bg-gray-50">
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">{{ __('المعرف') }}</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">{{ __('المصلحة') }}</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">{{ __('الحالة') }}</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">{{ __('تاريخ الإنشاء') }}</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">{{ __('الإجراءات') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($licenseRequests as $request)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $request->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $request->institution->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">
                                <span @class([
                                    'pill',
                                    'pill-green' => $request->state->getName() === __('app.states.request_state.accepted'),
                                    'pill-red' => $request->state->getName() === __('app.states.request_state.rejected'),
                                    'pill-yellow' => $request->state->getName() === __('app.states.request_state.pending'),
                                ])>
                                    {{ $request->state->getName() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $request->created_at->format('Y-m-d') }}</td>
                            <td class="flex gap-2 px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                <a href="{{ route('license_requests.show', $request) }}" class="text-blue-600 hover:underline">{{ __('عرض') }}</a>
                                <a href="{{ route('license_requests.edit', $request) }}" class="text-yellow-600 hover:underline">{{ __('تعديل') }}</a>
                                <form action="{{ route('license_requests.destroy', $request) }}" method="POST" onsubmit="return confirm('{{ __('هل أنت متأكد من الحذف؟') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">{{ __('حذف') }}</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">{{ __('لا توجد طلبات.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $licenseRequests->links() }}
            </div>
        </x-panel>
    </x-slot>
</x-admin-layout>
