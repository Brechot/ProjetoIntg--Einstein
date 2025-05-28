<form wire:submit.prevent="submit" class="pt-3 needs-validation">

    <div wire:loading>
        <x-spinner></x-spinner>
    </div>

    <div class="shadow p-5 mb-5 bg-body-tertiary rounded">
        <div class="col-md-5 position-relative pb-2">
            <label for="name" class="form-label uk-text-bold">Nome <span style="color:red;">*</span> </label>
            <input wire:model.defer="user.name" type="text" class="form-control" id="name" name="name" required>
            <div class="text-danger">
                {{ $errors->first('role.name') }}
            </div>
        </div>

        <div class="col-md-7 position-relative pb-2">
            <label for="email" class="form-label uk-text-bold">E-mail <span style="color:red;">*</span></label>
            <input wire:model.defer="user.email" type="email" class="form-control" id="email" name="email" required>
            <div class="text-danger">
                {{ $errors->first('user.email') }}
            </div>
        </div>

        <div class="col-md-4 position-relative pb-2">
            <label class="form-label uk-text-bold" for="role_id"> Grupo de Regras <span style="color:red;">*</span> </label>
            <select class="form-select" required id="role_id" name="role_id" wire:model.defer="user.role_id">
                <option value="">Selecionar Regra</option>
                @foreach($this->roles as $key => $role)
                    <option value="{{$key+1}}">{{$role->title}}</option>
                @endforeach
            </select>
            <div class="text-danger">
                {{ $errors->first('user.role_id') }}
            </div>
        </div>

        <div class="col-md-5 position-relative pb-2">
            <label for="password" class="form-label uk-text-bold">Senha <span style="color:red;">*</span></label>
            <input type="password" class="form-control" id="password" name="password" wire:model.defer="password" required>
            <div class="text-danger">
                {{ $errors->first('password') }}
            </div>
        </div>

        <div class="mb-3 form-group">
            <input type="checkbox" wire:model.defer="user.reset_psw" class="form-check-input" id="reset_psw" name="reset_psw">
            <label class="form-check-label uk-text-bold" for="reset_psw">Redefinir senha após primeiro login</label>
        </div>

        <div class="mb-3 form-check pb-2">
            <input type="checkbox" wire:model.defer="user.status" class="form-check-input" id="status" name="status">
            <label class="form-check-label uk-text-bold" for="exampleCheck1">Ativo</label>
        </div>

    {{--    @dd($errors)--}}

        <div class="form-group pt-2">
            <button class="btn btn-primary" type="submit">
                Salvar
            </button>
            <a href="{{ route('einstein.users.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>
    </div>

</form>
