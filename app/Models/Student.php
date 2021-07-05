<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';
    protected $fillable = ["name", "gender", "dateBirth", "email", "phone", "address", "fee", "idClass", "idStudentShip", "disable"];
    public $timestamps = false;
    public function getGenderNameAttribute()
    {
        if ($this->gender == 1) {
            return "Nam";
        } else {
            return "Nữ";
        }
    }
}
