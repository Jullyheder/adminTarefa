<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_desc',
        'priority_id'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_desc' => 'string',
        'priority_id' => 'int'
    ];

    public function priority(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(Task::class);
    }
}
