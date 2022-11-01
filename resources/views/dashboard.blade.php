@extends('layouts.main')

@section('title', $user->name . '/Dashboard')

@section('cssLink', '/css/dashboard.css')

@section('content')
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Eventos</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
        @if(count($events) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td scrop=row>{{ $loop->index + 1 }}</td>
                            <td><a href="/Events/{{ $event->id }}">{{ $event->title }}</a></td>
                            <td>{{ count($event->users) }}</td>
                            <td>
                                <a href="/Events/edit/{{ $event->id }}" class="btn btn-info edit-btn"><ion-icon name ="create-outline"></ion-icon>Editar</a>
                                <form action="/Events/{{ $event->id }}" method = "POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn"><ion-icon name = "trash-outline"></ion-icon>Delectar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não tem eventos, <a href="/Events/create">criar eventos</a></p>
        @endif
    </div>
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Eventos em que estou participando</h1>
    </div>
    <div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(count($eventsAsParticipant) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Participantes</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($eventsAsParticipant as $eventsAsParticipants)
                        <tr>
                            <td scrop=row>{{ $loop->index + 1 }}</td>
                            <td><a href="/Events/{{ $eventsAsParticipants->id }}">{{ $eventsAsParticipants->title }}</a></td>
                            <td>{{ count($eventsAsParticipants->users) }}</td>
                            <td>
                                <form action="/Events/leave/{{ $eventsAsParticipants->id }}" method = "POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger delete-btn">
                                        <ion-icon name = "trash-outline"></ion-icon>
                                        Sair do Evento
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Você ainda não está participando de nenho evento, <a href="/">Ver todos</a></p>
        @endif
    </div>
@endsection
