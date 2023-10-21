<?php

namespace App\Models\Game;

use App\Enums\Time;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Game\Meeting
 *
 * @property bool $solo
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name
 * @property string $time
 * @method static Builder|Meeting newModelQuery()
 * @method static Builder|Meeting newQuery()
 * @method static Builder|Meeting query()
 * @method static Builder|Meeting whereCreatedAt($value)
 * @method static Builder|Meeting whereId($value)
 * @method static Builder|Meeting whereName($value)
 * @method static Builder|Meeting whereSolo($value)
 * @method static Builder|Meeting whereTime($value)
 * @method static Builder|Meeting whereUpdatedAt($value)
 * @property-read Collection<int, Role> $roles
 * @property-read int|null $roles_count
 * @mixin Eloquent
 */
class Meeting extends Model
{
    protected $fillable = [
        'name',
        'time',
        'solo',
    ];

    protected $casts = [
        'time' => Time::class,
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
