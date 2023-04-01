<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinderController extends Controller
{
    function index()
    {
        return view('finder.index');
    }

    function myItemNameSearch(Request $r)
    {
        $data = User::select();
        $name = urldecode($r->name);
        if ($name != "") {
            $data = $data->where(DB::Raw("CONCAT(name,' - ',email, ' - ', id)"), 'LIKE', '%' . $name . '%');
        }
        $data = $data->get();

        return $data;
    }

    function myItemNameV2Search(Request $r)
    {
        $data = User::select();
        $name = urldecode($r->name);
        if ($name != "") {
            $data = $data->where(DB::Raw("CONCAT(name,' - ',email, ' - ', id)"), 'LIKE', '%' . $name . '%');
        }
        $data = $data->get();

        return $data;
    }
}
