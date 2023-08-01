<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';
    protected $fillable = [
        'task_name',
        'due_date_from',
        'due_date_to',
        'description',
        'filename',
    ];
}
