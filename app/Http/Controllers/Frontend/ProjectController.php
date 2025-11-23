<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('start_date', 'desc')->paginate(10);

        return view('frontend.pages.projects.index', compact('projects'));
    }

    public function show($slug)
    {
        $project = Project::with(['client', 'service', 'subService'])->where('slug', $slug)->firstOrFail();

        $prev = Project::where('id', '<', $project->id)->orderBy('id','desc')->first();
        $next = Project::where('id', '>', $project->id)->orderBy('id','asc')->first();

        return view('frontend.pages.projects.show', compact('project','prev','next'));
    }

}
