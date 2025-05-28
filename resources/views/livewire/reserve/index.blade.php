<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <p class="card-text">
                    <div class="d-flex justify-content-between">
                        <div class="uk-text-bold fs-3">
                            Entre no laboratório para visualizar suas reservas!
                        </div>
                        <div>
                            @if (auth()->user()->hasAnyRole(['admin', 'coordenador']))
                                <a class="text-end btn btn-primary" href="{{route('einstein.reserve.approve')}}">
                                    Aprovações <i class="fa-solid fa-thumbs-up"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @foreach($laboratorys as $laboratory)
        <div class="col-md-4 mb-4 mt-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body d-flex flex-column">
                    <h4 class="card-title">{{ $laboratory->title }}</h4>
                    <div class="linha-abaixo" style="border-top: 2px solid white"></div>
                    <div>Capacidade de Alunos: {{ $laboratory->num_computers * 2 }}</div>
                    <div>Softwares Instalados:</div>
                    <ul class="list-unstyled ps-3">
                        @forelse($laboratory->softwares as $software)
                            <li>• {{ $software->title }}</li>
                        @empty
                            <li class="text-muted">Nenhum software cadastrado.</li>
                        @endforelse
                    </ul>
                    <div class="mt-auto text-center">
                        <a href="{{ route('einstein.reserve.create', $laboratory->id) }}" class="btn btn-light">
                            <i class="fa-solid fa-eye"></i>
                            <span>VISUALIZAR RESERVAS</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
