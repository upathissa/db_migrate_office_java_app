<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonationRecord extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->setMonths(
                $this->months,
                $this->Year,
                $this->subscription->MounthDonateAmount,
                $this->subscription->member->RefID
        );
        // return [
        //     // 'id' => $this->idYear,
        //     // // 'user_id' => $this->subscription->member->RefID,
        //     // 'year' => $this->Year,
        //     // 'unit_amount' => $this->subscription->MounthDonateAmount,
        //     // 'DonateData_idDonateData' => $this->DonateData_idDonateData,
        //     // // 'months' => $this->months,
        //     'months' => $this->setMonths(
        //         $this->months,
        //         $this->Year,
        //         $this->subscription->MounthDonateAmount,
        //         $this->subscription->member->RefID
        //         )
        // ];
    }

    public function setMonths($months,$year,$unitAmount, $subsId)
    {
        $donatedMonths = [];
        $months = collect($months);
        $mapMonths = $months->filter(function ($item, $key) {
            if($key!='Year_idYear'){
                if($key != 'idMonths'){
                    return $item == 1;
                }
            }
        });
        $newMonths = $mapMonths->toArray();

        foreach ($newMonths as $key => $value) {
            $donatedMonths[] = [
                'month' => $this->getMonth($key),
                'year' => $year,
                'amount' => $unitAmount,
                'subscription_id' => $subsId
            ];
        }
        return $donatedMonths;
    }
    private function getMonth($month)
    {
        switch ($month) {
            case 'January':
                return 1;
                break;
            case 'February':
                return 2;
                break;
            case 'March':
                return 3;
                break;
            case 'April':
                return 4;
                break;
            case 'May':
                return 5;
                break;
            case 'June':
                return 6;
                break;
            case 'July':
                return 7;
                break;
            case 'August':
                return 8;
                break;
            case 'September':
                return 9;
                break;
            case 'October':
                return 10;
                break;
            case 'November':
                return 11;
                break;
            case 'December':
                return 12;
                break;
        }
    }
}
