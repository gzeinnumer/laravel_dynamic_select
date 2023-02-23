<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ExamplesController extends Controller
{
    function index()
    {
        return view('examples.index');
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
