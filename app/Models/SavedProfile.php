<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedProfile extends Model
{
    use HasFactory;

    protected $table = 'saved_profiles';

    protected $fillable = [
        'user_id',
        'manufacturer_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(User::class, 'manufacturer_id');
    }
}
