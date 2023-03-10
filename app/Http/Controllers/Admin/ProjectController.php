<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project = new Project();
        return view('admin.projects.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'url' => 'nullable|url',
        ], [
            'title.required' => 'Il titolo del progetto è obbligatorio',
            'image.image' => 'L\'image deve essere un file di tipo immagine',
            'url.url' => 'Il GitHub URL deve essere un link valido',
        ]);

        $data = $request->all();

        $project = new Project();

        if (array_key_exists('image', $data)) {
            $img_url = Storage::put('projects', $data['image']);
            $data['image'] = $img_url;
        }

        $project->fill($data);
        $project->save();

        return to_route('admin.projects.show', $project->id)
            ->with('message', "Il progetto $project->title è stato creato correttamente")
            ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
            'url' => 'nullable|url',
        ], [
            'title.required' => 'Il titolo del progetto è obbligatorio',
            'image.image' => 'L\'image deve essere un file di tipo immagine',
            'url.url' => 'Il GitHub URL deve essere un link valido',
        ]);

        $data = $request->all();

        if (array_key_exists('image', $data)) {
            if ($project->image) Storage::delete($project->image);
            $img_url = Storage::put('projects', $data['image']);
            $data['image'] = $img_url;
        }

        $project->fill($data);

        $project->update($data);
        return to_route('admin.projects.show', $project->id)
            ->with('message', 'Il progetto è stato modificato correttamente')
            ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) Storage::delete($project->image);
        $project->delete();
        return to_route('admin.projects.index')
            ->with('message', "Il progetto $project->title è stato eliminato definitivamente")
            ->with('type', 'success');
    }
}
