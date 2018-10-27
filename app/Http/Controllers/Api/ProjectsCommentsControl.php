<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProjectComment;

class ProjectsCommentsControl extends Controller
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
            'project_id' => 'required',
        ]);

        if (!$validator->fails()) {
            $projectComment = new ProjectComment;
            $projectComment->text = $request->text;
            $projectComment->created_by = \Auth::user()->id;
            $projectComment->project_id = (int)$request->project_id;
            $projectComment->save();

            return [
                'projectComment' => $projectComment,
            ];
        }
        return [
            'errors' => $validator->errors(),
        ];

    }
}
