<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function __construct(private readonly BookingService $bookingService,) {}

    // Функция создания бронирования
    public function create(BookingRequest $request)
    {
        // Валидация входных данных
        // Также можно написать отдельный Request для валидации

        $data = $request->validated();

        // Создание записи бронирования
        $this->bookingService->booking($data);

        // Можно создать микросервис и унести в отдельный Service
//        $booking = Booking::create([
//            'client_id' => $data->client_id,
//            'room_id' => $data->room_id,
//            'check_in_date' => $data->check_in_date,
//            'check_out_date' => $data->check_out_date,
//            'total_amount' => $data->total_amount,
//            'status' => EnumStatuses::Confirmed,
//        ]);


        return response()->json(['ok' => true], true, options: JSON_UNESCAPED_UNICODE);
    }

    public function getBookingsByDate(Request $request)
    {
        // Валидация входных данных
        $request->validate([
            'start_date' => 'required|date', // Дата заезда
            'end_date' => 'required|date|after_or_equal:start_date' // Дата выезда должна быть больше или равна дате заезда
        ]);

        // Получаем параметры
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Получаем бронирования в указанном диапазоне дат
        $bookings = Booking::whereBetween('check_in_date', [$startDate, $endDate])
            ->orWhereBetween('check_out_date', [$startDate, $endDate])
            ->with(['client', 'room', 'building']) // Подгружаем связанные модели (клиент, комната, здание)
            ->get();

        // Возвращаем данные в формате JSON
        return response()->json([
            'status' => 'success',
            'data' => $bookings
        ]);
    }

}
