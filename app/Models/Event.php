<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeStartedEvents($query, $currentTime)
    {
        return $query->where('done', '=', false)->where('start_date', '=', $currentTime);
    }

    public function scopeEndedEvents($query, $currentTime)
    {
        return $query->where('done', '=', false)->where('end_date', '=', $currentTime);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
