<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;

class Projects extends Controller
{
    protected function index()
    {
        return 'index()';
    }

    protected function getlist(Request $request)
    {
        $projects = Project::limit(999)
            ->offset(0)
            ->orderBy('id', 'desc')
            ->get();

        return [
            'projects' => $projects,
        ];
    }
}
