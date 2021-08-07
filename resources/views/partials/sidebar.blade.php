<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ route('admin.home') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">{{ trans('cruds.busManagement.title') }}</span></li>
                @can('bus_management_access')
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i class="fa fa-bus"></i><span class="hide-menu">
                                {{ trans('cruds.busManagement.title') }}
                            </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            @can('amenity_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.amenities.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.amenity.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('bus_type_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.bus-types.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.busType.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('bus_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.buses.index') }}" class="sidebar-link"><span class="hide-menu">
                                            {{ trans('cruds.bus.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('bus_seat_class_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.bus-seat-classes.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.busSeatClass.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('bus_rating_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.bus-ratings.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.busRating.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('seat_layout_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.seat-layouts.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.seatLayout.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('routes_management_access')
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i class="ti-vector"></i><span class="hide-menu">
                                {{ trans('cruds.routesManagement.title') }}
                            </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            @can('route_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.routes.index') }}" class="sidebar-link"><span class="hide-menu">
                                            {{ trans('cruds.route.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('pickup_point_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.pickup-points.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.pickupPoint.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('drop_off_point_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.drop-off-points.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.dropOffPoint.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('passenger_management_access')
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">
                                {{ trans('cruds.passengerManagement.title') }}
                            </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            @can('currency_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.passengers.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.passenger.title') }}s
                                        </span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan

                @can('setting_access')
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">
                                {{ trans('cruds.setting.title') }}
                            </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            @can('currency_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.currencies.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.currency.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('payment_method_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.payment-methods.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.paymentMethod.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            @can('system_setting_access')
                                <li class="sidebar-item">
                                    <a href="{{ route('admin.system-settings.index') }}" class="sidebar-link"><span
                                            class="hide-menu">
                                            {{ trans('cruds.systemSetting.title') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{ route('profile.password.edit') }}" aria-expanded="false">
                        <i data-feather="key" class="feather-icon"></i>
                        <span class="hide-menu">
                            {{ trans('global.change_password') }}
                        </span>
                        </a>
                    </li>
                    @endcan
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
