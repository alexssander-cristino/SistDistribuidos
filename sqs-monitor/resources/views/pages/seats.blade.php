@extends('layouts.app')

@section('content')
<h3>Assentos</h3>

<div class="d-flex flex-wrap">
@foreach($seats as $seat)
    <button class="seat 
        {{ $seat->status == 'livre' ? 'livre' : '' }}
        {{ $seat->status == 'reservado' ? 'reservado' : '' }}
        {{ $seat->status == 'vendido' ? 'vendido' : '' }}
    ">
        {{ $seat->numero }}
    </button>
@endforeach
</div>
@endsection