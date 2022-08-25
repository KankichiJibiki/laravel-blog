@extends('layouts.app')

@section('title', 'Post details')

@section('content')
    {{-- post --}}
    <div class="container card mt-3 mb-5">
        <div class="row">
            <div class="col fs-4 fw-bold">{{$post->title}}</div>
            <div class="col-3">Created {{$post->created_at->diffForHumans()}}</div>
            @if ($post->created_at != $post->updated_at)
                <div class="col">Updated {{$post->updated_at->diffForHumans()}}</div>
            @endif
        </div>

        <div class="row mb-3">
            <div class="col">{{$post->body}}</div>
        </div>

        <div class="row">
            @if ($post->image != null)
                <div class="col">
                    <img src="{{asset('storage/image/' . $post->image)}}" alt="{{$post->image}}" height="400" class="img img-responsive w-100">
                </div>
            @else
                <div class="text-muted text-center p-4 mb-3">No Image</div>
            @endif
        </div>
    </div>

    {{-- comment_input --}}
    <div class="mb-2">
        <h3>Comments</h3>
        <form action="/comments" method="post">
            @csrf
            @method('post')
            <div>
                <input type="number" name="user_id" id="user_id" hidden value="{{Auth::id()}}">
            </div>
            <div>
                <input type="number" name="post_id" id="post_id" hidden value="{{$post->id}}">
            </div>
            <div class="row">
                <div class="col">
                    <input type="text" name="content" id="content" class="form-control mb-1" placeholder="Write your comment">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-info float-end">Submit</button>
                </div>
            </div>
        </form>
    </div>

    {{-- display_comment --}}
    @if ($post->comments->isNotEmpty())
        @foreach ($post->comments as $comment)
            <div class="container">
                <ul class="list-group">
                    <li class="list-group-item mb-2">
                        <div class="row">
                            <div class="col">
                                <div class="fw-bold">{{$comment->user->name}}</div>
                            </div>
                            <div class="col-3">
                                {{$comment->created_at->diffForHumans()}} Ago
                            </div>
                        </div>
                        <div>{{$comment->content}}</div>
                    </li>
                </ul>
            </div>
        @endforeach
    @endif

@endsection
