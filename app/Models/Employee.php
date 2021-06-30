<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'accountant';
    public $timestamps = false;
    public function getGenderNameAttribute()
    {
        if ($this->gender == 1) {
            return "Nam";
        } else {
            return "Nữ";
        }
    }
    public function getPermissionNameAttribute()
    {
        if ($this->permission == 1) {
            return "Giáo vụ";
        } else {
            return "Kế Toán";
        }
    }
}
