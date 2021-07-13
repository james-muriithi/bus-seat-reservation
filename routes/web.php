<?php

Route::view('/', 'welcome');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Amenity
    Route::delete('amenities/destroy', 'AmenityController@massDestroy')->name('amenities.massDestroy');
    Route::resource('amenities', 'AmenityController');

    // Bus Type
    Route::delete('bus-types/destroy', 'BusTypeController@massDestroy')->name('bus-types.massDestroy');
    Route::resource('bus-types', 'BusTypeController');

    // Bus
    Route::delete('buses/destroy', 'BusController@massDestroy')->name('buses.massDestroy');
    Route::post('buses/media', 'BusController@storeMedia')->name('buses.storeMedia');
    Route::post('buses/ckmedia', 'BusController@storeCKEditorImages')->name('buses.storeCKEditorImages');
    Route::resource('buses', 'BusController');

    // Route
    Route::delete('routes/destroy', 'RouteController@massDestroy')->name('routes.massDestroy');
    Route::resource('routes', 'RouteController');

    // Pickup Point
    Route::delete('pickup-points/destroy', 'PickupPointController@massDestroy')->name('pickup-points.massDestroy');
    Route::resource('pickup-points', 'PickupPointController');

    // Drop Off Point
    Route::delete('drop-off-points/destroy', 'DropOffPointController@massDestroy')->name('drop-off-points.massDestroy');
    Route::resource('drop-off-points', 'DropOffPointController');

    // Bus Seat Class
    Route::delete('bus-seat-classes/destroy', 'BusSeatClassController@massDestroy')->name('bus-seat-classes.massDestroy');
    Route::resource('bus-seat-classes', 'BusSeatClassController');

    // Bus Rating
    Route::delete('bus-ratings/destroy', 'BusRatingController@massDestroy')->name('bus-ratings.massDestroy');
    Route::resource('bus-ratings', 'BusRatingController');

    // Seat Layout
    Route::delete('seat-layouts/destroy', 'SeatLayoutController@massDestroy')->name('seat-layouts.massDestroy');
    Route::resource('seat-layouts', 'SeatLayoutController');

    // Passenger
    Route::delete('passengers/destroy', 'PassengerController@massDestroy')->name('passengers.massDestroy');
    Route::post('passengers/media', 'PassengerController@storeMedia')->name('passengers.storeMedia');
    Route::post('passengers/ckmedia', 'PassengerController@storeCKEditorImages')->name('passengers.storeCKEditorImages');
    Route::resource('passengers', 'PassengerController');

    // Reservation
    Route::delete('reservations/destroy', 'ReservationController@massDestroy')->name('reservations.massDestroy');
    Route::resource('reservations', 'ReservationController');

    // Seat
    Route::delete('seats/destroy', 'SeatController@massDestroy')->name('seats.massDestroy');
    Route::resource('seats', 'SeatController');

    // Currency
    Route::delete('currencies/destroy', 'CurrencyController@massDestroy')->name('currencies.massDestroy');
    Route::resource('currencies', 'CurrencyController');

    // Payment Method
    Route::delete('payment-methods/destroy', 'PaymentMethodController@massDestroy')->name('payment-methods.massDestroy');
    Route::resource('payment-methods', 'PaymentMethodController');

    // System Setting
    Route::delete('system-settings/destroy', 'SystemSettingController@massDestroy')->name('system-settings.massDestroy');
    Route::post('system-settings/media', 'SystemSettingController@storeMedia')->name('system-settings.storeMedia');
    Route::post('system-settings/ckmedia', 'SystemSettingController@storeCKEditorImages')->name('system-settings.storeCKEditorImages');
    Route::resource('system-settings', 'SystemSettingController');

    // Payment
    Route::delete('payments/destroy', 'PaymentController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Amenity
    Route::delete('amenities/destroy', 'AmenityController@massDestroy')->name('amenities.massDestroy');
    Route::resource('amenities', 'AmenityController');

    // Bus Type
    Route::delete('bus-types/destroy', 'BusTypeController@massDestroy')->name('bus-types.massDestroy');
    Route::resource('bus-types', 'BusTypeController');

    // Bus
    Route::delete('buses/destroy', 'BusController@massDestroy')->name('buses.massDestroy');
    Route::post('buses/media', 'BusController@storeMedia')->name('buses.storeMedia');
    Route::post('buses/ckmedia', 'BusController@storeCKEditorImages')->name('buses.storeCKEditorImages');
    Route::resource('buses', 'BusController');

    // Route
    Route::delete('routes/destroy', 'RouteController@massDestroy')->name('routes.massDestroy');
    Route::resource('routes', 'RouteController');

    // Pickup Point
    Route::delete('pickup-points/destroy', 'PickupPointController@massDestroy')->name('pickup-points.massDestroy');
    Route::resource('pickup-points', 'PickupPointController');

    // Drop Off Point
    Route::delete('drop-off-points/destroy', 'DropOffPointController@massDestroy')->name('drop-off-points.massDestroy');
    Route::resource('drop-off-points', 'DropOffPointController');

    // Bus Seat Class
    Route::delete('bus-seat-classes/destroy', 'BusSeatClassController@massDestroy')->name('bus-seat-classes.massDestroy');
    Route::resource('bus-seat-classes', 'BusSeatClassController');

    // Bus Rating
    Route::delete('bus-ratings/destroy', 'BusRatingController@massDestroy')->name('bus-ratings.massDestroy');
    Route::resource('bus-ratings', 'BusRatingController');

    // Seat Layout
    Route::delete('seat-layouts/destroy', 'SeatLayoutController@massDestroy')->name('seat-layouts.massDestroy');
    Route::resource('seat-layouts', 'SeatLayoutController');

    // Passenger
    Route::delete('passengers/destroy', 'PassengerController@massDestroy')->name('passengers.massDestroy');
    Route::post('passengers/media', 'PassengerController@storeMedia')->name('passengers.storeMedia');
    Route::post('passengers/ckmedia', 'PassengerController@storeCKEditorImages')->name('passengers.storeCKEditorImages');
    Route::resource('passengers', 'PassengerController');

    // Reservation
    Route::delete('reservations/destroy', 'ReservationController@massDestroy')->name('reservations.massDestroy');
    Route::resource('reservations', 'ReservationController');

    // Seat
    Route::delete('seats/destroy', 'SeatController@massDestroy')->name('seats.massDestroy');
    Route::resource('seats', 'SeatController');

    // Currency
    Route::delete('currencies/destroy', 'CurrencyController@massDestroy')->name('currencies.massDestroy');
    Route::resource('currencies', 'CurrencyController');

    // Payment Method
    Route::delete('payment-methods/destroy', 'PaymentMethodController@massDestroy')->name('payment-methods.massDestroy');
    Route::resource('payment-methods', 'PaymentMethodController');

    // System Setting
    Route::delete('system-settings/destroy', 'SystemSettingController@massDestroy')->name('system-settings.massDestroy');
    Route::post('system-settings/media', 'SystemSettingController@storeMedia')->name('system-settings.storeMedia');
    Route::post('system-settings/ckmedia', 'SystemSettingController@storeCKEditorImages')->name('system-settings.storeCKEditorImages');
    Route::resource('system-settings', 'SystemSettingController');

    // Payment
    Route::delete('payments/destroy', 'PaymentController@massDestroy')->name('payments.massDestroy');
    Route::resource('payments', 'PaymentController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
