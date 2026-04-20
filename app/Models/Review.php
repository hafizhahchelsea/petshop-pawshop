<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'content',
        'rating',
        'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
