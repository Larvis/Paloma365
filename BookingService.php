<?php


namespace App\Services\Auth;

use App\Models\Booking;
use Exception;
use Illuminate\Support\Facades\DB;

final class BookingService
{
    public function __construct()
    {
    }

    public function book(array $attributes = [], array $fields = []): Booking
    {
        $model = new Booking;

        $model->fill($attributes);

        if (count($fields) > 0) {
            $model->forceFill($fields);
        }

        $model->save();
        $model->refresh();

        return $model;
    }
}
