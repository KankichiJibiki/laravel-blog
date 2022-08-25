@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif
    @if ($post_paginate->isEmpty())
        <div class="" style="margin-top: 100px ">
            <div class="text-muted text-center">No posts yet</div>
            <div class="text-center">
                <a href="{{route('posts.create')}}" class="text-decoration-none">Create new post</a>
            </div>
        </div>
    @else
        <div>{{$post_paginate->links()}}</div>
        @foreach ($post_paginate as $post)
            <div class="card container mx-auto my-3 border border-secondary p-2">
                {{-- title --}}
                <div class="row float-start">
                    <div class="col">
                        <a href="/posts/{{$post->uuid}}">{{$post->title}}</a>
                    </div>
                    <div class="col-3">
                        <div class=" float-end">Posted {{$post->created_at->diffForHumans()}}</div>
                    </div>
                    @if ($post->created_at != $post->updated_at)
                        <div class="col-3">
                            <div class=" float-end">Updated {{$post->updated_at->diffForHumans()}}</div>
                        </div>
                    @endif
                </div>
                {{-- body --}}
                <div class="row float-start mb-5">
                    <div class="col">
                        {{$post->body}}
                    </div>
                </div>
                {{-- btn --}}
                @if (Auth::id() == $post->user->id)
                    <div>
                        <div class="">
                            <a href="posts/{{$post->uuid}}/edit" class="btn btn-primary float-end me-1">Edit</a>
                        </div>
                        <div class="ms-1">
                            <form action="/posts/{{$post->id}}" method="post" onsubmit="return confirm()">
                                @csrf
                                @method('delete')

                                <button type="submit" class="btn btn-danger float-end ms-1">Delete</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    @endif

@endsection
