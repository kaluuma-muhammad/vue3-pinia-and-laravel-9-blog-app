<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IdGenerator;

class UserLocation extends Model
{
    use HasFactory, IdGenerator;
}
