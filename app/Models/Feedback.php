<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'feedbacks';

    // Castings can't be used becuase Filament can't parse nested arrays
    // protected $casts = [
    //     'app_info' => 'array',
    //     'device_info' => 'array',
    //     'additional_info' => 'array',
    // ];
}
