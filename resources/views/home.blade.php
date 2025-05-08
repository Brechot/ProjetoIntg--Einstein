@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{route("einstein.users.index")}}">users</a>
                    <a href="{{route("einstein.roles.index")}}">roles</a>
                    <a href="{{route("einstein.discipline.index")}}">discipline</a>
                    <a href="{{route("einstein.laboratory.index")}}">laboratory</a>
                    <a href="{{route("einstein.reserve.index")}}">reserve</a>
                    <a href="{{route("einstein.software.index")}}">software</a>

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
