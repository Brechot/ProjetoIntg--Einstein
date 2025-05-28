@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js" integrity="sha512-+ruHlyki4CepPr07VklkX/KM5NXdD16K1xVwSva5VqOVbsotyCQVKEwdQ1tAeo3UkHCXfSMtKU/mZpKjYqkxZA==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/main.min.js" integrity="sha256-rPPF6R+AH/Gilj2aC00ZAuB2EKmnEjXlEWx5MkAp7bw=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.5.1/locales-all.min.js" integrity="sha256-/ZgxvDj3QtyBZNLbfJaHdwbHF8R6OW82+5MT5yBsH9g=" crossorigin="anonymous"></script>
    <script>

        Livewire.on('confirm', e => {
            if (!confirm("{{ trans('global.areYouSure') }}")) {
                return
            }
        @this[e.callback](...e.argv)
        })

        document.addEventListener('livewire:load', function() {
            let Calendar = FullCalendar.Calendar;
            let calendarEl = document.getElementById('calendar');

            let calendar = new Calendar(calendarEl, {
                initialView:'timeGridWeek',
                views: {
                    timeGridWeek: {
                        allDaySlot: false,
                        slotMinTime: "07:00:00",
                        slotMaxTime: "23:00:00",
                    },
                },
                height: "auto",
                locale: 'pt-br',

                headerToolbar: {
                    right: 'today prev,next',
                },

                editable: false, // impede arrastar
                eventStartEditable: false, // impede mudar início
                eventDurationEditable: false, // impede redimensionar

                // loading: function(isLoading) {
                //     if (!isLoading) {
                //         this.getEvents().forEach(function(e){
                //             if (e.source === null) {
                //                 e.remove();
                //             }
                //         });
                //     }
                // },

                events: function(fetchInfo, successCallback, failureCallback) {
                @this.call('getEvents', fetchInfo.startStr, fetchInfo.endStr)
                    .then(events => {
                        successCallback(events);
                    })
                    .catch(() => {
                        failureCallback();
                    });
                },

                eventDidMount: function(info) {
                    const status = info.event.extendedProps.status;

                    if (status === 1) {
                        info.el.style.backgroundColor = '#dc3545';
                        info.el.style.borderColor = '#dc3545';
                    } else if (status === 2) {
                        info.el.style.backgroundColor = '#009688';
                        info.el.style.borderColor = '#009688';
                    }
                },

                // public function getEvents($start, $end)
                // {
                //     return Reserve::whereBetween('start', [$start, $end])
                // ->where('laboratory_id', $this->laboratory->id)
                // ->get()
                // ->map(function ($reserve) {
                //     return [
                //         'id' => $reserve->id,
                //         'title' => $reserve->title ?? 'Reserva',
                //         'start' => $reserve->start,
                //         'end' => $reserve->end,
                //         'status' => $reserve->status,
                //     // Aqui você pode colocar mais informações, como cores personalizadas
                // ];
                // });
                // }

                eventClick: function (info) {
                    const currentUserId = {{ auth()->id() }};

                    @if (auth()->user()->hasAnyRole(['admin', 'diretor','coordenador']))
                        window.location.href = '/einstein/reserve/' + info.event.id + '/edit';
                    @endif
                }
            });

            calendar.render();

        @this.on('refreshCalendar', function(){
            calendar.refetchEvents()
        });
        });
    </script>
@endpush
