<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    //Criando um controller que retorna uma view
    public function index(){

        $busca = request('search');

        if ($busca) {
            # Verificando se foi feito uma busca no input search

            $events = Event::where([
                #Usando o metódo where do Modell 'Event' para fazer uma busca no banco
                ['title', 'like', '%'.$busca.'%']
            ])->get();

            foreach ($events as $event) {
                # code...
                $event->user = $event->user();
            }
        }else {
            # Traga todos os elementos caso não haja uma busca
            $events = Event::all(); 

            foreach ($events as $event) {
                # code...
                $event->user = $event->user->name;
            }
        }

        return view('welcome',['events' => $events, 'busca' => $busca]);
    }

    public function create(){
        return view('Events.create');
    }

    public function store(Request $request){
        $event = new Event;

        $event->title = $request->title;
        $event->city = $request->city;
        $event->description = $request->description;
        $event->private = $request->private;
        $event->itens = $request->itens;
        $event->data = $request->data;

        //Image Upload (Mandando Imagem no banco)
        if ($request->hasfile('image') && $request->file('image')->isValid()) {
            # if que verifica se o arquivo é válido ou não

            #passando o objecto imagem para uma váriavel
            $requestImage = $request->image;

            #pegando a extansão da imagem a partir da váriavel criada acima
            $extension = $requestImage->extension();

            #CRiando um nome único para a imagem, concatenando ele com a data actual e a extensão do arquivo
             $ImageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;

             #Salvando a imagem na pasta dos arquivos do site
             $requestImage->move(public_path('/img/events'), $ImageName);

             #Mandando a imagem no banco de dados
             $event->image = $ImageName;

        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id){

        #fazendo pesquisa no banco apartir do metódo FindOrFail()
        $event = Event::findOrFail($id);

        #Verificando se o usuário já confirmou a presensa no evento ou não
        $userLogado = auth()->user();
        $hasUserJoined = false;

        if ($userLogado) {
            # lógica da verificação
            $userEvents = $userLogado->eventsAsParticipant->toArray();


            foreach ($userEvents as $userEvent) {
                # Percorrendo em todos os eventos do userEvents
                if ($userEvent['id'] == $id){
                    #Verificando se o usuário já está neste evento...
                    $hasUserJoined = true;
                }
            }
        }


        $user_id = $event->user_id;

        $user = User::where('id', $user_id)->first()->toArray();


        # Pegando as nomes dos participantes
        $nomes = "";
        $nomesNumero = 3;
        foreach($event->users as $participante){

                if (count($event->users) <= 3) {
                    $nomesNumero = count($event->users);
                }

                $nomesNumero -= 1;
                    if($nomesNumero == 1){

                        $nomes .= $participante->name . ", ";
                     }
                     elseif($nomesNumero == 0) {
                        $nomes .= $participante->name . " ";
                    }
        } #Até aqui

        return view('Events.show', [
            'event' => $event,
            'user' => $user,
            'hasUserJoined' => $hasUserJoined,
            'nomes' => $nomes
        ]);
    }

    public function dashboard(){
        $user = auth()->user();

        $events = $user->events;

        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('dashboard', [
            'events' => $events,
            'eventsAsParticipant' => $eventsAsParticipant,
            'user' => $user
        ]);

    }

    public function destroy($id){
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento Excluido com sucesso!');
    }

    public function edit($id){
        $user = auth()->user();

        $event = Event::findOrFail($id);

        if ($user->id != $event->user_id) {
            # Verificando se o usuário autenticado é o dono evento q quer editar
            return redirect('/dashboard');
        }

        return view('Events.edit', ['event' => $event]);
    }
    public function update(Request $request){

        $data = $request->all();

        //Image Upload (Mandando Imagem no banco)
        if ($request->hasfile('image') && $request->file('image')->isValid()) {
            # if que verifica se o arquivo é válido ou não

            #passando o objecto imagem para uma váriavel
            $requestImage = $request->image;

            #pegando a extansão da imagem a partir da váriavel criada acima
            $extension = $requestImage->extension();

            #CRiando um nome único para a imagem, concatenando ele com a data actual e a extensão do arquivo
             $ImageName = md5($requestImage->getClientOriginalName() . strtotime('now')) . '.' . $extension;

             #Salvando a imagem na pasta dos arquivos do site
             $requestImage->move(public_path('/img/events'), $ImageName);

             #Mandando a imagem no banco de dados
             $data['image'] = $ImageName;

        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento Actualizado com sucesso!');
    }

    public function joinEvent($id){
        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/Events/'. $event->id)->with('msg', 'Sua presença está confirmada no Evento: ' . $event->title);
    }

    public function leaveEvent($id){

        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Você saio com sucesso do Evento: ' . $event->title . 'com sucesso');    }
}

