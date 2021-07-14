<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('bus_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/amenities*") ? "c-show" : "" }} {{ request()->is("admin/bus-types*") ? "c-show" : "" }} {{ request()->is("admin/buses*") ? "c-show" : "" }} {{ request()->is("admin/bus-seat-classes*") ? "c-show" : "" }} {{ request()->is("admin/bus-ratings*") ? "c-show" : "" }} {{ request()->is("admin/seat-layouts*") ? "c-show" : "" }} {{ request()->is("admin/seats*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.busManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('amenity_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.amenities.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/amenities") || request()->is("admin/amenities/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-american-sign-language-interpreting c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.amenity.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bus_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bus-types.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bus-types") || request()->is("admin/bus-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.busType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bus_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.buses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/buses") || request()->is("admin/buses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bus-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bus_seat_class_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bus-seat-classes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bus-seat-classes") || request()->is("admin/bus-seat-classes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-fill-drip c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.busSeatClass.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bus_rating_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bus-ratings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bus-ratings") || request()->is("admin/bus-ratings/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-star c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.busRating.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('seat_layout_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.seat-layouts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/seat-layouts") || request()->is("admin/seat-layouts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-ship c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.seatLayout.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('seat_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.seats.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/seats") || request()->is("admin/seats/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-suitcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.seat.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('routes_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/routes*") ? "c-show" : "" }} {{ request()->is("admin/pickup-points*") ? "c-show" : "" }} {{ request()->is("admin/drop-off-points*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.routesManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('route_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.routes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/routes") || request()->is("admin/routes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marked c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.route.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('pickup_point_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.pickup-points.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/pickup-points") || request()->is("admin/pickup-points/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pickupPoint.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('drop_off_point_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.drop-off-points.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/drop-off-points") || request()->is("admin/drop-off-points/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.dropOffPoint.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('booking_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/reservations*") ? "c-show" : "" }} {{ request()->is("admin/payments*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.bookingManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('reservation_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.reservations.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/reservations") || request()->is("admin/reservations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.reservation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('payment_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payments.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payments") || request()->is("admin/payments/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.payment.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('passenger_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/passengers*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-user-friends c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.passengerManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('passenger_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.passengers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/passengers") || request()->is("admin/passengers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-male c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.passenger.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/currencies*") ? "c-show" : "" }} {{ request()->is("admin/payment-methods*") ? "c-show" : "" }} {{ request()->is("admin/system-settings*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('currency_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.currencies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/currencies") || request()->is("admin/currencies/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-money-bill-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.currency.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('payment_method_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payment-methods.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/payment-methods") || request()->is("admin/payment-methods/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-credit-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.paymentMethod.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('system_setting_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.system-settings.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-settings") || request()->is("admin/system-settings/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.systemSetting.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="c-sidebar-nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "c-active" : "" }}">
                <i class="c-sidebar-nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
