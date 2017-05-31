<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoundarySegment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'boundary_segments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'segment_no',
        'distance',
        'from_side',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'beacon_id'         => 'int',
        'boundary_point_id' => 'int',
        'segment_no'        => 'int',
        'distance'          => 'float',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function beacon()
    {
        return $this->belongsTo(Beacon::class, 'beacon_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function boundaryPoint()
    {
        return $this->belongsTo(BoundaryPoint::class, 'boundary_point_id');
    }
}
