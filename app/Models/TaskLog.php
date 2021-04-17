<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TaskLog
 *
 * @property int $id
 * @property int $user_id
 * @property int $incident_id
 * @property string $description
 * @property string $time_spent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Incident $incident
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereIncidentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereTimeSpent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TaskLog whereUserId($value)
 * @mixin \Eloquent
 */
class TaskLog extends Model
{
    use HasTimestamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'incident_id',
        'description',
        'time_spent'
    ];

    protected $table = 'task_log';

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public function incident()
    {
        return $this->belongsTo(Incident::class, 'incident_id', 'id');
    }

    public function getTime()
    {
        return sprintf("%02d", $this->time_spent / 60) . ':' . sprintf("%02d", $this->time_spent % 60);
    }

    public function getHours()
    {
        return sprintf("%02d", $this->time_spent / 60);
    }

    public function getMinutes()
    {
        return sprintf("%02d", $this->time_spent % 60);
    }
}
