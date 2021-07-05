<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $table = "classbk";
    protected $fillable = ["name", "idMajor", "idCourse", "disable"];
    public $timestamps = false;
}
