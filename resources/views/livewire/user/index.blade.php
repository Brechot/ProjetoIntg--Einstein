
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
                    Nome
                </th>
                <th scope="col">
                    E-mail
                </th>
                <th scope="col">
                    Grupo de Regra
                </th>
                <th scope="col">
                    Status
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="uk-text-bold ps-2">
                        {{ $user->id }}
                    </td>
                    <td class="ps-2">
                        {{ $user->name }}
                    </td>
                    <td class="ps-2">
                        {{ $user->email }}
                    </td>
                    <td class="ps-2">
                        {{ $user->role->title }}
                    </td>
                    <td class="text-center">
                        @if($user->status)
                            <input class="form-check-input" type="checkbox" value="" id="checkCheckedDisabled" checked disabled>
                        @else
                            <input class="form-check-input" type="checkbox" value="" id="checkDisabled" disabled>
                        @endif
                    </td>
                    <td>
                        <div class="text-center">
                            @if (auth()->user()->hasAnyRole(['admin', 'diretor']))
                                <a class="btn btn-success btn-sm" href="{{ route('einstein.users.edit', $user) }}">
                                    Editar
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td>Nada foi cadastrado</td>
                </tr>
            @endforelse
            </tbody>
        </table>


        <div class="form-group pt-2">
            <a class="btn btn-primary" type="submit" href="{{route("einstein.users.create")}}">
                Criar Usuário
            </a>
            <a href="{{ route('einstein.home') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>
    </div>

</div>
