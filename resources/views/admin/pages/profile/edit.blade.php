<x-admin-layout>
    <x-slot name="slot">
        <div class="space-y-6">
            <x-panel>
                <x-slot name="slot">
                    <div class="max-w-xl">
                        @include('admin.pages.profile.partials.update-profile-information-form')
                    </div>
                </x-slot>
            </x-panel>

            <x-panel>
                <x-slot name="slot">
                    <div class="max-w-xl">
                        @include('admin.pages.profile.partials.update-password-form')
                    </div>
                </x-slot>
            </x-panel>
        </div>
    </x-slot>
</x-admin-layout>
