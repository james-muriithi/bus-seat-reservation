<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'amenity_create',
            ],
            [
                'id'    => 18,
                'title' => 'amenity_edit',
            ],
            [
                'id'    => 19,
                'title' => 'amenity_show',
            ],
            [
                'id'    => 20,
                'title' => 'amenity_delete',
            ],
            [
                'id'    => 21,
                'title' => 'amenity_access',
            ],
            [
                'id'    => 22,
                'title' => 'bus_type_create',
            ],
            [
                'id'    => 23,
                'title' => 'bus_type_edit',
            ],
            [
                'id'    => 24,
                'title' => 'bus_type_show',
            ],
            [
                'id'    => 25,
                'title' => 'bus_type_delete',
            ],
            [
                'id'    => 26,
                'title' => 'bus_type_access',
            ],
            [
                'id'    => 27,
                'title' => 'bus_management_access',
            ],
            [
                'id'    => 28,
                'title' => 'bus_create',
            ],
            [
                'id'    => 29,
                'title' => 'bus_edit',
            ],
            [
                'id'    => 30,
                'title' => 'bus_show',
            ],
            [
                'id'    => 31,
                'title' => 'bus_delete',
            ],
            [
                'id'    => 32,
                'title' => 'bus_access',
            ],
            [
                'id'    => 33,
                'title' => 'route_create',
            ],
            [
                'id'    => 34,
                'title' => 'route_edit',
            ],
            [
                'id'    => 35,
                'title' => 'route_show',
            ],
            [
                'id'    => 36,
                'title' => 'route_delete',
            ],
            [
                'id'    => 37,
                'title' => 'route_access',
            ],
            [
                'id'    => 38,
                'title' => 'routes_management_access',
            ],
            [
                'id'    => 39,
                'title' => 'pickup_point_create',
            ],
            [
                'id'    => 40,
                'title' => 'pickup_point_edit',
            ],
            [
                'id'    => 41,
                'title' => 'pickup_point_show',
            ],
            [
                'id'    => 42,
                'title' => 'pickup_point_delete',
            ],
            [
                'id'    => 43,
                'title' => 'pickup_point_access',
            ],
            [
                'id'    => 44,
                'title' => 'drop_off_point_create',
            ],
            [
                'id'    => 45,
                'title' => 'drop_off_point_edit',
            ],
            [
                'id'    => 46,
                'title' => 'drop_off_point_show',
            ],
            [
                'id'    => 47,
                'title' => 'drop_off_point_delete',
            ],
            [
                'id'    => 48,
                'title' => 'drop_off_point_access',
            ],
            [
                'id'    => 49,
                'title' => 'bus_seat_class_create',
            ],
            [
                'id'    => 50,
                'title' => 'bus_seat_class_edit',
            ],
            [
                'id'    => 51,
                'title' => 'bus_seat_class_show',
            ],
            [
                'id'    => 52,
                'title' => 'bus_seat_class_delete',
            ],
            [
                'id'    => 53,
                'title' => 'bus_seat_class_access',
            ],
            [
                'id'    => 54,
                'title' => 'bus_rating_create',
            ],
            [
                'id'    => 55,
                'title' => 'bus_rating_edit',
            ],
            [
                'id'    => 56,
                'title' => 'bus_rating_show',
            ],
            [
                'id'    => 57,
                'title' => 'bus_rating_delete',
            ],
            [
                'id'    => 58,
                'title' => 'bus_rating_access',
            ],
            [
                'id'    => 59,
                'title' => 'seat_layout_create',
            ],
            [
                'id'    => 60,
                'title' => 'seat_layout_edit',
            ],
            [
                'id'    => 61,
                'title' => 'seat_layout_show',
            ],
            [
                'id'    => 62,
                'title' => 'seat_layout_delete',
            ],
            [
                'id'    => 63,
                'title' => 'seat_layout_access',
            ],
            [
                'id'    => 64,
                'title' => 'report_access',
            ],
            [
                'id'    => 65,
                'title' => 'booking_management_access',
            ],
            [
                'id'    => 66,
                'title' => 'passenger_create',
            ],
            [
                'id'    => 67,
                'title' => 'passenger_edit',
            ],
            [
                'id'    => 68,
                'title' => 'passenger_show',
            ],
            [
                'id'    => 69,
                'title' => 'passenger_delete',
            ],
            [
                'id'    => 70,
                'title' => 'passenger_access',
            ],
            [
                'id'    => 71,
                'title' => 'passenger_management_access',
            ],
            [
                'id'    => 72,
                'title' => 'reservation_create',
            ],
            [
                'id'    => 73,
                'title' => 'reservation_edit',
            ],
            [
                'id'    => 74,
                'title' => 'reservation_show',
            ],
            [
                'id'    => 75,
                'title' => 'reservation_delete',
            ],
            [
                'id'    => 76,
                'title' => 'reservation_access',
            ],
            [
                'id'    => 77,
                'title' => 'seat_create',
            ],
            [
                'id'    => 78,
                'title' => 'seat_edit',
            ],
            [
                'id'    => 79,
                'title' => 'seat_show',
            ],
            [
                'id'    => 80,
                'title' => 'seat_delete',
            ],
            [
                'id'    => 81,
                'title' => 'seat_access',
            ],
            [
                'id'    => 82,
                'title' => 'setting_access',
            ],
            [
                'id'    => 83,
                'title' => 'currency_create',
            ],
            [
                'id'    => 84,
                'title' => 'currency_edit',
            ],
            [
                'id'    => 85,
                'title' => 'currency_show',
            ],
            [
                'id'    => 86,
                'title' => 'currency_delete',
            ],
            [
                'id'    => 87,
                'title' => 'currency_access',
            ],
            [
                'id'    => 88,
                'title' => 'payment_method_create',
            ],
            [
                'id'    => 89,
                'title' => 'payment_method_edit',
            ],
            [
                'id'    => 90,
                'title' => 'payment_method_show',
            ],
            [
                'id'    => 91,
                'title' => 'payment_method_delete',
            ],
            [
                'id'    => 92,
                'title' => 'payment_method_access',
            ],
            [
                'id'    => 93,
                'title' => 'system_setting_create',
            ],
            [
                'id'    => 94,
                'title' => 'system_setting_edit',
            ],
            [
                'id'    => 95,
                'title' => 'system_setting_show',
            ],
            [
                'id'    => 96,
                'title' => 'system_setting_delete',
            ],
            [
                'id'    => 97,
                'title' => 'system_setting_access',
            ],
            [
                'id'    => 98,
                'title' => 'payment_create',
            ],
            [
                'id'    => 99,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 100,
                'title' => 'payment_show',
            ],
            [
                'id'    => 101,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 102,
                'title' => 'payment_access',
            ],
            [
                'id'    => 103,
                'title' => 'trip_create',
            ],
            [
                'id'    => 104,
                'title' => 'trip_edit',
            ],
            [
                'id'    => 105,
                'title' => 'trip_show',
            ],
            [
                'id'    => 106,
                'title' => 'trip_delete',
            ],
            [
                'id'    => 107,
                'title' => 'trip_access',
            ],
            [
                'id'    => 108,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
