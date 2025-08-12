<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'employee_id',
        'bpjs_health_number',
        'bpjs_health_join_date',
        'bpjs_tk_number',
        'bpjs_tk_join_date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
