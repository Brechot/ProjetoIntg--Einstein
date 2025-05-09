<form wire:submit.prevent="submit" class="pt-3">

    <div wire:loading>
        <x-spinner></x-spinner>
    </div>

    <div class="shadow p-5 mb-5 bg-emphasis rounded">
        <div class="col-md-5 position-relative pb-2">
            <label for="title" class="form-label uk-text-bold">Titulo <span style="color:red;">*</span></label>
            <input wire:model.defer="software.title" type="text" class="form-control" id="title" required>
            <div class="text-danger">
                {{ $errors->first('software.title') }}
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" wire:model.defer="software.status" class="form-check-input" id="status" name="status">
            <label class="form-check-label" for="exampleCheck1">Ativo</label>
        </div>

        <div class="form-group pt-2">
            <button class="btn btn-primary" type="submit">
                Salvar
            </button>
            <a href="{{ route('einstein.software.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>
    </div>

</form>
