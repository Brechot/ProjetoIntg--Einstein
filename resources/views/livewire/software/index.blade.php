
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
                Status
            </th>
            <th scope="col">
                Ações
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($softwares as $software)
            <tr>
                <td class="uk-text-bold ps-2">
                    {{ $software->id }}
                </td>
                <td class="ps-2">
                    {{ $software->title }}
                </td>
                <td class="text-center">
                    @if($software->status)
                        <input class="form-check-input" type="checkbox" value="" id="checkCheckedDisabled" checked disabled>
                    @else
                        <input class="form-check-input" type="checkbox" value="" id="checkDisabled" disabled>
                    @endif
                </td>
                <td class="text-center">
                    <div>
                        @if (auth()->user()->hasAnyRole(['admin', 'ti']))
                            <a class="btn btn-success btn-sm" href="{{ route('einstein.software.edit', $software) }}">
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
        <a class="btn btn-primary" type="submit" href="{{route("einstein.software.create")}}">
            Criar Software
        </a>
        <a href="{{ route('einstein.home') }}" class="btn btn-secondary">
            Voltar
        </a>
    </div>

</div>
