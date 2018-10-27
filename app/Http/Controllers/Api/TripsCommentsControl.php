<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TripComment;

class TripsCommentsControl extends Controller
{
    protected function index()
    {
        return 'index()';
    }

    protected function create(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'text' => 'required|max:255',
            'trip_id' => 'required',
        ]);

        if (!$validator->fails()) {
            $tripComment = new tripComment;
            $tripComment->text = $request->text;
            $tripComment->created_by = \Auth::user()->id;
            $tripComment->trip_id = (int)$request->trip_id;
            $tripComment->save();

            return [
                'tripComment' => $tripComment,
            ];
        }
        return [
            'errors' => $validator->errors(),
        ];

    }
}
