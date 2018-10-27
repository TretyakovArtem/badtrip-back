<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectsControl extends Controller
{
    protected function index()
    {
        return 'index()';
    }

    protected function create(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'budget_from' => 'required',
            'budget_to' => 'required',
            'text' => 'required|max:255',
        ]);

        if (!$validator->fails()) {
            $project = new Project;
            $project->created_at = time();
            $project->created_by = \Auth::user()->id;
            $project->title = $request->title;
            $project->text = $request->text;
            $project->budget_from = (int)$request->budget_from;
            $project->budget_to = (int)$request->budget_to;
            $project->closed_at = time() + 86400 * 2;
            $project->save();

            return [
                'project' => $project,
            ];
        }
        return [
            'errors' => $validator->errors(),
        ];

    }
}
