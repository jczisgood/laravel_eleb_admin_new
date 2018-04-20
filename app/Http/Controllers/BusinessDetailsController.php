<?php

namespace App\Http\Controllers;

use App\BusinessCategory;
use Illuminate\Http\Request;

class BusinessDetailsController extends Controller
{
    //
    public function index()
    {
//        echo 1;
    }
    public function create()
    {
        $categories=BusinessCategory::all()->pluck('name','id');
        return view('businessdetails.create',compact('categories'));
    }

    public function store(Request $request)
    {

    }
}
