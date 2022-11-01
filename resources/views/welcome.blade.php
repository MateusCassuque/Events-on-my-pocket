@extends('layouts.main')

@section('title', 'G-Apupo')

@section('content')

    <div id="search-container" class="col-md-12">

        <h1>Busque um Evento</h1>
        <form action="/" method="get">
            <input type="search" name="search" id="search" class="form-control" placeholder="Procurar">
        </form>
    </div>
    <div id="events-container">
        @if($busca)
            <h2>Buscando por: {{$busca}} </h2>
        @else
            <h2>Próximos Eventos</h2>
            <p class="subtitulo">Veja os eventos dos próximos dias</p>
        @endif
       <div id="cards-container" class="row">
            @foreach($events as $event )
                <div class="card col-md-3">
                                        
                    <!-- <img src="/img/events/{{ $event->image }}" alt="{{ $event->tilte }}"> -->
                    <div class="card-body">
                        <div id="cardFotoTitle" style="background-image: url('../img/events/{{ $event->image }}');">
                            <h5 id="by"> <small>By:</small> {{ $event->user }} </h5>
                            
                            <a href="/Events/{{ $event->id }}">
                                <div id="fundo">
                                    <div class="card-subtitle"> {{ $event->city }} </div>
                                    <p class="card-date">{{ date('d/M/Y', strtotime($event->data)) }}</p>
                                    
                                    <h5 class="card-title"> {{$event->title}} </h5>
                                </div>
                            </a>
                            
                        </div>

                        @if((count($event->users) <= 1))
                            <p class="card-participantes mx-4"><ion-icon name="people-outline"></ion-icon>Confirmado: {{ count($event->users) }} participante</p>
                        @else
                            <p class="card-participantes mx-4"><ion-icon name="people-outline"></ion-icon>Confirmado: {{ count($event->users) }} participantes</p>
                        @endif

                        
                        <form action="/Events/join/{{ $event->id }}" method="POST">
                            @csrf
                            <div class="card-actions mx-4">
                                <a href="/Events/join/{{ $event->id }}"
                                    class="btn btn-dark"
                                    id="event-submit"
                                    onclick = "event.preventDefault();
                                    this.closest('form').submit();">

                                    <ion-icon class="icone-btn" src = "../fontes/Icones/ionicons/ios-person-add.svg">
                                    </ion-icon>

                                    Confirmar Presença
                                </a>

                                <a href="/Events/{{ $event->id }}" class="btn btn-primary mx-4">Saber mais</a>
                            </div>
                            </form>    


                    </div>

                    <div class="card-footer">

                        <p class="text-muted">{{ date('d/M/Y h:00', strtotime($event->created_at)) }}</p>
                        
                    </div>
                </div>
            @endforeach

            @if(count($events) == 0 && $busca)
                <p class="subtitulo">Não foi póssivel encontrar nenho evento com {{$busca}}! <a href="/">Ver todos</a></p>
            @elseif(count($events) == 0)
                <p class="subtitulo">Não há nenho Evento disponivél</p>
            @endif
        </div>
    </div>

@endsection
