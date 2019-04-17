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
}
