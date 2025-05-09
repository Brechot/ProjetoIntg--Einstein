@extends('layouts.app')

<div class="container pt-5 ps-3">
    <span class="navbar-brand col">
        <h1>LABORATÓRIOS</h1>
    </span>
    <div class="linha-abaixo ps-3"></div>
</div>

@section('content')
    @livewire('laboratory.index')
@endsection
