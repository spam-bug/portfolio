<?php

namespace App\Http\Controllers\Projects;

use App\Enums\ProjectStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\CreateProjectRequest;
use App\Http\Resources\Projects\ProjectCategoryResource;
use App\Http\Resources\Projects\ProjectResource;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Projects/Index', [
            'projects' => ProjectResource::collection(Project::when($request->has('category'), function ($query) use ($request) {
                return $query->whereHas('category', function ($query) use ($request) {
                    return $query->where('slug', $request->get('category'));
                });
            }, function ($query) {
                return $query;
            })->get()),
            'categories' => ProjectCategoryResource::collection(ProjectCategory::with('subcategories')->whereNull('parent_id')->get()),
            'publishedProjectCount' => Project::where('status', ProjectStatus::Published)->count(),
        ]);
    }

    public function create(CreateProjectRequest $request)
    {
        $publishedProjectCount = Project::where('status', ProjectStatus::Published)->count();

        Project::create([
            'category_id' => $request->get('category'),
            'subcategory_id' => $request->get('subcategory'),
            'title' => $request->get('title'),
            'url' => $request->get('url'),
            'status' => $publishedProjectCount === 5 ? ProjectStatus::Unpublished : ProjectStatus::Published,
        ]);
    }
}
