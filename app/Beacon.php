<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Beacon extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'beacons';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'identity',
        'buyed_at',
        'installed_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'buyed_at',
        'installed_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beacons()
    {
        return $this->hasMany(BoundarySegment::class, 'beacon_id');
    }

    /**
     * @param $value
     */
    public function setBuyedAtAttribute($value)
    {
        if (empty($value)) {
            return;
        }

        $this->attributes['buyed_at'] = Carbon::parse($value);
    }

    /**
     * @param $value
     */
    public function setInstalledAtAttribute($value)
    {
        if (empty($value)) {
            return;
        }

        $this->attributes['installed_at'] = Carbon::parse($value);
    }
}
