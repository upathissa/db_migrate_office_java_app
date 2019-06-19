<?php

namespace App\Model;

use App\Model\DonationRecord;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $table = 'months';
    //relationship
    public function donationRecord()
    {
        return $this->belongsTo(DonationRecord::class, 'Year_idYear', 'idMonths');
    }
}
