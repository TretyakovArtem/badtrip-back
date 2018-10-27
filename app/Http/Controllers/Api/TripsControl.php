<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trip;

class TripsControl extends Controller
{
    protected function index()
    {
        return 'index()';
    }

    protected function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'closed_at' => '',
            'price_from' => 'required',
            'price_to' => 'required',
            'text' => 'required|max:255',
            'lat' => 'required',
            'lng' => 'required',
            'trip_start' => 'required',
            'trip_end' => 'required',
        ]);

        if (!$validator->fails()) {
            $trip = new Trip;
            $trip->created_by = \Auth::user()->id;
            $trip->created_at = strtotime($request->created_at);
            $trip->closed_at = time() + (86400 * 2); // Закрываем через 2 дня
            $trip->price_from = (int)$request->price_from;
            $trip->price_to = (int)$request->price_to;
            $trip->text = $request->text;
            $trip->lat = round((float)$request->lat, 6);
            $trip->lng = round((float)$request->lng, 6);
            $trip->trip_start = strtotime($request->trip_start);
            $trip->trip_end = strtotime($request->trip_end);
            $trip->save();

            return [
                'trip' => $trip,
            ];
        }
        return [
            'errors' => $validator->errors(),
            'success' => false,
        ];

    }
}
