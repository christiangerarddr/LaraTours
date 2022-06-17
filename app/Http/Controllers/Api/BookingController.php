<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\TourDate;
use App\Models\Passenger;
use App\Models\BookingPassenger;

class BookingController extends Controller
{
    public function index()
    {
        return BookingResource::collection(Booking::all());
    }

    public function store(BookingRequest $request)
    {   

        $booking = Booking::create([
            'tour_date' => $request->tour_date, 
            'tour_id' => $request->tour_id, 
            'status' => $request->status
        ]);

        foreach ($request->passengers as $key => $value) {

            $passenger = Passenger::updateOrCreate([
                'given_name' => $value['given_name'], 
                'surname'    => $value['surname'], 
            ],[
                'email'      => $value['email'], 
                'mobile'     => $value['mobile'], 
                'passport'   => $value['passport'], 
                'birth_date' => $value['birth_date'], 
                'status'     => $value['status']
            ]);

            if(!isset($value['id'])) {
                $booking->passengers()->attach($passenger->id, ["special_request" => $value["pivot"]["special_request"]]);
            } else {
                BookingPassenger::updateOrCreate([
                    'booking_id'      => $value["pivot"]['booking_id'],
                    'passenger_id'    => $value["pivot"]['passenger_id']
                ],[
                    'special_request' => $value["pivot"]['special_request']
                ]);
            }

        }
        
        return new BookingResource($booking);
    }

    public function show(Booking $booking)
    {   
        return new BookingResource($booking);
    }

    public function update(BookingRequest $request, Booking $booking)
    {

        foreach ($request->passengers as $key => $value) {

            $passenger = Passenger::updateOrCreate([
                'given_name' => $value['given_name'], 
                'surname'    => $value['surname'], 
            ],[
                'email'      => $value['email'], 
                'mobile'     => $value['mobile'], 
                'passport'   => $value['passport'], 
                'birth_date' => $value['birth_date'], 
                'status'     => $value['status']
            ]);

            if(!isset($value['id'])) {
                $booking->passengers()->attach($passenger->id, ["special_request" => $value["pivot"]["special_request"]]);
            } else {
                BookingPassenger::updateOrCreate([
                    'booking_id'      => $value["pivot"]['booking_id'],
                    'passenger_id'    => $value["pivot"]['passenger_id']
                ],[
                    'special_request' => $value["pivot"]['special_request']
                ]);
            }

        }

        foreach ($request->removedPassengers as $key => $value) {
            $booking->passengers()->detach($value["id"]);
        }
        
        $booking->update($request->validated());
        
        return new BookingResource($booking);
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return response()->noContent();
    }
}