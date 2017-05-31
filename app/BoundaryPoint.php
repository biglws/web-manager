<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoundaryPoint extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boundary_points';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'x',
        'y'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'location_id' => 'int',
        'x'           => 'float',
        'y'           => 'float',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function boundarySegments()
    {
        return $this->hasMany(BoundarySegment::class, 'boundary_point_id');
    }
}
