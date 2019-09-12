<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $table = 'jobs';

    protected $fillable = [
        'user_id', 'job_type_id', 'job_name', 'salary', 'max_salary', 'requirements', 'contacts'
    ];


    public function user()
    {

        return $this->belongsTo(User::class, 'user_id');
    }


    public function jobType()
    {

        return $this->belongsTo(JobType::class, 'job_type_id');
    }
}
