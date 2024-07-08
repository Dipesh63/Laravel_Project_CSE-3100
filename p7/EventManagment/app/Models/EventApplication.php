<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventApplication extends Model
{
    use HasFactory;
    protected $table = 'eventapplications';
    protected $fillable = [
        'event_id', 
        'organizer_user_id', 
        'admitted_user_id', 
        'applied_date'
    ];



    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
    // Define the relationship to User




    // public function admittedUser()
    // {
    //     return $this->belongsTo(User::class, 'admitted_user_id');
    // }
    public function admittedUser()
    {
        return $this->belongsTo(User::class);
    }
   
}
