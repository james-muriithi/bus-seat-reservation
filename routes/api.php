<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Amenity
    Route::apiResource('amenities', 'AmenityApiController');

    // Bus Type
    Route::apiResource('bus-types', 'BusTypeApiController');

    // Bus
    Route::post('buses/media', 'BusApiController@storeMedia')->name('buses.storeMedia');
    Route::apiResource('buses', 'BusApiController');

    // Route
    Route::apiResource('routes', 'RouteApiController');

    // Pickup Point
    Route::apiResource('pickup-points', 'PickupPointApiController');

    // Drop Off Point
    Route::apiResource('drop-off-points', 'DropOffPointApiController');

    // Bus Seat Class
    Route::apiResource('bus-seat-classes', 'BusSeatClassApiController');

    // Bus Rating
    Route::apiResource('bus-ratings', 'BusRatingApiController');

    // Passenger
    Route::post('passengers/media', 'PassengerApiController@storeMedia')->name('passengers.storeMedia');
    Route::apiResource('passengers', 'PassengerApiController');

    // Reservation
    Route::apiResource('reservations', 'ReservationApiController');

    // Seat
    Route::apiResource('seats', 'SeatApiController');

    // Currency
    Route::apiResource('currencies', 'CurrencyApiController');

    // Payment Method
    Route::apiResource('payment-methods', 'PaymentMethodApiController');

    // System Setting
    Route::post('system-settings/media', 'SystemSettingApiController@storeMedia')->name('system-settings.storeMedia');
    Route::apiResource('system-settings', 'SystemSettingApiController');

    // Payment
    Route::apiResource('payments', 'PaymentApiController');
});
