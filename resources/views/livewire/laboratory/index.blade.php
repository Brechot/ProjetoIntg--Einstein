
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
                Num Computadores
            </th>
            <th scope="col">
                Softwares Disponíveis
            </th>
            <th scope="col">
                Status
            </th>
            <th scope="col">
                Ações
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($laboratorys as $laboratory)
            <tr>
                <td class="uk-text-bold ps-2">
                    {{ $laboratory->id }}
                </td>
                <td class="ps-2">
                    {{ $laboratory->title }}
                </td>
                <td class="ps-2">
                    {{ $laboratory->num_computers }}
                </td>
                <td class="ps-2">
                    @if($laboratory->softwares->isNotEmpty())
                        @foreach($laboratory->softwares as $software)
                            <span class="badge bg-secondary">{{ $software->title }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">Nenhum</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($laboratory->status)
                        <input class="form-check-input" type="checkbox" value="" id="checkCheckedDisabled" checked disabled>
                    @else
                        <input class="form-check-input" type="checkbox" value="" id="checkDisabled" disabled>
                    @endif
                </td>
                <td class="text-center">
                    <div>
                        @if (auth()->user()->hasAnyRole(['admin', 'diretor','ti']))
                            <a class="btn btn-success btn-sm" href="{{ route('einstein.laboratory.edit', $laboratory) }}">
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
            @if (auth()->user()->hasAnyRole(['admin', 'diretor']))
            <a class="btn btn-primary" type="submit" href="{{route("einstein.laboratory.create")}}">
                Criar Laboratório
            </a>
            @endif
            <a href="{{ route('einstein.home') }}" class="btn btn-secondary">
                Voltar
            </a>
        </div>
    </div>

</div>
