<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\IncidentStatus
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentStatus whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncidentStatus whereUserId($value)
 * @mixin \Eloquent
 */
class IncidentStatus extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }
}
