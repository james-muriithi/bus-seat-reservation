<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'profile'                  => 'Profile',
            'profile_helper'           => ' ',
            'phone'                    => 'Phone',
            'phone_helper'             => ' ',
            'is_admin'                 => 'Is Admin',
            'is_admin_helper'          => ' ',
        ],
    ],
    'amenity' => [
        'title'          => 'Amenities',
        'title_singular' => 'Amenity',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'icon'              => 'Icon',
            'icon_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'busType' => [
        'title'          => 'Bus Type',
        'title_singular' => 'Bus Type',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'bus_type'          => 'Bus Type',
            'bus_type_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
        ],
    ],
    'busManagement' => [
        'title'          => 'Bus Management',
        'title_singular' => 'Bus Management',
    ],
    'bus' => [
        'title'          => 'Bus',
        'title_singular' => 'Bu',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'bus_name'          => 'Bus Name',
            'bus_name_helper'   => ' ',
            'bus_reg_no'        => 'Bus Reg No',
            'bus_reg_no_helper' => ' ',
            'bus_type'          => 'Bus Type',
            'bus_type_helper'   => ' ',
            'max_seats'         => 'Max Seats',
            'max_seats_helper'  => ' ',
            'amenities'         => 'Amenities',
            'amenities_helper'  => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'images'            => 'Images',
            'images_helper'     => ' ',
        ],
    ],
    'route' => [
        'title'          => 'Routes',
        'title_singular' => 'Route',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'bus'                => 'Bus',
            'bus_helper'         => ' ',
            'board_point'        => 'Board Point',
            'board_point_helper' => ' ',
            'board_time'         => 'Board Time',
            'board_time_helper'  => ' ',
            'drop_point'         => 'Drop Point',
            'drop_point_helper'  => ' ',
            'drop_time'          => 'Drop Time',
            'drop_time_helper'   => ' ',
            'fare'               => 'Fare',
            'fare_helper'        => ' ',
            'status'             => 'Status',
            'status_helper'      => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'routesManagement' => [
        'title'          => 'Routes Management',
        'title_singular' => 'Routes Management',
    ],
    'pickupPoint' => [
        'title'          => 'Pickup Points',
        'title_singular' => 'Pickup Point',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'pickup_point'        => 'Pickup Point',
            'pickup_point_helper' => ' ',
            'pickup_time'         => 'Pickup Time',
            'pickup_time_helper'  => ' ',
            'status'              => 'Status',
            'status_helper'       => ' ',
            'route'               => 'Route',
            'route_helper'        => ' ',
            'landmark'            => 'Landmark',
            'landmark_helper'     => ' ',
            'address'             => 'Address',
            'address_helper'      => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'dropOffPoint' => [
        'title'          => 'Drop Off Points',
        'title_singular' => 'Drop Off Point',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'drop_off_point'        => 'Drop Off Point',
            'drop_off_point_helper' => ' ',
            'drop_time'             => 'Drop Time',
            'drop_time_helper'      => ' ',
            'landmark'              => 'Landmark',
            'landmark_helper'       => ' ',
            'address'               => 'Address',
            'address_helper'        => ' ',
            'route'                 => 'Route',
            'route_helper'          => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
    'busSeatClass' => [
        'title'          => 'Bus Seat Classes',
        'title_singular' => 'Bus Seat Class',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'color'             => 'Color',
            'color_helper'      => ' ',
            'status'            => 'Status',
            'status_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'busRating' => [
        'title'          => 'Bus Ratings',
        'title_singular' => 'Bus Rating',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'bus_quality'            => 'Bus Quality',
            'bus_quality_helper'     => ' ',
            'punctuality'            => 'Punctuality',
            'punctuality_helper'     => ' ',
            'staff_behaviour'        => 'Staff Behaviour',
            'staff_behaviour_helper' => ' ',
            'comment'                => 'Comment',
            'comment_helper'         => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'seatLayout' => [
        'title'          => 'Seats Layout',
        'title_singular' => 'Seats Layout',
    ],
    'report' => [
        'title'          => 'Reports',
        'title_singular' => 'Report',
    ],
    'bookingManagement' => [
        'title'          => 'Booking Management',
        'title_singular' => 'Booking Management',
    ],
    'passenger' => [
        'title'          => 'Passenger',
        'title_singular' => 'Passenger',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'mobile'            => 'Mobile',
            'mobile_helper'     => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'age'               => 'Age',
            'age_helper'        => ' ',
            'gender'            => 'Gender',
            'gender_helper'     => ' ',
            'avatar'            => 'Avatar',
            'avatar_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'password'          => 'Password',
            'password_helper'   => ' ',
        ],
    ],
    'passengerManagement' => [
        'title'          => 'Passenger Management',
        'title_singular' => 'Passenger Management',
    ],
    'reservation' => [
        'title'          => 'Reservation',
        'title_singular' => 'Reservation',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'passenger'               => 'Passenger',
            'passenger_helper'        => ' ',
            'route'                   => 'Route',
            'route_helper'            => ' ',
            'pickup_point'            => 'Pickup Point',
            'pickup_point_helper'     => ' ',
            'reservation_date'        => 'Reservation Date',
            'reservation_date_helper' => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
            'seat'                    => 'Seat',
            'seat_helper'             => ' ',
        ],
    ],
    'seat' => [
        'title'          => 'Seats',
        'title_singular' => 'Seat',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'bus'               => 'Bus',
            'bus_helper'        => ' ',
            'row'               => 'Row',
            'row_helper'        => ' ',
            'column'            => 'Column',
            'column_helper'     => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'details'           => 'Details',
            'details_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'setting' => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
    ],
    'currency' => [
        'title'          => 'Currency',
        'title_singular' => 'Currency',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'currency_code'          => 'Currency Code',
            'currency_code_helper'   => ' ',
            'currency_name'          => 'Currency Name',
            'currency_name_helper'   => ' ',
            'currency_symbol'        => 'Currency Symbol',
            'currency_symbol_helper' => ' ',
            'status'                 => 'Status',
            'status_helper'          => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'paymentMethod' => [
        'title'          => 'Payment Methods',
        'title_singular' => 'Payment Method',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'systemSetting' => [
        'title'          => 'System Settings',
        'title_singular' => 'System Setting',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'default_currency'        => 'Default Currency',
            'default_currency_helper' => ' ',
            'company_name'            => 'Company Name',
            'company_name_helper'     => ' ',
            'company_logo'            => 'Company Logo',
            'company_logo_helper'     => ' ',
            'smtp_username'           => 'Smtp Username',
            'smtp_username_helper'    => ' ',
            'smtp_host'               => 'Smtp Host',
            'smtp_host_helper'        => ' ',
            'smtp_password'           => 'Smtp Password',
            'smtp_password_helper'    => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'payment' => [
        'title'          => 'Payments',
        'title_singular' => 'Payment',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'payment_method'        => 'Payment Method',
            'payment_method_helper' => ' ',
            'amount'                => 'Amount',
            'amount_helper'         => ' ',
            'approved'              => 'Approved',
            'approved_helper'       => ' ',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
        ],
    ],
];
