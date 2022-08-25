@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container mx-auto card p-3">

        <div class="row">
            {{-- left content --}}
            <div class="col-8">
                <div class="mb-4 d-flex p-2 border-0">
                    <h3 class="fw-bold">Username: {{$user->name}}</h3>
                    <a href="/users/{{Auth::id()}}/edit" class="btn btn-outline-primary ms-auto">Edit Profile</a>
                </div>
                <h4>Post History</h4>
                @foreach ($user->posts as $post)
                    <div class="card mb-1 p-1">
                        <div class="fw-bolder fs-5">{{$post->title}}</div>
                        <div>{{$post->body}}</div>
                    </div>
                @endforeach
            </div>
            {{-- right content --}}
            <div class="col">
                @if ($user->avatar != null)
                    <img src="{{asset('storage/image/' . $user->avatar)}}" alt="{{$user->avatar}}" class="card card-img-top border border-warning my-3 ">
                @else
                    <img src="{{asset('storage/image/noimage-760x460.png')}}" alt="noImage" class="card card-img-top border border-warning my-3 ">
                @endif
            </div>
        </div>
    </div>
@endsection
