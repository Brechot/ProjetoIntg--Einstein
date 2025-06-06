@component('mail::message')

<h2>Caro Coordenador,</h2><br>

A reserva do <b>{{$approve->laboratory->title}}</b> foi {{$acp_dec}} pelo Diretor<br><br>

@if($approve->declined_desc != 'aceito')Motivo: {{$approve->declined_desc}}<br><br>@endif

Acesse abaixo para verificar.

@component('mail::button', ['url' => 'http://maq121.pieinstein.test/einstein/reserve'])
{{ 'MyLab' }}
@endcomponent

@endcomponent
