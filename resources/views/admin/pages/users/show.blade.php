<x-admin-layout>
    <x-slot name="slot">
        <div class="grid grid-cols-12 gap-4">
            <section class="order-last col-span-full md:col-span-9 md:order-first">
                <x-panel>
                    <x-slot name="heading">
                        <div class="flex items-center justify-between gap-x-3">
                            <div class="flex items-center gap-x-3">
                                <h2 class="text-sm font-semibold">{{ __('عرض بيانات المستخدم ') }}</h2>
                            </div>
                        
                            <div @class([$user->state->getUiClasses() ?? ''])>
                                <span>{{ $user->state->getName() ?? $user->state }}</span>
                            </div>
                        </div>
                    </x-slot>
                    <x-slot name="slot">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="name" :value="__('اسم المستخدم')" />
                                <x-view-value id="name" class="block w-full" :value="$user->user_name"/>
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="full_name" :value="__('الصورة الشخصية')" />
                                <button type="button" class="hover:underline" x-data x-on:click="$dispatch('open-modal', 'image-view')">{{ __('إضغط للعرض') }}</button>
                                <x-modal name="image-view">
                                    <x-slot name="content">
                                        <x-slot name="heading">
                                            <h2 class="text-sm font-semibold">{{ __('صورة المستخدم') }}</h2>
                                            {{-- @dd($user->getImage()) --}}

                                        </x-slot>
                                        <x-slot name="slot">
                                            @if ($user->getImage())
                                                <img class="w-full h-full" src="{{ $user->getImage() }}" alt="صورة المستخدم">
                                            @else
                                                <p class="text-sm text-gray-500">{{ __('لا يوجد صورة محملة') }}</p>
                                            @endif
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
                                <x-view-value id="full_name" class="block w-full" :value="$user->full_name"/>
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="scope" :value="__('النطاق')" />
                                <x-view-value id="scope" class="block w-full" :value="$user->scope->getName()"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mt-8">
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="email" :value="__('البريد الإلكتروني')" />
                                <x-view-value id="email" class="block w-full" :value="$user->email"/>
                            </div>
                            <div class="col-span-full md:col-span-1">
                                <x-inputs.label for="phone" :value="__('رقم الهاتف')" />
                                <x-view-value id="phone" class="block w-full" :value="$user->phone"/>
                            </div>
                        </div>

                    </x-slot>
                </x-panel>
            </section>

            <aside class="space-y-4 col-span-full md:col-span-3">
                    <x-buttons.secondary-link :href="route('admin.users.index')" class="justify-center w-full">
                        <x-heroicon-o-list-bullet class="w-4 h-4" stroke-width="2" />
                        <span>{{ __('قائمة المستخدمين') }}</span>
                    </x-buttons.secondary-link>

                    <x-buttons.secondary-link :href="route('admin.users.edit', $user)" class="justify-center w-full">
                        <x-heroicon-o-pencil-square class="w-4 h-4" stroke-width="2" />
                        <span>{{ __('تعديل بيانات المستخدم') }}</span>
                    </x-buttons.secondary-link>

                    @include('admin.pages.users.actions.state-update')

                    <x-buttons.confirm-delete :route="route('admin.users.destroy', $user)" class="justify-center w-full btn-confirm-delete">
                        <x-heroicon-o-trash class="w-4 h-4" stroke-width="2" />
                        <span>{{ __('حذف المستخدم') }}</span>
                    </x-buttons.confirm-delete>
            </aside>
        </div>
    </x-slot>
</x-admin-layout>
