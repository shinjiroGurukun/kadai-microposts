@extends('layouts.app')

@section('content')
    @if (Auth::check())
        @foreach ($favoriteUsers as $favoriteUser)
            <div>
                {{$favoriteUser->name}}
            </div>
        @endforeach
    @else
    @endif
@endsection