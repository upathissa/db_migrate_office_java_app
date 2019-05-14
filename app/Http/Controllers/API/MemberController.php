<?php

namespace App\Http\Controllers\API;

use App\Model\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function allMembers()
    {
        return Member::all();
    }
}
