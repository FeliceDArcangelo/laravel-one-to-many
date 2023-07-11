<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $validations = [
        'title'             => 'required|string|max:50',
        'category_id'       => 'required|integer|exists:categories,id',
        'author'            => 'required|string|max:30',
        'creation_date'     => 'required|date',
        'last_update'       => 'required|date',
        'collaborators'     => 'string|max:150',
        'description'       => 'string',
        'languages'         => 'required|string|max:50',
        'link_github'       => 'required|url|max:200',
        
    ];

    private $validations_messages = [
        'required'      => 'il campo :attribute è obbligatorio',
        'max'           => 'il campo :attribute deve avere almeno :max caratteri',
        'url'           => 'il campo deve essere un url valido',
        'exists'        => 'Valore non valido',
    ];

    public function index()
    {
        $projects = Project::paginate(3);

        return view('admin.projects.index', compact('projects'));
    }

    
    public function create()
    {
        $categories = Category::all();
        return view('admin.projects.create', compact('categories'));
    }

    
    public function store(Request $request)
    {
        $request->validate($this->validations, $this->validations_messages);
        

        $data = $request->all();

        $newProject = new Project();

        $newProject->title              = $data['title'];
        $newProject->category_id        = $data['category_id'];
        $newProject->author             = $data['author'];
        $newProject->creation_date      = $data['creation_date'];
        $newProject->last_update        = $data['last_update'];
        $newProject->collaborators      = $data['collaborators'];
        $newProject->description        = $data['description'];
        $newProject->languages          = $data['languages'];
        $newProject->link_github        = $data['link_github'];

        $newProject->save(); // per salvare una nuova riga

        // return redirect()->route('project.show', ['project' => $newProject]);
        return to_route('admin.project.show', ['project' => $newProject]);
    }

   
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $categories = Category::all();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    
    public function update(Request $request, Project $project)
    {
        $request->validate($this->validations, $this->validations_messages);

        $data = $request->all();

        $project->title              = $data['title'];
        $project->category_id        = $data['category_id'];
        $project->author             = $data['author'];
        $project->creation_date      = $data['creation_date'];
        $project->last_update        = $data['last_update'];
        $project->collaborators      = $data['collaborators'];
        $project->description        = $data['description'];
        $project->languages          = $data['languages'];
        $project->link_github        = $data['link_github'];

        $project->update(); // per salvare una nuova riga

        // return redirect()->route('project.show', ['project' => $newProject]);
        return to_route('admin.project.show', ['project' => $project]);


    }

    
    public function destroy(Project $project)
    {
        $project->delete(); // attivando i soft delete il delete viene modificato automaticamente
        return to_route('admin.project.index')->with('delete_success', $project);
    }

    public function restore($id)
    {
        Project::withTrashed()->where('id', $id)->restore();

        $project = Project::find($id);

        return to_route('admin.project.trashed')->with('restore_success', $project);
    }

    public function cancel($id)
    {
        Project::withTrashed()->where('id', $id)->restore();

        $project = Project::find($id);

        return to_route('admin.project.index')->with('cancel_success', $project);
    }


    public function trashed()
    {
        $trashedProjects = Project::onlyTrashed()->paginate(3); 

        

        return view('admin.projects.trashed', compact('trashedProjects'));
    }

    public function hardDelete($id)
    {
        $project = Project::withTrashed()->find($id);
        $project->forceDelete();

        return to_route('admin.project.trashed')->with('delete_success', $project);
    
    }
}
