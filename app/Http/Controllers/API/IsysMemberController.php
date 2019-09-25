<?php

namespace App\Http\Controllers\API;

use App\Model\Isys\Member;
use Illuminate\Http\Request;
use App\Http\Resources\Isys\Member as MemberResource;
use App\Http\Controllers\Controller;

class IsysMemberController extends Controller
{
    //
    private $titleProcess = "";  
    public function allMembers()
    {
        return MemberResource::collection(Member::paginate(20));
        // return MemberResource::collection(Member::all());
        
        
    }
    public function test()
    {
        $members = collect(MemberResource::collection(Member::paginate(5000)));

        $out = $members->pluck('subscription')->where('unit_amount',0);

        return $out->all();

    }

    public function amountZero()
    {
        return Member::where('unit_amount', 0)->count();
    }
   
}
