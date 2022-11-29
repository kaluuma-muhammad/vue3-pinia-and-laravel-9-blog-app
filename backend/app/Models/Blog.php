<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\idgenerator;

class Blog extends Model
{
    use HasFactory, idgenerator;

    protected $guarded = [];

    public function onDeleteModel($table){
        //
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
