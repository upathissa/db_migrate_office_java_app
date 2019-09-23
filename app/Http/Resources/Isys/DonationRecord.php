<?php

namespace App\Http\Resources\Isys;

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
        // return parent::toArray($request);
        // return [
        //     'month' => $this->id,
        //     'year' => $this->year,
        //     'amount' => $this->unit_amount,
        //     'subscription_id' => $this->remark_id,

        // ];

        $months = [
            1 => $this->January,        5 => $this->May,        9  => $this->September,
            2 => $this->February,       6 => $this->June,       10 => $this->October,
            3 => $this->March,          7 => $this->July,       11 => $this->November,    
            4 => $this->April,          8 => $this->August,     12 => $this->December
            
        ];
        return $this->setMonths($this->year,$this->unit_amount,$months, $this->remark_id);

    }

    private function setMonths($year,$amount,$months, $remark_id)
    {
        $monthsForYear = [];
        foreach ($months as $key => $value) {
            if($value == 1){
                $monthsForYear[] = [
                    'month' => $key,
                    'year' => $year,
                    'amount' => $amount,
                    'subscription_id' => $remark_id
                ];
            }
        }

        return $monthsForYear;

    }
}
