<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellerController extends Controller
{


    public function __construct()
    {
//     $this->middleware('admin','seller','auth');
    }

    public function index(){
        return view('seller.home');
    }
}
