<?php

namespace App\Http\Resources;

use App\Http\Resources\Address;
use App\Http\Resources\Subscription;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DonationRecord as DonationRecordResource;

class Member extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $mothsCollection = collect($this->months($this->subscription->donationRecords));

        $out = $mothsCollection->collapse();

        return [
            'id' => $this->idUser,
            'title' => $this->titleReturn($this->Title),
            'name' => "$this->FName $this->LName",
            'nic' => $this->NIC,
            'email' => $this->filterEmail($this->email),
            'landline' => $this->phoneNumberMobile($this->phoneNumbers),
            'mobile01' => $this->phoneNumber($this->phoneNumbers),
            'country' => $this->Country,
            'address' => new Address($this->address),
            'register_date' => $this->RegDate,
            'subscription' => new Subscription($this->subscription),
            'months' => $out,

            // 'months' => $this->months($this->subscription->donationRecords),
        ];
    }

    private function months($months)
    {
        return $months->count() > 0 ? DonationRecordResource::collection($months) : ["no data"];
    }

    private function filterEmail($email)
    {
        if($email){
            if($email->Email && $email->Email != "--"){
                return $email->Email;
            }
        }
        return null;
    }

    private function phoneNumber($phoneNumber)
    {
        return $phoneNumber ? $phoneNumber->TP : null;
    }
    private function phoneNumberMobile($phoneNumber)
    {
        if($phoneNumber && $phoneNumber->MTP){
            // if(strlen($phoneNumber->MTP) > 8){
            if($phoneNumber->MTP!='--' && $phoneNumber->MTP!='-'){
                return $phoneNumber->MTP;
            }
        }
        // return $phoneNumber && $phoneNumber->MTP ? $phoneNumber->MTP : null;
    }

    private function titleReturn($title)
    {
        if($title == "Ven" || $title =="පුජ්‍ය"){
            return 1;
        }else if ($title == "Mr" || $title == "මහතා") {
            return 2;
        }else if ($title == "Ms" || $title == "මෙනවිය") {
            return 3;
        }else if ($title == "Mrs" || $title == "මහත්මිය") {
            return 4;
        }else{
            return $title;
        }
    }
}
