@extends('layouts.app')

@section('content')
    <div style="min-height: 100vh; background-color: #d3d3d3;">
        <div class="container">
            <div class="navbar-brand col" style="margin-top: 10px">
                <h1 style="margin-left: 0px;">BEM-VINDO!</h1>
                <p>Este portal é de uso exclusivo dos colaboradores e parceiros da MyLab</p>
            </div>
            <div class="linha-abaixo"></div>

        </div>
        <div class="container py-4">
            <br><br>
            <h3 class="mb-4 text-start">Ferramentas de Gestão</h3>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 g-4 justify-content-center">
                @if (auth()->user()->hasAnyRole(['admin', 'diretor']))
                    <div class="col">
                        <a href="{{route("einstein.users.index")}}" class="text-decoration-none">
                            <div class="card card-home text-center h-100">
                                <div class="card-body-home" style="padding-top: 15px">
                                    <i class="fa-solid fa-user fa-2x mb-3"></i>
                                    <h5 class="card-title">Usuários</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if (auth()->user()->hasAnyRole(['admin', 'diretor']))
                    <div class="col">
                        <a href="{{route("einstein.roles.index")}}" class="text-decoration-none">
                            <div class="card card-home text-center h-100">
                                <div class="card-body-home" style="padding-top: 15px">
                                    <i class="fa-solid fa-pen-to-square fa-2x mb-3"></i>
                                    <h5 class="card-title">Regras</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if (auth()->user()->hasAnyRole(['admin', 'diretor', 'ti']))
                    <div class="col">
                        <a href="{{route("einstein.laboratory.index")}}" class="text-decoration-none">
                            <div class="card card-home text-center h-100">
                                <div class="card-body-home" style="padding-top: 15px">
                                    <i class="fa-solid fa-flask fa-2x mb-3"></i>
                                    <h5 class="card-title">Laboratórios</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if (auth()->user()->hasAnyRole(['admin', 'coordenador']))
                    <div class="col">
                        <a href="{{route("einstein.discipline.index")}}" class="text-decoration-none">
                            <div class="card card-home text-center h-100">
                                <div class="card-body-home" style="padding-top: 15px">
                                    <i class="fa-solid fa-book fa-2x mb-3"></i>
                                    <h5 class="card-title">Disciplinas</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if (auth()->user()->hasAnyRole(['admin', 'ti']))
                    <div class="col">
                        <a href="{{route("einstein.software.index")}}" class="text-decoration-none">
                            <div class="card card-home text-center h-100">
                                <div class="card-body-home" style="padding-top: 15px">
                                    <i class="fa-solid fa-desktop fa-2x mb-3"></i>
                                    <h5 class="card-title">Softwares</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if (auth()->user()->hasAnyRole(['admin', 'coordenador','diretor','ti','professor']))
                    <div class="col">
                        <a href="{{route("einstein.reserve.index")}}" class="text-decoration-none">
                            <div class="card card-home text-center h-100">
                                <div class="card-body-home" style="padding-top: 15px">
                                    <i class="fa-solid fa-pen fa-2x mb-3"></i>
                                    <h5 class="card-title">Reservas</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
