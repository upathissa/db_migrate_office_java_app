<?php

namespace App\Model;

use App\Model\Month;
use Illuminate\Database\Eloquent\Model;

class DonationRecord extends Model
{
    protected $table = 'year';
    
    public function months()
    {
        return $this->hasOne(Month::class, 'Year_idYear', 'idYear');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class, 'DonateData_idDonateData', 'idDonateData');
    }
}
