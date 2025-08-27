@php($svgNavLinkClasses = 'w-6 h-6 text-gray-400 shrink-0 !group-hover:text-primary-600 transition duration-200 ease-in-out !text-primary-600')
@php($svgNavLinkActiveClasses = '!text-primary-600')

<div class="flex flex-col px-6 pb-4 overflow-y-auto bg-white border-l border-gray-200 bg-info grow gap-y-5">
    <div class="flex items-center h-16 shrink-0">
        <x-dashboard-logo side="الهيئة الوطنية للسلامة" style="font-size: 2rem;" />
    </div>
    <nav class="flex flex-col flex-1">
        <ul role="list" class="flex flex-col flex-1 gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-2">
                    @if(auth()->user()->isAdministrator())
                        <li>
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                <x-heroicon-o-home @class([$svgNavLinkClasses, $svgNavLinkActiveClasses => request()->routeIs('admin.dashboard')]) />
                                <span>{{ __('الرئيسية') }}</span>
                            </x-nav-link>
                        </li>
                    @endif
                    
                    @if(auth()->user()->isAdministrator())
                        <li>
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                <x-heroicon-o-users @class([$svgNavLinkClasses, $svgNavLinkActiveClasses => request()->routeIs('admin.users.*')]) />
                                <span>{{ __('إدارة المستخدمين') }}</span>
                            </x-nav-link>
                        </li>
                    @endif

                    @if(auth()->user()->isAdministrator())
                        <li>
                            <x-nav-link :href="route('admin.institutions.index')" :active="request()->routeIs('admin.institutions.*')">
                                <x-heroicon-o-building-office @class([$svgNavLinkClasses, $svgNavLinkActiveClasses => request()->routeIs('admin.institutions.*')]) />
                                <span>{{ __('إدارة المصالح') }}</span>
                            </x-nav-link>
                        </li>
                    @endif

                    {{-- @if(auth()->user()->isSettlementUnitEmployee() )
                        <li>
                            <x-nav-link :href="route('institution_requests.index')" :active="request()->routeIs('institution_requests.*')">
                                <x-heroicon-o-tag @class([$svgNavLinkClasses, $svgNavLinkActiveClasses => request()->routeIs('institution_requests.*')]) />
                                <span>{{ __('طلبات المصالح') }}</span>
                            </x-nav-link>
                        </li>
                    @endif --}}
                    @if(!auth()->user()->isInspector())
                        <li>
                            <x-nav-link :href="route('license_requests.index')"  :active="request()->routeIs('license_requests.*')">
                                <x-heroicon-o-squares-2x2 @class([$svgNavLinkClasses, $svgNavLinkActiveClasses => request()->routeIs('licenses.*')]) />
                                <span>{{ __('طلبات الترخيص') }}</span>
                            </x-nav-link>
                        </li>
                    @endif

                    @if(auth()->user()->isAdministrator() || auth()->user()->isInspectionOfficeManager())
                        <li>
                            <x-nav-link :href="route('licenses.index')"  :active="request()->routeIs('licenses.*')">
                                <x-heroicon-o-squares-2x2 @class([$svgNavLinkClasses, $svgNavLinkActiveClasses => request()->routeIs('licenses.*')]) />
                                <span>{{ __('الترخيصات') }}</span>
                            </x-nav-link>
                        </li>
                    @endif

                    @if(auth()->user()->isAdministrator() || auth()->user()->isInspector())
                        <li>
                            <x-nav-link :href="route('visit_schedules.index')"  :active="request()->routeIs('visit_schedules.*')">
                                <x-heroicon-o-calendar @class([$svgNavLinkClasses, $svgNavLinkActiveClasses => request()->routeIs('licenses.*')]) />
                                <span>{{ __('مواعيد الزيارة') }}</span>
                            </x-nav-link>
                        </li>
                    @endif

                    {{-- <li>
                        <x-nav-link :href="'#'" :active="request()->routeIs('admin.reports.*')">
                            <x-heroicon-o-chart-pie @class([$svgNavLinkClasses, $svgNavLinkActiveClasses => request()->routeIs('admin.reports.*')]) />
                            <span>{{ __('التقارير') }}</span>
                        </x-nav-link>
                    </li>

                    <li>
                        <x-nav-link :href="'#'" :active="request()->routeIs('admin.settings.*')">
                            <x-heroicon-o-cog @class([$svgNavLinkClasses, $svgNavLinkActiveClasses => request()->routeIs('admin.settings.*')]) />
                            <span>{{ __('الإعدادات') }}</span>
                        </x-nav-link>
                    </li> --}}
                </ul>
            </li>
            <li class="mt-auto">
                <ul class="-mx-2 space-y-2">
                    <li>
                        <x-nav-link onclick="event.preventDefault(); document.getElementById('admin-form-logout').submit();" :href="route('logout')">
                            <x-heroicon-o-arrow-right-start-on-rectangle @class(['w-6 h-6 text-gray-400 shrink-0 group-hover:text-primary-600 transition duration-200 ease-in-out']) />
                            <span>{{ __('تسجيل الخروج') }}</span>
                        </x-nav-link>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
