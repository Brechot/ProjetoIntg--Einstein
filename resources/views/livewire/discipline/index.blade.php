
<div>
    <div wire:loading>
        <x-spinner></x-spinner>
    </div>
    <div class="shadow table-responsive p-5 mb-5 bg-emphasis rounded">
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
                    <td class="text-center">
                        @if($discipline->status)
                            <input class="form-check-input" type="checkbox" value="" id="checkCheckedDisabled" checked disabled>
                        @else
                            <input class="form-check-input" type="checkbox" value="" id="checkDisabled" disabled>
                        @endif
                    </td>
                    <td class="text-center">
                        <div>
                            @if (auth()->user()->hasAnyRole(['admin', 'ti']))
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
                Criar Regra
            </a>
            <a href="{{ route('einstein.home') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>
    </div>

</div>
