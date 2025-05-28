<form wire:submit.prevent="submit" class="pt-3">

    <div wire:loading>
        <x-spinner></x-spinner>
    </div>

    <div class="shadow p-5 mb-5 bg-body-tertiary rounded">
        <div class="col-md-5 position-relative pb-2">
            <label for="title" class="form-label uk-text-bold">Titulo <span style="color:red;">*</span></label>
            <input wire:model.defer="discipline.title" type="text" class="form-control" id="title" required>
            <div class="text-danger">
                {{ $errors->first('discipline.title') }}
            </div>
        </div>

        <div class="col-md-2 position-relative pb-2">
            <label for="students" class="form-label uk-text-bold">Estudante por disciplina <span style="color:red;">*</span></label>
            <input wire:model.defer="discipline.students" type="number" class="form-control" id="students" required>
            <div class="text-danger">
                {{ $errors->first('discipline.students') }}
            </div>
        </div>

        <div class="col-md-5 position-relative pb-2">
            <label class="form-label uk-text-bold">Softwares utilizados <span style="color:red;">*</span></label>

            @foreach($softwares as $software)
                <div class="form-check form-switch">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        role="switch"
                        id="software_{{ $software->id }}"
                        wire:model="selectedSoftwares"
                        value="{{ $software->id }}"
                    >
                    <label class="form-check-label" for="software_{{ $software->id }}">
                        {{ $software->title }}
                    </label>
                </div>
            @endforeach

            <div class="text-danger">
                {{ $errors->first('selectedSoftwares') }}
            </div>
        </div>

        <div class="form-group pt-2">
            <button class="btn btn-primary" type="submit">
                Salvar
            </button>
            <a href="{{ route('einstein.discipline.index') }}" class="btn btn-secondary">
                Cancelar
            </a>
        </div>
    </div>

</form>
