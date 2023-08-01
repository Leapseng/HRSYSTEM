<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
        'department_id',
        'title'
    ]
    ;

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public static function getJobTitle($jobId)
    {
        // Retrieve the faculty based on the ID
        $job = self::find($jobId);
        
        // Return the title of the faculty if found, or null otherwise
        return $job ? $job->title : null;
    }
}
