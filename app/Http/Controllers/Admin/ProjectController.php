<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $projects = Project::paginate(5);
        } else {
            $userId = Auth::id();
            $projects = Project::where('user_id', $userId)->paginate(5);
        }
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $languages = Language::all();
        $types = Type::all();
        return view('admin.projects.create', compact('types','languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $slug = Project::generateSlug($request->name);
        $data['slug'] = $slug;
        if($request->hasFile('image')){
            $path = Storage::disk('public')->put('project_images', $request->image);
            $data['image'] = $path;
        }
        $new_project = Project::create($data);

        if($request->has('languages')){
            $new_project->languages()->attach($request->languages);
        }
        return redirect()->route('admin.projects.show', $slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $languages = Language::all();
        return view('admin.projects.edit', compact('project','types','languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        $slug = Project::generateSlug($request->name);
        $data['slug'] = $slug;
        if($request->hasFile('image')){
            if ($project->image) {
                Storage::delete($project->image);
            }
            $path = Storage::disk('public')->put('project_images', $request->image);
            $data['image'] = $path;
        }
        $project->languages()->sync($request->languages);
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('message', "$project->name updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Project $project)
    {
        $deleted = $project->name;
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', "$deleted deleted successfully");
    }
}
