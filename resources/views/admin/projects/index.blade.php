@extends('layouts.admin')
@section('content')

    <div class="projects-list">
        <div class="table-container">
            @if(session()->has('message'))
            <div class="alert alert-success mb-3 mt-3 w-75 m-auto">
                {{ session()->get('message') }}
            </div>
            @endif
            <a href="{{route('admin.projects.create')}}" class="text-white"><button class="btn btn-primary mb-2"><i class="fa-solid fa-plus"></i></button></a>
            <table>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Type</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row">{{$project->id}}</th>
                            <td><a href="{{route('admin.projects.show', $project->slug)}}" title="View project">{{$project->name}}</a></td>
                            <td>{{Str::limit($project->description,50)}}</td>
                            @if ($project->type)
                                <td>{{$project->type->workflow}}</td>
                            @else
                                <td>/</td>
                            @endif
                            <td><a class="link-secondary" href="{{route('admin.projects.edit', $project->slug)}}" title="Edit project"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{route('admin.projects.destroy', $project->slug)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button btn btn-danger ms-3" data-item-title="{{$project->title}}"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $projects->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@endsection