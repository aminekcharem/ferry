<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TombolaParticipation extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['result' => 'integer', 'email_sent_at' => 'immutable_datetime'];
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(TombolaCampaign::class, 'tombola_campaign_id');
    }
}
