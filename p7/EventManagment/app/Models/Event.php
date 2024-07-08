<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Event extends Model
// {
//     use HasFactory;
// }



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'category_id', 'dept_type_id', 'location_id', 'vacancy', 'registrationfees', 
        'description', 'benefits', 'responsibility', 'qualifications', 'keywords', 'duration', 
        'club_name', 'club_location', 'club_website'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function depttype()
    {
        return $this->belongsTo(Depttype::class, 'dept_type_id');
    }
    // public function deptType()
    // {
    //     return $this->belongsTo(Depttype::class, 'dept_type_id');
    // }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }







    public function applications()
    {
        return $this->hasMany(EventApplication::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
