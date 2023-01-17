@extends('layouts.admin')
@section('content')

    <div class="projects-list">
        
        <div class="table-container">
            @if(session()->has('message'))
            <div class="alert alert-success mb-3 mt-3 w-75 m-auto">
                {{ session()->get('message') }}
            </div>
            @endif
            <a href="{{route('admin.types.create')}}" class="text-white"><button class="btn btn-primary mb-2"><i class="fa-solid fa-plus"></i></button></a>
            
            <table>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <th scope="row">{{$type->id}}</th>
                            <td><a href="{{route('admin.types.show', $type->slug)}}" title="View type">{{$type->workflow}}</a></td>
                            <td><a class="link-secondary" href="{{route('admin.types.edit', $type->slug)}}" title="Edit type"><i class="fa-solid fa-pen"></i></a></td>
                            <td>
                                <form action="{{route('admin.types.destroy', $type->slug)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button btn btn-danger ms-3" data-item-title="{{$type->workflow}}"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection