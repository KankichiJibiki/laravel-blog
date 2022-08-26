@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto card p-3">
    <form action="/users/{{Auth::id()}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="row">
            {{-- left content --}}
            <div class="col-8">
                <div class="row mb-3">
                    <div class="col">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}">
                    </div>
                    {{-- error --}}
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{$user->email}}">
                    </div>
                    {{-- error --}}
                    @error('email')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            {{-- right content --}}
            <div class="col">
                <div class="row">
                    @if ($user->avatar != null)
                        <div class="col">
                            <img src="{{asset('storage/image/' . $user->avatar)}}" alt="{{$user->id}}" class="card card-img-top border border-warning my-3 ">
                        </div>
                    @else
                        <div class="col">
                            <img src="{{asset('storage/image/noimage-760x460.png')}}" alt="noImage" class="card card-img-top border border-warning my-3 ">
                        </div>
                    @endif
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <input type="file" name="avatar" id="avatar" class="form-control">
                    </div>
                </div>
                {{-- error --}}
                @error('avatar')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>
            {{-- btn --}}
            <div class="row">
                <div class="col">
                    <a href="/users/{{Auth::id()}}" class="btn btn-outline-dark d-grid">Back</a>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-outline-success w-100">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
