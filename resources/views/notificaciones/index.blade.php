@extends('layouts.app')

@section('navegacion')
    @include('ui.adminnav')
@endsection

@section('content')
    <h1 class="text-2xl text-center my-10">Notificaciones</h1>

    @if (count($notificaciones) > 0)
        <ul class="max-w-md mx-auto mt-10">
            @foreach ($notificaciones as $notificacion)
                <li class="p-4 border border-gray-400 mb-5">
                    <p class="mb-5">Tienes un nuevo candidato en:
                        <span class="font-bold"> {{ $notificacion->data['vacante'] }}</span>
                    </p>

                    <p class="mb-5">Te escribio:
                        <span class="font-bold"> {{ $notificacion->created_at->diffForHumans() }}</span>
                    </p>

                    <a href="{{ route('candidatos.index', $notificacion->data['id']) }}"
                        class="bg-teal-500 p-3 inline-block text-xs font-bold uppercase text-white">
                        Ver Candidatos
                    </a>
                </li>

            @endforeach
        </ul>

    @else
        <p class="text-center mt-5">No hay Notificaciones</p>
    @endif
@endsection
