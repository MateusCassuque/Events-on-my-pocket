<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'itens' => 'array'
    ];
    
    #para o programa entender q a variável $dates é do tipo data
    protected $dates = ['date'];

    protected $guarded = [];

    #função para fazer a relação de um para muitos
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    #função para fazer a relação de muitos para muitos
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
