<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\IdGenerator;

class UserDevice extends Model
{
    use HasFactory, IdGenerator;
}
