@extends('layouts.admin')
@section('content')
    <section class="my-5">
        <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST" class="my-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

            <h1 class="text-center fs-2 mb-3">Modifica un Progetto</h1>
            <div>
                <label for="name">Nome</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required maxlength="45" value="{{old('name',$project->name)}}">
                @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            {{-- <div>
                <label for="dev_lang">Linguaggi di programmazione usati</label>
                <input type="text" class="form-control @error('dev_lang') is-invalid @enderror" name="dev_lang" id="dev_lang" required maxlength="240" value="{{old('dev_lang',$project->dev_lang)}}">
                @error('dev_lang')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div> --}}
            <div>
                <label for="description">Descrizione</label>
                <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{old('description',$project->description)}}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="framework">Framework</label>
                <input type="text" class="form-control @error('framework') is-invalid @enderror" name="framework" id="framework" value="{{old('framework',$project->framework)}}">
                @error('framework')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="team">Membri del Team</label>
                <input type="text" class="form-control @error('team') is-invalid @enderror" name="team" id="team" value="{{old('team',$project->team)}}"> 
                @error('team')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="git_link">Link alla repo di GitHub</label>
                <input type="text" class="form-control @error('git_link') is-invalid @enderror" name="git_link" id="git_link" value="{{old('git_link',$project->git_link)}}">
                @error('git_link')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="diff_lvl">Livello di difficolt?? (da 1 a 10)</label>
                <select name="diff_lvl" class="form-control @error('diff_lvl') is-invalid @enderror">
                    @for ($i=0; $i<=10;$i++)
                        <option value="{{$i}}" {{old('diff_lvl',$project->diff_lvl) == $i ? 'selected': ''}}>{{$i}}</option>
                    @endfor
                </select>
                {{-- <input type="number" step="1" class="form-control @error('diff_lvl') is-invalid @enderror" name="diff_lvl" id="diff_lvl" min="0" max="10"> --}}
                @error('diff_lvl')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="type_id">Tipo</label>
                <select name="type_id" class="form-control @error('type_id') is-invalid @enderror">
                    <option value="" {{old('type_id',$project->type_id) == '' ? 'selected' : ''}}>Seleziona...</option>
                    @foreach ($types as $type)
                        <option value="{{$type->id}}" {{old('type_id',$project->type_id) == $type->id ? 'selected' : ''}}>{{$type->workflow}}</option>
                    @endforeach
                </select>
                @error('type_id')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="languages">Linguaggi</label> <br>
                
                @foreach ($languages as $language)
                    @if (old("languages"))
                        <input type="checkbox" class="form-check-input" id="{{$language->slug}}" name="languages[]" value="{{$language->id}}" {{in_array( $language->id, old("languages", []) ) ? 'checked' : ''}}>
                        <span class="text-capitalize pe-2">{{$language->name}}</span>
                    @else
                        <input type="checkbox" class="form-check-input" id="{{$language->slug}}" name="languages[]" value="{{$language->id}}" {{$project->languages->contains($language) ? 'checked' : ''}}>
                        <span class="text-capitalize pe-2">{{$language->name}}</span>
                    @endif
                @endforeach
                {{-- @error('languages')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror --}}
            </div>
            <div>
                <label for="image" class="form-label">Immagine</label>
                <input type="file" name="image" id="image" class="form-control  @error('image') is-invalid @enderror" >
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary" id="btn-submit">Invia</button>
                <button type="reset" class="btn btn-danger" id="btn-reset">Resetta</button>
            </div>

        </form>

    </section>
@endsection