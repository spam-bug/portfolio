<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Resources\Projects\ProjectCategoryResource;
use App\Models\ProjectCategory;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        return ProjectCategoryResource::collection(ProjectCategory::with('subcategories')->whereNull('parent_id')->get());
    }
}
