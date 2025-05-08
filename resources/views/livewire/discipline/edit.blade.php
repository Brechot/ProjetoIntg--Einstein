<form wire:submit.prevent="submit" class="pt-3">

    <div wire:loading>
        <x-spinner></x-spinner>
    </div>

    <div class="col-md-4 position-relative">
        <label for="title" class="form-label">Titulo <span style="color:red;">*</span></label>
        <input wire:model.defer="discipline.title" type="text" class="form-control" id="title" required>
        <div class="text-danger">
            {{ $errors->first('discipline.title') }}
        </div>
    </div>

    <div class="col-md-4 position-relative">
        <label for="students" class="form-label">Estudante por disciplina <span style="color:red;">*</span></label>
        <input wire:model.defer="discipline.students" type="number" class="form-control" id="students" required>
        <div class="text-danger">
            {{ $errors->first('discipline.students') }}
        </div>
    </div>

    <div class="mb-3 form-check">
        <input type="checkbox" wire:model.defer="discipline.status" class="form-check-input" id="status" name="status">
        <label class="form-check-label" for="exampleCheck1">Ativo</label>
    </div>

    <div class="form-group pt-5">
        <button class="btn btn-primary" type="submit">
            Salvar
        </button>
        <a href="{{ route('einstein.discipline.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </div>

</form>
