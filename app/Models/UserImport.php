<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserImport extends Model
{
    protected $fillable = ["user_id", "job_id", "status", "total"];

    protected $casts = ["status" => "boolean"];

    public function add($userId, $jobId) {

        $this->user_id = $userId;
        $this->job_id = $jobId;
        $this->save();
        return $this->id;

    }
}