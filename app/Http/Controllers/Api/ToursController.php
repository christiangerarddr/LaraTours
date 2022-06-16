<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ToursRequest;
use App\Http\Resources\ToursResource;
use App\Models\Tour;
use App\Models\TourDate;

class ToursController extends Controller
{
    public function index()
    {
        return ToursResource::collection(Tour::all());
    }

    public function store(ToursRequest $request)
    {

        $tour = Tour::create($request->validated());
        
        foreach ($request->tour_dates as $value) {
            $tour->tourDates()->updateOrCreate($value);
        }

        return new ToursResource($tour);
    }

    public function show(Tour $tour)
    {   
        return new ToursResource($tour);
    }

    public function update(ToursRequest $request, Tour $tour)
    {
        $tour->update($request->validated());

        foreach ($request->tour_dates as $value) {
            $tour->tourDates()->updateOrCreate($value);
        }

        return new ToursResource($tour);
    }

    public function destroy(Tour $tour)
    {
        $tour->delete();

        return response()->noContent();
    }

    public function destroyDate(TourDate $tourDate)
    {
        $tourDate->delete();

        return response()->noContent();
    }
}