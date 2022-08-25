@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <form action="/posts/{{$post->uuid}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- hidden user id --}}
        <div>
            <input type="text" name="user_id" id="user_id" value="{{Auth::id()}}" hidden>
        </div>

        {{-- title --}}
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{$post->title}}">
            {{-- error --}}
            @error('title')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        {{-- body --}}
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" id="body" cols="30" rows="5" class="form-control" placeholder="Start writing....">{{$post->body}}</textarea>
            {{-- error --}}
            @error('body')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        {{-- image --}}
        <div class="mb-3">
            <label for="" class="form-label text-muted">Image</label>
            <input type="file" name="image" id="image" accept=".jpeg, .jpg, .png, .gif" class="form-control" value="{{$post->image}}">
            <div class="form-text">
                Accesptable Formats: .jpeg, .jpg, .png, .gif
                Maximum file size: 1848kb
            </div>
            {{-- error --}}
            @error('img')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
