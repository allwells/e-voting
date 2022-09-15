<?php

namespace App\Models;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Kyslik\ColumnSortable\Sortable;

class Election extends Model
{
    use HasFactory, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'start_date',
        'end_date',
    ];

    public $sortable = ['title', 'type', 'start_date', 'end_date'];

    protected $casts = [
        'participants' => 'array'
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}