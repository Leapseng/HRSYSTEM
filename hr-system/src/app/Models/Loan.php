<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = [
        'user_id',
        'loan_amount',
        'reason',
        'file',
        'status',
    ];

    // Define the relationship between Loan and User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
