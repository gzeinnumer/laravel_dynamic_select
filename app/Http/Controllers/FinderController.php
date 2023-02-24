<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            $data = $data->where('name', 'LIKE', '%' . $name . '%');
        }
        $data = $data->get();

        return $data;
    }
}
