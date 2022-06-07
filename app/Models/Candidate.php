<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vote;
use App\Models\Election;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'election_id',
        'name',
        'party',
        'image',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function votedBy(User $user)
    {
       return $this->votes->contains('user_id', $user->id);
    }
}
