@extends('layouts.admin')
@section('content')
    <section class="my-5">
        <form action="{{ route('admin.types.store') }}" method="POST" class="my-form">
        @csrf
            <h1 class="text-center fs-2 mb-3">Aggiungi un Tipo</h1>
            <div>
                <label for="workflow">Nome</label>
                <input type="text" class="form-control @error('workflow') is-invalid @enderror" name="workflow" id="workflow" required maxlength="15">
                @error('workflow')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary" id="btn-submit">Invia</button>
                <button type="reset" class="btn btn-danger" id="btn-reset">Resetta</button>
            </div>

        </form>

    </section>
@endsection