<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'full_name',
        'ktp_number',
        'employee_code',
        'birth_place',
        'birth_date',
        'address_ktp',
        'address_domicile',
        'phone_number',
        'email',
        'division_id',
        'cluster_id',
        'position_id',
        'status_employee',
        'join_date',
        'resign_date',
        'bank_account_number',
        'bank_name',
        'bpjs_health_number',
        'bpjs_health_join_date',
        'bpjs_tk_number',
        'bpjs_tk_join_date'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'join_date' => 'date',
        'resign_date' => 'date',
        'bpjs_health_join_date' => 'date',
        'bpjs_tk_join_date' => 'date',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function cluster()
    {
        return $this->belongsTo(Cluster::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
