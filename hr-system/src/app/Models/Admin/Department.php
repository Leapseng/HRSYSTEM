<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = ['name'];

    public static function getDepartmentTitle($departmentId)
    {
        // Retrieve the faculty based on the ID
        $department = self::find($departmentId);
        
        // Return the title of the faculty if found, or null otherwise
        return $department ? $department->name : null;
    }
}
