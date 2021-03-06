<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Universe extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Universe owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Series belonging to this universe.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function series()
    {
        return $this->hasMany(Series::class);
    }
}
