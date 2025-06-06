@component('mail::message')

<h2>Caro Diretor,</h2><br>

O Coordenador {{$reserve->user->name}} solicitou o agendamento do(a) <b>{{$reserve->laboratory->title}} para a aula de {{$reserve->discipline->title}}</b>

Acesse abaixo para verificar.

@component('mail::button', ['url' =>  'http://maq121.pieinstein.test/einstein/approve'])
{{ 'MyLab' }}
@endcomponent

@endcomponent
