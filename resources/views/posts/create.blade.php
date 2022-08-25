@extends('layouts.app')

@section('title', 'Create post')

@section('content')
    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        @csrf

        {{-- hidden user id --}}
        <div>
            <input type="text" name="user_id" id="user_id" value="{{Auth::id()}}" hidden>
        </div>

        {{-- title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}">
            {{-- error --}}
            @error('title')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        {{-- body --}}
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" id="body" cols="30" rows="5" class="form-control" placeholder="Start writing....">{{old('body')}}</textarea>
            {{-- error --}}
            @error('body')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        {{-- image --}}
        <div class="mb-3">
            <label for="" class="form-label text-muted">Image</label>
            <input type="file" name="image" id="image" accept=".jpeg, .jpg, .png, .gif" class="form-control">
            <div class="form-text">
                Accesptable Formats: .jpeg, .jpg, .png, .gif
                Maximum file size: 1848kb
            </div>
            {{-- error --}}
            @error('image')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Post</button>
    </form>
@endsection
