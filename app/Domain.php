<?php

declare(strict_types=1);

namespace Domanamon;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'domains';

    protected $fillable = [
        'url'
    ];


    /**
     * Set up the relationship with the domains owner/user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
