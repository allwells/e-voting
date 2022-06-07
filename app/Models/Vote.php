<?php

namespace App\Models;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'election_id',
        'candidate_id'
    ];


    // public function vote()
    // {
    //     return $this->morphTo();
    // }

    public function candidates()
    {
        return $this->belongsTo(Candidate::class, 'votes', 'candidate_id', 'election_id');
    }
}
