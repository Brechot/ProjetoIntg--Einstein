
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
                <td>
                    {{ $user->id }}
                </td>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->role->title }}
                </td>
                <td>
                    @if($user->status)
                        <input class="form-check-input" type="checkbox" value="" id="checkCheckedDisabled" checked disabled>
                    @else
                        <input class="form-check-input" type="checkbox" value="" id="checkDisabled" disabled>
                    @endif
                </td>
                <td>
                    <div>
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


    <div class="form-group pt-5">
        <a class="btn btn-primary" type="submit" href="{{route("einstein.users.create")}}">
            Criar Usuário
        </a>
        <a href="{{ route('einstein.home') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </div>

</div>
