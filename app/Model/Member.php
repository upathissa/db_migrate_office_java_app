<?php

namespace App\Model;

use App\Model\Address;
use App\Model\PhoneNums;
use App\Model\Subscription;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'user';
  

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'User_idUser','idUser');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'User_idUser', 'idUser');
    }

    public function email()
    {
        return $this->hasOne(Email::class, 'User_idUser','idUser');
    }

    public function phoneNumbers()
    {
        return $this->hasOne(PhoneNums::class, 'User_idUser','idUser');
    }
}
