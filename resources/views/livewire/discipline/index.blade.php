
<div>
    <div wire:loading>
        <x-spinner></x-spinner>
    </div>
    <div class="shadow table-responsive p-5 mb-5 bg-body-tertiary rounded">
        <table class="table table-sm table-striped overflow-x-scroll">
            <thead>
            <tr class="table-dark">
                <th scope="col">
                    Id
                </th>
                <th scope="col">
                    Titulo
                </th>
                <th scope="col">
                    Alunos
                </th>
                <th scope="col">
                    Softwares Vinculados
                </th>
                <th scope="col">
                    Status
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($disciplines as $discipline)
                <tr>
                    <td class="uk-text-bold ps-2">
                        {{ $discipline->id }}
                    </td>
                    <td class="ps-2">
                        {{ $discipline->title }}
                    </td>
                    <td class="ps-2">
                        {{ $discipline->students }}
                    </td>
                    <td class="ps-2">
                        @if($discipline->softwares->isNotEmpty())
                            @foreach($discipline->softwares as $software)
                                <span class="badge bg-secondary">{{ $software->title }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">Nenhum</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($discipline->status)
                            <input class="form-check-input" type="checkbox" value="" id="checkCheckedDisabled" checked disabled>
                        @else
                            <input class="form-check-input" type="checkbox" value="" id="checkDisabled" disabled>
                        @endif
                    </td>
                    <td class="text-center">
                        <div>
                            @if (auth()->user()->hasAnyRole(['admin', 'coordenador']))
                                <a class="btn btn-success btn-sm" href="{{ route('einstein.discipline.edit', $discipline) }}">
                                    Editar
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Não há cadastros!</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="form-group pt-2">
            <a class="btn btn-primary" type="submit" href="{{route("einstein.discipline.create")}}">
                Criar Disciplina
            </a>
            <a href="{{ route('einstein.home') }}" class="btn btn-secondary">
                Voltar
            </a>
        </div>
    </div>

</div>
