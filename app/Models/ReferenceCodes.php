<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceCodes extends Model
{
    use HasFactory;
    protected $table = 'reference_codes';
    protected $fillable = [
        'code',
        'description',
    ];

    // Define the inverse relationship with User
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
