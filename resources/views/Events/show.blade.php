@extends('layouts.main')

@section('title', $event->title)

@section('cssLink', '/css/showEvent.css')

@section('content')

    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div id="image-container" class="col-md-6 col-11">
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-fluid">
            </div>
            <div id="info-container" class="col-md-5 col-11">
                <h1> {{ $event->title }} </h1>
                <p class="event-city m-2"><ion-icon name = "location-outline"></ion-icon>{{ $event->city }} </p>

                <p class="events-participantes m-2"> <ion-icon name="people-outline"></ion-icon>
                    @if(count($event->users) == 2 && count($event->users) > 0)
                        {{$nomes}} já estão participando deste Evento
                    @elseif(count($event->users) == 1 && count($event->users) > 0)
                        {{$nomes}} já está participando deste Evento
                    @elseif(count($event->users) == 0)
                        0 participantes, <br> click em participar do evento para ser a primeira pessoa a participar
                    @else
                        {{$nomes}} e mais {{ count($event->users) - 2 }} pessoas estão participando...
                    @endif
                </p>

                <p class="event-owner m-2">
                    <ion-icon src = "../fontes/Icones/ionicons/ios-star.svg">
                    </ion-icon>
                    <strong> Evento Criado por: {{ $user['name'] }} </strong>
                </p>

                @if(! $hasUserJoined)
                    <form action="/Events/join/{{ $event->id }}" method="POST">
                        @csrf
                        <a href="/Events/join/{{ $event->id }}"
                            class="btn btn-primary"
                            id="event-submit"
                            onclick = "event.preventDefault();
                            this.closest('form').submit();">

                            <ion-icon class="icone-btn" src = "../fontes/Icones/ionicons/ios-person-add.svg">
                            </ion-icon>

                            Confirmar Presença
                        </a>
                    </form>
                    
                @else
                    <p class="alread-joined-msg"><ion-icon src = "../fontes/Icones/ionicons/ios-person.svg"></ion-icon>Você já está participando deste evento!</p>
                
                    <form action="/Events/leave/byEventId/{{ $event->id }}" method = "POST">
                
                        @csrf
                        @method('DELETE') 
                        <button type="submit" class=" my-4 btn btn-danger">
                            <ion-icon name = "trash-outline"></ion-icon>
                            Sair do Evento
                        </button>
                    </form>
                    
                @endif

                <h3>O Evento conta com:</h3>
                <ul class="items-list">
                    @foreach($event->itens as $item)
                        <li><ion-icon name="play-outline"></ion-icon><span>{{ $item }}</span></li>
                    @endforeach
                </ul>

            </div>
            <div class="col-md-12" id="description-container">
                <h3>Sobre o Evento</h3>
                <p class="event-description">{{ $event->description }}</p>
            </div>
        </div>
    </div>

@endsection
