<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with('languages','type')->get(); 
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }
    public function show($slug){
        $project = Project::with('languages','type')->where('slug',$slug)->first();
        dd($project);
        if($project){
            return response()->json([
                'success' => true,
                'results' => $project
            ]);
        }else{
            return response()->json([
                'success' => false,
                'results' => 'Non hai trovato nessun progetto'
            ]);
        }
        
    }
}
