@extends('layouts.app')

<div class="container pt-5 ps-3">
    <span class="navbar-brand col">
        <h1> {{$laboratory->title}}</h1>
    </span>
    <div class="linha-abaixo ps-3"></div>
</div>

@section('content')
    @livewire('reserve.create', ['laboratoryId' => $laboratory->id]) <!-- o laravel nao deixar passar o objeto sem ser private ou com algum tipo declarado, então e preciso passar somente o id no component __>
@endsection
