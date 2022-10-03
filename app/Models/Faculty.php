<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'department_id'];

    //user relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    //department relationship
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    //block relationship
    public function blocks()
    {
        return $this->hasMany(Block::class, 'user_id');
    }
}