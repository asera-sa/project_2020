<x-admin-layout>
    <x-slot name="slot">
        <div class="grid grid-cols-12 gap-4">
            <section class="order-last col-span-full md:col-span-9 md:order-first">
                <x-panel>
                    <x-slot name="heading">
                        <div class="flex items-center justify-between gap-x-3">
                            <div class="flex items-center gap-x-3">
                                <h2 class="text-sm font-semibold">{{ __('عرض بيانات الجهة') }}</h2>
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="slot">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="name" :value="__('اسم الجهة')" />
                                <x-view-value id="name" class="block w-full" :value="$institution->name"/>
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="type" :value="__('نوع الجهة')" />
                                <x-view-value id="type" class="block w-full" :value="($institution->type === 'public') ? 'عامة' : 'خاصة'"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-6">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="name" :value="__('اسم المستخدم')" />
                                <x-view-value id="name" class="block w-full" :value="$institution->user->user_name"/>
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="full_name" :value="__('الصورة الشخصية')" />
                                <button type="button" class="hover:underline" x-data x-on:click="$dispatch('open-modal', 'image-view')">{{ __('إضغط للعرض') }}</button>
                                <x-modal name="image-view">
                                    <x-slot name="content">
                                        <x-slot name="heading">
                                            <h2 class="text-sm font-semibold">{{ __('صورة المستخدم') }}</h2>
                                            {{-- @dd($institution->user->getImage()) --}}

                                        </x-slot>
                                        <x-slot name="slot">
                                            <div>
                                                <img class="w-full h-full" src="{{ $institution->user->getImage() }}" >
                                            </div>
                                        </x-slot>
                                        <x-slot name="footer" class="flex justify-end">
                                            <x-buttons.secondary-button type="button" x-on:click.prevent="$dispatch('close')">إغلاق</x-buttons.secondary-button>
                                        </x-slot>
                                    </x-slot>
                                </x-modal>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-8">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="full_name" :value="__('اسم الموظف')" />
                                <x-view-value id="full_name" class="block w-full" :value="$institution->user->full_name"/>
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="scope" :value="__('النطاق')" />
                                <x-view-value id="scope" class="block w-full" :value="$institution->user->scope->getName()"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-8">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="email" :value="__('البريد الإلكتروني')" />
                                <x-view-value id="email" class="block w-full" :value="$institution->user->email"/>
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="phone" :value="__('رقم الهاتف')" />
                                <x-view-value id="phone" class="block w-full" :value="$institution->user->phone"/>
                            </div>
                        </div>

                    </x-slot>
                </x-panel>
            </section>

            <aside class="space-y-4 col-span-full md:col-span-3">
                <x-buttons.secondary-link :href="route('admin.institutions.index')" class="justify-center w-full">
                    <x-heroicon-o-list-bullet class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('قائمة الجهات') }}</span>
                </x-buttons.secondary-link>

                <x-buttons.secondary-link :href="route('admin.institutions.edit', $institution)" class="justify-center w-full">
                    <x-heroicon-o-pencil-square class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('تعديل بيانات الجهة') }}</span>
                </x-buttons.secondary-link>

                <x-buttons.confirm-delete :route="route('admin.institutions.destroy', $institution)" class="justify-center w-full btn-confirm-delete">
                    <x-heroicon-o-trash class="w-4 h-4" stroke-width="2" />
                    <span>{{ __('حذف الجهة') }}</span>
                </x-buttons.confirm-delete>
            </aside>
        </div>
    </x-slot>
</x-admin-layout>
