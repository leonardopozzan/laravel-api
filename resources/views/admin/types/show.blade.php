@extends('layouts.admin')
@section('content')
<div class="container-card">
    <div class="my-card">
        <div>Id : {{$type->id}}</div>
        <div>Tipo : {{$type->workflow}}</div>
    </div>
</div>
@endsection