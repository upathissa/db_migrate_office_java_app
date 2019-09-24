<?php

namespace App\Http\Resources\Isys;

use App\Http\Resources\Isys\DonationRecord;
use Illuminate\Http\Resources\Json\JsonResource;

class Member extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    private $titleProcess = "";  
    public function toArray($request)
    {
        $mothsCollection = collect($this->months($this->donationRecords));
        $out = $mothsCollection->collapse();

        $donationMethod = collect([
            $this->is_asapuwa, 
            $this->is_bank, 
            $this->is_cheque, 
            $this->is_staningorder
        ]);
        return [
            'id' => $this->id,
            'name' => $this->nameSinFilter($this->name_sin),
            'title' => $this->titleProcess,
            'nic' => $this->nic !="" ? $this->nic : NULL,
            'email' => $this->email != "" ? $this->email : NULL,
            'landline' => $this->mobile_number != "" ? $this->mobile_number : NULL,
            'mobile01' => $this->tp_number != "" ? $this->tp_number: Null,
            'country' => $this->country($this->country),
            'address' => $this->addressProcess(
                $this->addr_no, $this->addr_1, $this->addr_2, $this->addr_3, $this->addr_4, $this->addr_5, $this->addr_6
            ),
            'register_date' => NULL,
            'subscription' => $this->subscriptionProcess($this->remark_id, $this->unit_amount, $donationMethod),
            'staningOrder' => $this->when($this->is_staningorder, $this->staningOrder($this->so_date, $this->so_acc_number, $this->bank)),
            'months' => $out
            
        ];
    }

    private function months($months)
    {
        return $months->count() > 0 ? DonationRecord::collection($months) : ["no data"];
    }

    private function nameSinFilter($name)
    {
        $nameMiya = explode(" මිය",$name);
        $nameMahatha = explode(" මහතා", $name);
        $nameMenaviya = explode(" මෙනවිය", $name);
        $nameMahathmiya = explode(" මහත්මිය", $name);
        
        if($this->nameHasPrefix(" මිය", $name)) {
            $this->titleProcess = "මහත්මිය";
            return $nameMiya[0];
        } elseif($this->nameHasPrefix(" මහතා", $name)){
            $this->titleProcess = "මහතා";
            return $nameMahatha[0];
        }elseif($this->nameHasPrefix(" මෙනවිය", $name)){
            $this->titleProcess = "මෙනවිය";
            return $nameMenaviya[0];
        }elseif($this->nameHasPrefix(" මහත්මිය", $name)){
            $this->titleProcess = "මහත්මිය";
            return $nameMahathmiya[0];
        }else{
            $this->titleProcess = NULL;
            return $name;
        }

    }
    private function nameHasPrefix($preffix, $name)
    {

        $preffixLessName = explode($preffix, $name);
        $hasPreffix = strlen($name) > strlen($preffixLessName[0]);
        $preffixLength = strlen($name) - strlen($preffixLessName[0]);
        if($hasPreffix){
            return true;
        }else{
            return false;
        }
    }

    private function addressProcess($addr_no, $addr_1, $addr_2, $addr_3, $addr_4, $addr_5, $addr_6)
    {
        $city = NULL;
        if(!$addr_2){
            $city = NULL;
        }elseif(!$addr_3){
            $city = "$addr_2";
        }elseif(!$addr_4){
            $city = "$addr_2, $addr_3";
        }elseif(!$addr_5){
            $city = "$addr_2, $addr_3, $addr_4";
        }elseif(!$addr_6){
            $city = "$addr_2, $addr_3, $addr_4, $addr_5";
        }elseif($addr_6){
            $city = "$addr_2, $addr_3, $addr_4, $addr_5, $addr_6";
        }
        return [
            'address01' => $addr_no,
            'address02' => $addr_1,
            'city' => $city
        ];
    }

    private function subscriptionProcess($remark_id, $unit_amount, $donationMethod)
    {
        $unitAmount = (int)$unit_amount;
        return [
            'remark_id' => $remark_id,
            'donation_method_id' => $this->donationMethod($donationMethod),
            'donation_place_name_id' => $this->donationPlaceIds($this->pay_asapuwa, $this->is_asapuwa, $this->bank, $this->is_bank),
            'donation_program_id' => 2,
            'unit_amount' => $unitAmount
        ];
    }
    private function donationPlaceIds($asapuwa,$is_asapuwa,$bank,$is_bank)
    {
        if($is_asapuwa==1){
            return $this->asapuId($asapuwa);
        }elseif($is_bank==1){
            return $this->bankId($bank);
        }
    }

    private function asapuId($asapuwa)
    {
        switch ($asapuwa) {
            case 'WD':
                return 33;
                break;
            
            case 'UD':
                return 4;
                break;
            case 'SS':
                return 12;
                break;
            case 'SP':
                return 24;
                break;
            case 'SG':
                return 25;
                break;
            case 'PL':
                return 23;
                break;
            case 'PG':
                return 3;
                break;
            case 'MT':
                return 10;
                break;
            case 'MN':
                return 26;
                break;
            case 'ML':
                return 27;
                break;
            case 'MH':
                return 5;
                break;
            case 'MG':
                return 14;
                break;
            case 'MB':
                return 7;
                break;
            case 'KW':
                return 12;
                break;
            case 'KU':
                return 9;
                break;
            case 'KT':
                return 28;
                break;
            case 'KK':
                return 22;
                break;
            case 'HR':
                return 8;
                break;
            case 'HM':
                return 2;
                break;
            case 'GN':
                return 29;
                break;
            case 'GL':
                return 30;
                break;
            case 'BW':
                return 6;
                break;
            case 'KB':
                return 31;
                break;
            case 'BS':
                return 13;
                break;
            case 'BL':
                return 16;
                break;
            case 'AD':
                return 11;
                break;
            case 'AB':
                return 34;
                break;
            case 'IB':
                return 32;
                break;
        }
    }
    private function bankId($bank)
    {
        switch ($bank) {
            case '1':
                return 17;
                break;
            case '2':
                return 18;
                break;
            case '3':
                return 19;
                break;
            case '4':
                return 21;
                break;

        }
    }

    private function donationMethod($donationMethod)
    {
        switch ($donationMethod->search(1)) {
            case '0':
                return 1;
                break;
            case '1':
                return 3;
                break;
            case '2':
                return 7;
                break;
            case '3':
                return 4;
                break;

        }
    }

    private function country($country)
    {
        switch ($country) {
            case '1':
                return 1;
                # Sri Lanka...
                break;
            case '2':
                return 3;
                # Australiya...
                break;
            case '3':
                return 10;
                # Canada...
                break;
            case '4':
                return 11;
                # Dubai...
                break;
            case '5':
                return 12;
                # Italy...
                break;
            case '6':
                return 13;
                # Germeny...
                break;
        }
    }

    private function staningOrder($so_date, $so_acc_number, $bank)
    {
        return [
            'staningOrderDate' => $so_date,
            'description' => $so_acc_number,
            'bank_id' => $this->bankId($bank)
        ];
    }

}
// donation palce 
// 1 - office
// 2 - monestrory
// 3 - bank