<?php

namespace App\Models;

use App\Models\Option;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Kyslik\ColumnSortable\Sortable;

class Poll extends Model
{
    use HasFactory, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'cover',
        'user_id',
    ];

    public $sortable = ['title'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }
}