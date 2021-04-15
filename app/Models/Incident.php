<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Incident
 *
 * @property int $id
 * @property int $status_id
 * @property int $user_id
 * @property string $incident_number
 * @property string $description
 * @property-read \App\Models\IncidentStatus|null $status
 * @method static \Illuminate\Database\Eloquent\Builder|Incident newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident query()
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereIncidentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Incident whereUserId($value)
 * @mixin \Eloquent
 */
class Incident extends Model
{
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'incident_number',
        'status_id',
        'description'
    ];

    protected $table = 'incident_definitions';

    public function status()
    {
        return $this->hasOne(IncidentStatus::class, 'id', 'status_id');
    }
}
