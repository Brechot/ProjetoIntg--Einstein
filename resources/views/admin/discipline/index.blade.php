@extends('layouts.app')

<div class="container pt-5 ps-3">
    <span class="navbar-brand col">
        <h1>DISCIPLINAS</h1>
    </span>
    <div class="linha-abaixo ps-3"></div>
</div>

@section('content')
    @livewire('discipline.index')
@endsection
