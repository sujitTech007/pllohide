<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'role',
        'frequency',
        'challenges',
        'other_challenges',
        'sustainability_importance',
        'pllohide_offerings',
        'platform_interest',
        'preference1',
        'preference2',
        'feedback',
        'other',
        'improvements',
    ];
}
