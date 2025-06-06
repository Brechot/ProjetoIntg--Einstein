
<div>
    <div class="shadow table-responsive p-5 mb-5 bg-body-tertiary rounded">
        <table class="table table-sm table-striped overflow-x-scroll">
            <thead>
            <tr class="table-dark">
                <th scope="col">
                    Id
                </th>
                <th scope="col">
                    Titulo
                </th>
                <th scope="col">
                    Data Incial
                </th>
                <th scope="col">
                    Data Final
                </th>
                <th scope="col">
                    Usuário Solicitante
                </th>
                <th scope="col">
                    Laboratório
                </th>
                <th scope="col">
                    Disciplina
                </th>
                <th scope="col">
                    Ações
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($reserves as $reserve)
                <tr>
                    <td class="uk-text-bold ps-2">
                        {{ $reserve->id }}
                    </td>
                    <td class="ps-2">
                        {{ $reserve->title }}
                    </td>
                    <td class="ps-2">
                        {{ $reserve->datini }} - {{ $reserve->horini }}
                    </td>
                    <td class="ps-2">
                        {{ $reserve->datfin }} - {{ $reserve->horfin }}
                    </td>
                    <td class="ps-2">
                        {{ $reserve->user->name }}
                    </td>
                    <td class="ps-2">
                        {{ $reserve->laboratory->title }}
                    </td>
                    <td class="ps-2">
                        {{ $reserve->discipline->title }}
                    </td>
                    <td class="text-center">
                        <div>
                            @if (auth()->user()->hasAnyRole(['admin', 'diretor']))
                                <div class="flex justify-end">
                                    <button wire:click="acpt({{$reserve->id}})" class="btn btn-sm btn-primary p mr-4">
                                        <i class="far fa-check-circle" style="font-size: 20px"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger mr-4" data-bs-toggle="modal" data-bs-target="#modal-center{{$reserve->id}}" data-bs-whatever="@fat">
                                        <i class="far fa-times-circle" style="font-size: 20px"></i>
                                    </button>
{{--                                    <a  href="#modal-center{{$reserve->id}}" uk-toggle>--}}
{{--
{{--                                    </a>--}}
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="modal-center{{$reserve->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div wire:loading.delay.shortest wire:target="submit,acpt">--}}
                        <x-spinner></x-spinner>
                    </div>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form wire:submit.prevent="submit({{ $reserve->id }})">
                                <div class="modal-header">
                                    <h1 class="uk-h2">Reprovar reserva: {{$reserve->id}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group {{ $errors->has('declDescri') ? 'invalid' : '' }}">
                                        <label class="form-label required" for="declDescri">{{ 'Motivo' }}</label>
                                        <textarea class="form-control"
                                                  required
                                                  type="text"
                                                  name="declDescri"
                                                  id="declDescri"
                                                  wire:model.defer="declDescri"
                                                  rows="4"
                                                  cols="50"
                                        ></textarea>
                                        <div class="text-danger">
                                            {{ $errors->first('declDescri') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
                                    <button type="submit" class="btn btn-sm btn-danger mr-4 pt-2">Reprovar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
{{--                <div wire:ignore id="modal-center{{$reserve->id}}" class="uk-flex-top" uk-modal>--}}
{{--                    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">--}}

{{--                        <button class="uk-modal-close-default" type="button" uk-close></button>--}}

{{--                        <form wire:submit.prevent="submit({{ $reserve->id }})">--}}
{{--                            <h1 class="uk-h2">Reprovar reserva: {{$reserve->id}}</h1>--}}

{{--                            <div class="form-group {{ $errors->has('declDescri') ? 'invalid' : '' }}">--}}
{{--                                <label class="form-label required" for="declDescri">{{ 'Motivo' }}</label>--}}
{{--                                <textarea class="form-control"--}}
{{--                                          required--}}
{{--                                          type="text"--}}
{{--                                          name="declDescri"--}}
{{--                                          id="declDescri"--}}
{{--                                          wire:model.defer="declDescri"--}}
{{--                                          rows="4"--}}
{{--                                          cols="50"--}}
{{--                                ></textarea>--}}
{{--                                <div class="text-danger">--}}
{{--                                    {{ $errors->first('declDescri') }}--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <button type="submit" class="btn btn-sm btn-danger p mr-4 pt-2">Reprovar</button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
            @empty
                <tr>
                    <td>Não há Aprovações!</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div wire:loading>
        <x-spinner></x-spinner>
    </div>

</div>
