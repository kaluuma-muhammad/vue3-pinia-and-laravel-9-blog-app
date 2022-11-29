<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait idgenerator
{
    public static function boot()
    {
        parent::boot();

        static::creating(function($table)
        {
            $table->id =  uniqid();
        });

        static::deleting(function($table) { 
           $table->ondeletemodel($table);
        });

    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }



}


