<?php

namespace App\Http\Controllers\Api;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trip;

class Trips extends Controller
{
    protected function index()
    {
        return 'index()';
    }

    protected function getlist(Request $request)
    {
        $trips = Trip::limit(999)
            ->offset(0)
            ->orderBy('id', 'desc')
            ->get();

        return [
            'trips' => $trips,
        ];
    }
}
