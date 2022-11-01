@extends('layouts.main')

@section('title', 'Criar Eventos')
@section('cssLink', '/css/createEvent.css')

@section('content')
<div id="event-create-container" class="col-md-6 offset-md-3">
        <h1>Crie Eventos</h1>
        <form action="/Events" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="image">Imagem do Evento</label>
                <input type="file" name="image" id="image" class="from-control-file">
            </div>

            <div class="form-group">
                <label for="title">Evento:</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Nome do Evento">
            </div>

            <div class="form-group">
                <label for="data">Data do Evento:</label>
                <input type="date" name="data" id="data" class="form-control">
            </div>

            <div class="form-group">
                <label for="city">Cidade:</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="Local do Evento">
            </div>

            <div class="form-group">
                <label for="private">O Evento é privado?</label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea type="text" name="description" id="description" class="form-control" placeholder="Sobre o que é o Evento"></textarea>
            </div>

            <div class="form-group">
                <label for="itens">Adicione Itens de Infraestrutura:</label>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value = "palco"> Palco
                </div>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value = "cadeiras"> Cadeiras
                </div>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value = "cerveja-grates"> Cerveija Grates
                </div>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value = "open-food"> Open-Food
                </div>
                <div class="form-group">
                    <input type="checkbox" name="itens[]" value = "brindes"> Brindes
                </div>
            </div>


            <br>
            <input type="submit" value="Criar um Evento" class="btn btn-primary">
        </form>
    </div>
@endsection
