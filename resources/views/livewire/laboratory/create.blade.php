<form wire:submit.prevent="submit" class="pt-3">

    <div wire:loading>
        <x-spinner></x-spinner>
    </div>

    <div class="shadow p-5 mb-5 bg-emphasis rounded">
        <div class="col-md-5 position-relative pb-2">
            <label for="title" class="form-label uk-text-bold">Titulo <span style="color:red;">*</span></label>
            <input wire:model.defer="laboratory.title" type="text" class="form-control" id="title" required>
            <div class="text-danger">
                {{ $errors->first('laboratory.title') }}
            </div>
        </div>

        <div class="col-md-2 position-relative pb-2">
            <label for="num_computers" class="form-label uk-text-bold">Num. de Computadores <span style="color:red;">*</span></label>
            <input wire:model.defer="laboratory.num_computers" type="number" class="form-control" id="num_computers" required>
            <div class="text-danger">
                {{ $errors->first('laboratory.num_computers') }}
            </div>
        </div>

        <div class="form-group pt-2">
            <button class="btn btn-primary" type="submit">
                Salvar
            </button>
            <a href="{{ route('einstein.laboratory.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>
    </div>

</form>
