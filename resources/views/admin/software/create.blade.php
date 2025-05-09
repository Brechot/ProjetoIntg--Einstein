@extends('layouts.app')

<div class="container pt-5">
    <span class="navbar-brand col">
        <h1>CRIAR SOFTWARE</h1>
    </span>
    <div class="linha-abaixo"></div>
</div>

@section('content')
    @livewire('software.create')
@endsection
