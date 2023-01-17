<?php 
use App\Models\Type;
?>
@extends('layouts.admin')
@section('content')
<div class="container-card">
    <div class="my-card">
        <div>
            {{-- <img src="https://picsum.photos/id/{{$project->id + 10}}/1920/1080" alt=""> --}}
            <div class="img-box">
                @if ($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" alt="">
                @else
                <img src="https://picsum.photos/id/20/1920/1080" alt="">
                @endif
            </div>
            <div>Nome: {{$project->name}}</div>
            @if ($project->type)
                <div>{{$project->type->workflow}}</div>
            @else
                <div>/</div>
            @endif
            @if (count($project->languages))
                @foreach ($project->languages as $language)
                <div>{{$language->name}}</div>
                @endforeach
            @endif
            <div>Difficoltà: {{$project->diff_lvl}}</div>
            <div>Framework: {{$project->framework}}</div>
            <div>Team: {{$project->team}}</div>
            <div>Git link: {{$project->git_link}}</div>
            <div>Description: {{$project->description}}</div>
        </div>
    </div>
</div>
@endsection