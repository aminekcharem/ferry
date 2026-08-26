<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CtnReservationStatusNote extends Model
{
    protected $fillable = [
        'ctn_reservation_message_id',
        'user_id',
        'from_status',
        'to_status',
        'note',
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(CtnReservationMessage::class, 'ctn_reservation_message_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
