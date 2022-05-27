<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Election extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function votedBy(User $user)
    {
       return $this->likes->contains('user_id', $user->id);
    }
}