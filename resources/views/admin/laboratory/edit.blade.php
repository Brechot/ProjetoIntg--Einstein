@extends('layouts.app')

<div class="container pt-5 ps-3">
    <span class="navbar-brand col">
        <h1>EDITAR LABORATÓRIO ID: {{$laboratory->id}}</h1>
    </span>
    <div class="linha-abaixo ps-3"></div>
</div>

@section('content')
    @livewire('laboratory.edit',[$laboratory])
@endsection
