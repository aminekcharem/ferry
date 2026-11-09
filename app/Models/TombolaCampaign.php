<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TombolaCampaign extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['enabled' => 'boolean', 'starts_at' => 'immutable_datetime', 'ends_at' => 'immutable_datetime'];
    }

    public function state(): string
    {
        if (! $this->enabled || ! $this->starts_at || ! $this->ends_at) {
            return 'disabled';
        }

        return now()->lt($this->starts_at) ? 'scheduled' : (now()->gte($this->ends_at) ? 'ended' : 'active');
    }

    public function participations(): HasMany
    {
        return $this->hasMany(TombolaParticipation::class);
    }

    public function resets(): HasMany
    {
        return $this->hasMany(TombolaReset::class);
    }
}
