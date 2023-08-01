<?php

namespace App\Models;

use App\Models\Admin\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $table = 'submission';

    protected $fillable = [
        'task_id',
        'file',
    ];

    public function task() {
        return $this->belongsTo(Task::class);
    }
}
