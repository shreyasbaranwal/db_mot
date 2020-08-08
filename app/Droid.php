<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MOT;
use App\User;

class Droid extends Model
{
    //
    protected $primaryKey = 'droid_uid';
    const CREATED_AT = 'date_added';
    const UPDATED_AT = 'last_updated';

    protected $fillable = [
      'name', 'style'
    ];

    public function users()
    {
      return $this->belongsToMany(User::class, 'droid_members', 'droid_uid', 'member_uid');
    }

    public function mot()
    {
        return $this->hasMany(MOT::class, 'droid_uid');
    }

    public function motDate()
    {
        $mot_date = $this->mot()->latest('date')->first()->date;
        return $mot_date;
    }

    public function hasMOT()
    {
        $valid = false;
        foreach($this->mot as $mot)
        {
            if((strtotime($mot->date) > strtotime('-1 year')))
                $valid = true;
        }
        return $valid;
    }

    public function hasFullMOT()
    {
        $valid = false;
        foreach($this->mot as $mot)
        {
            if((strtotime($mot->date) > strtotime('-1 year')) && ($mot->approved = "Yes"))
                $valid = true;
        }
        return $valid;
    }

    public function hasAdvisoryMOT()
    {
        $valid = false;
        foreach($this->mot as $mot)
        {
            if((strtotime($mot->date) > strtotime('-1 year')) && ($mot->approved = "Advisory"))
                $valid = true;
        }
        return $valid;
    }

    public function hasWIPMOT()
    {
        $valid = false;
        foreach($this->mot as $mot)
        {
            if((strtotime($mot->date) > strtotime('-1 year')) && ($mot->approved = "WIP"))
                $valid = true;
        }
        return $valid;
    }

    public function hasExpiringMOT()
    {
        $expiring = false;
        foreach($this->mot as $mot)
        {
            if((strtotime($mot->date) < strtotime('-11 months')) && (strtotime($mot->date) > strtotime('-1 year')) && ($mot->approved = "WIP"))
                $expiring = true;
        }
        return $expiring;
    }

    public function getImageAttribute()
    {
        return $this->path;
    }
}
