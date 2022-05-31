<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Projects/Index', ['projects' => 'fiba']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function storeBoard(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        Board::create($request->all());

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $project = Project::create($request->all());
        return back();
    }

    public function storeTask(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        Task::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id, $p_id)
    {
       
        $project = Project::find($p_id);
        return Inertia::render('Projects/Index', ['project'  => $project, 'team' => $project->team, 'boards' => $project->boards, 'token' => csrf_token()]);

    }

    public function upload(Request $request)
    {

        return 'http://192.168.0.10:8000/uploads/Avatar/Teams/v6p8WZMS2tMI8mm8wZ1r3gnSd1egUsvlH1ArDNMI.png';
        dd($request->all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $project)
    {
    
        $proj = Project::find($project);

        $proj->overview = $request->overview;
        $proj->save();

        return back()->with($proj);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
