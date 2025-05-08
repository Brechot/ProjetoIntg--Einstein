
<div>
    <div wire:loading>
        <x-spinner></x-spinner>
    </div>
    <table class="table">
        <thead>
        <tr>
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
                Status
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse($laboratorys as $laboratory)
            <tr>
                <td>
                    {{ $laboratory->id }}
                </td>
                <td>
                    {{ $laboratory->title }}
                </td>
                <td>
                    {{ $laboratory->num_computers }}
                </td>
                <td>
                    @if($laboratory->status)
                        <input class="form-check-input" type="checkbox" value="" id="checkCheckedDisabled" checked disabled>
                    @else
                        <input class="form-check-input" type="checkbox" value="" id="checkDisabled" disabled>
                    @endif
                </td>
                <td>
                    <div>
                        @if (auth()->user()->hasAnyRole(['admin', 'ti']))
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

    <div class="form-group pt-5">
        <a class="btn btn-primary" type="submit" href="{{route("einstein.laboratory.create")}}">
            Criar Regra
        </a>
        <a href="{{ route('einstein.home') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </div>

</div>
