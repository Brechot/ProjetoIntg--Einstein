<form wire:submit.prevent="submit" class="pt-3">

    <div wire:loading>
        <x-spinner></x-spinner>
    </div>

    <div class="shadow p-5 mb-5 bg-body-tertiary rounded">
        <div class="col-md-4 position-relative pb-2">
            <label for="title" class="form-label uk-text-bold">Titulo <span style="color:red;">*</span></label>
            <input wire:model.defer="role.title" type="text" class="form-control" id="title" required>
            <div class="text-danger">
                {{ $errors->first('role.title') }}
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" wire:model.defer="role.status" class="form-check-input uk-text-bold" id="status" name="status">
            <label class="form-check-label pb-2" for="exampleCheck1">Ativo</label>
        </div>


        <div class="form-group pt-2">
            <button class="btn btn-primary" type="submit">
                Salvar
            </button>
            <a href="{{ route('einstein.roles.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>
    </div>

</form>
