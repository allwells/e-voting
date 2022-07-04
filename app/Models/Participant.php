<?php

namespace App\Models;

use App\Models\User;
use App\Models\Election;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'user_id',
        'election_id',
    ];
}
