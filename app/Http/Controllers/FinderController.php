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

    function searchMyItemName(Request $r)
    {
        $data = User::select();

        if (urldecode($r->name) != "") {
            $data = $data->where('name', 'LIKE', '%' . urldecode($r->name) . '%');
        }
        $data = $data->get();

        return $data;
    }
}
