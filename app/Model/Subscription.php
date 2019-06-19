<?php

namespace App\Model;

use App\Model\Member;
use App\Model\DonationRecord;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'donatedata';

    public function member()
    {
        return $this->belongsTo(Member::class, 'User_idUser', 'idUser');
    }

    public function donation_method_id($dbValue)
    {
        switch ($dbValue) {
            case 1:
                return 3;
                break;
            case 2:
                return 4;
                break;
            case 3:
                return 2;
                break;
            case 4:
                return 1;
                break;
            
            default:
                return 5;
                break;
        }
    }
    public function donation_place_name_id($temple, $bank)
    {

        if($temple){
            return $temple;
        }
        elseif ($bank) {
            // return $bank+15;
        }

    }

    // relationship
    public function donationRecords()
    {
        return $this->hasMany(DonationRecord::class, 'DonateData_idDonateData', 'idDonateData');
    }
}
