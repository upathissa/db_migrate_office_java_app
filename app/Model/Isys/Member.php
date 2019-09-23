<?php

namespace App\Model\Isys;

use App\Model\Isys\DonationRecord;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'isys_new_members';

    public function donationRecords()
    {
        return $this->hasMany(DonationRecord::class, 'remark_id', 'remark_id');
    }
}
