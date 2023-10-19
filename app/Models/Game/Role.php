<?php

namespace App\Models\Game;

use App\Enums\Alignment;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Game\Role
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property Alignment $alignment
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereAlignment($value)
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @property-read Collection<int, Meeting> $meetings
 * @property-read int|null $meetings_count
 * @mixin Eloquent
 */
class Role extends Model
{
    protected $casts = [
        'alignment' => Alignment::class,
    ];

    public function meetings(): BelongsToMany
    {
        return $this->belongsToMany(Meeting::class);
    }
}
