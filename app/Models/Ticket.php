<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'type', 'creator_id', 'resolver_id'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolver_id');
    }

    public function isResolved()
    {
        return $this->resolver_id && $this->resolved_at;
    }
}
