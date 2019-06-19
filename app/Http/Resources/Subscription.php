<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Subscription extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->idDonateData,
            "remark_id" => $this->remarkSet($this->member->RefID,$this->member->RegID),
            "user_id" => $this->User_idUser,
            "donation_place_name_id" => $this->donation_place_name_id(
                $this->TempleName_idTempleName,
                $this->Bank
            ),
            // "donation_place_name": "කුණ්ඩසාල අසපුව",
            'donation_method_id' => $this->donation_method_id($this->DonationBankACType_idDonationBankACType),
            "donation_program_id" => 2, //"ධර්ම දාන",
            // "standing_order_record_id": null,
            "unit_amount" => $this->MounthDonateAmount,
            "created_at" => $this->Date
           



            // "DonationType_idDonationType": 2,
            // "DonationBankACType_idDonationBankACType": 3,
            // "StOderDate": null,
            // "Bank": null,
            // "AcID": null,
            // "TempleName_idTempleName": 1,
            // "ProjectType_idProjectType": 1,
            // "Project_idProject": 1,
            // "certificate": 1,
            // "BankInfor_idBankInfor": null
        ];
    }

    private function remarkSet($remark,$reg){
        if($remark == null){
            return $reg;
        }else{
            return $remark;
        }
    }
}
