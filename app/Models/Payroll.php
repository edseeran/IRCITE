<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'employee_id',
        'start_date',
        'end_date',
        'salary',
        'time_in_date',
        'time_out_date',
        'mark_date',
        'type',
    ];
}
