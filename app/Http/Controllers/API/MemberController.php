<?php

namespace App\Http\Controllers\API;

use App\Model\Member;
use App\Model\Address;
use Illuminate\Http\Request;
use App\Http\Resources\Address as AddressResource;
use App\Model\DonationRecord;
use App\Http\Controllers\Controller;
use App\Http\Resources\Member as MemberResource;
use App\Http\Resources\DonationRecord as DonationRecordResource;

class MemberController extends Controller
{
    public function allMembers()
    {
        return MemberResource::collection(Member::paginate(500));
    }

    public function subs()
    {
        return DonationRecordResource::collection(DonationRecord::paginate(150));
    }

    public function address()
    {
        return AddressResource::collection(Address::paginate(500));
    }
}
