<?php

namespace App\Http\Controllers\API;

use App\Model\Member;
use Illuminate\Http\Request;
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
}
