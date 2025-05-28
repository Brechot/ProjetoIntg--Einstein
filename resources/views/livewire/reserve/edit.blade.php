<div class="row pt-5">
    <div class="col-12">
        <div class="row pt-2 uk-card uk-card-default uk-animation-slide-top-small p-2">
            <form wire:submit.prevent="submit" class="pt-3">

                <div class="row">
                    <div class="col-md-3 position-relative pb-2">
                        <label for="title" class="form-label uk-text-bold">Titulo <span style="color:red;">*</span></label>
                        <input wire:model.defer="reserve.title" type="text" class="form-control" id="title" value="{{old('name')}}" required>
                        <div class="text-danger">
                            {{ $errors->first('reserve.title') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label uk-text-bold" for="discipline_id"> Disciplina <span style="color:red;">*</span> </label>
                        <select class="form-select" required id="discipline_id" name="discipline_id" wire:model.defer="reserve.discipline_id">
                            <option value="">Selecionar Disciplina</option>
                            @foreach($this->discipline as $key => $discipline)
                                <option value="{{$key+1}}">{{$discipline->title}}</option>
                            @endforeach
                        </select>
                        <div class="text-danger">
                            {{ $errors->first('reserve.discipline_id') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="laboratory" class="form-label uk-text-bold">Laboratório</label>
                        <input class="form-control" type="text" placeholder="{{$this->reserve->laboratory->title}}" aria-label="Disabled input example" disabled>
                    </div>

                </div>

                <div class="row pt-3">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="datini" class="form-label uk-text-bold">Data Inicial <span style="color:red;">*</span></label>
                            <input wire:model.defer="reserve.datini" type="date" id="datini" name="datini" class="form-control" required>
                        </div>
                        <div class="text-danger">
                            {{ $errors->first('reserve.datini') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="horini" class="form-label uk-text-bold">Hora Inicial <span style="color:red;">*</span></label>
                            <input wire:model.defer="reserve.horini" type="time" id="horini" name="horini" class="form-control" min="07:00" max="23:00" required>
                        </div>
                        <div class="text-danger">
                            {{ $errors->first('reserve.horini') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="datfin" class="form-label uk-text-bold">Data Final <span style="color:red;">*</span></label>
                            <input wire:model.defer="reserve.datfin" type="date" id="datfin" name="datfin" class="form-control" required>
                        </div>
                        <div class="text-danger">
                            {{ $errors->first('reserve.datfin') }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="horfin" class="form-label uk-text-bold">Hora Final <span style="color:red;">*</span></label>
                            <input wire:model.defer="reserve.horfin" type="time" id="horfin" name="horfin" class="form-control" min="07:00" max="23:00" required>
                        </div>
                        <div class="text-danger">
                            {{ $errors->first('reserve.horfin') }}
                        </div>
                    </div>
                </div>

                <form wire:submit.prevent="submit">
                    <div class="form-group pt-3 justify-content-between">
                        <button class="btn btn-primary" type="submit">
                            Salvar
                        </button>
                        <a href="{{ route('einstein.reserve.create',$this->reserve->laboratory_id) }}" class="btn btn-secondary ps-2">
                            Cancelar
                        </a>
                        <a wire:click="cancelReservation({{$reserve->id}})" class="btn btn-danger">
                            Cancelar Reserva
                        </a>
                    </div>
                </form>

            </form>
        </div>
    </div>
    <div wire:loading>
        <x-spinner></x-spinner>
    </div>
</div>
