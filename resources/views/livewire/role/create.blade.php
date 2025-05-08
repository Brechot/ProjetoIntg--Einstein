<form wire:submit.prevent="submit" class="pt-3">

    <div wire:loading>
        <x-spinner></x-spinner>
    </div>

        <div class="col-md-4 position-relative">
            <label for="validationTooltip01" class="form-label">Titulo <span style="color:red;">*</span></label>
            <input wire:model.defer="role.title" type="text" class="form-control" id="title" required>
            <div class="text-danger">
                {{ $errors->first('role.title') }}
            </div>
        </div>

{{--        <div class="flex items-center pt-4 mb-4">--}}
{{--            <input class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-50 dark:border-gray-600"--}}
{{--                   id="status"--}}
{{--                   name="status"--}}
{{--                   type="checkbox"--}}
{{--                   wire:model.defer="helpdeskClass.status"--}}
{{--            >--}}
{{--            <label for="default-checkbox" class="form-label pl-2 pt-2.5">{{trans('cruds.helpdesk_class.fields.status')}}</label>--}}
{{--        </div>--}}


    <div class="form-group pt-5">
        <button class="btn btn-primary" type="submit">
            Salvar
        </button>
        <a href="{{ route('einstein.roles.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </div>

</form>
