<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'job_offers';

    protected $fillable = ['position', 'category', 'place', 'company', 'type'];
}
