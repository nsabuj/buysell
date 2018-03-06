<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\AdvertisementsPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
     //   $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {




        if(request()->has('search') && request()->has('search_name')&& request()->has('sortby')){ /* searching by category or city */
           if(request('sortby')=='cheap') {
               if (request('search_name') == 'cat') {
                   $ads = Advertisement::with('photos', 'category')->whereHas('category', function ($query) {
                       $query->where('name', 'like', '%' . request('search') . '%');
                   })->orderBy('price', 'asc')->paginate(5);
                   return view('home', compact('ads'));
                   exit();
               } else {
                   $ads = Advertisement::with('photos', 'category')->where('city', 'like', '%' . request('search') . '%')->orderBy('price', 'asc')->paginate(5);
                   return view('home', compact('ads'));
                   exit();
               }
           }else{
               if(request('search_name')=='cat') {
                   $ads = Advertisement::with('photos', 'category')->whereHas('category', function ($query) {
                       $query->where('name', 'like', '%' . request('search') . '%');
                   })->orderBy('created_at', 'desc')->paginate(5);
                   return view('home', compact('ads'));
                   exit();
               }else{
                   $ads = Advertisement::with('photos', 'category')->where('city', 'like', '%' . request('search') . '%')->orderBy('created_at', 'desc')->paginate(5);
                   return view('home', compact('ads'));
                   exit();
               }
           }


        }elseif(request()->has('search')&& request()->has('sortby')) {
            if(request('sortby')=='cheap') {
                $ads = Advertisement::with('photos', 'category')->where('title', 'like', '%' . request('search') . '%')->orWhere('description', 'like', '%' . request('search') . '%')->orderBy('price', 'asc')->paginate(5);
                return view('home', compact('ads'));
                exit();
            }else{
                $ads = Advertisement::with('photos', 'category')->where('title', 'like', '%' . request('search') . '%')->orWhere('description', 'like', '%' . request('search') . '%')->orderBy('created_at', 'desc')->paginate(5);
                return view('home', compact('ads'));
                exit();
            }

        }elseif(request()->has('sortby')) {
            if(request('sortby')=='cheap') {
                $ads = Advertisement::with('photos', 'category')->orderBy('price', 'asc')->paginate(5);
                return view('home', compact('ads'));
                exit();
            }else{
                $ads = Advertisement::with('photos', 'category')->orderBy('created_at', 'desc')->paginate(5);
                return view('home', compact('ads'));
                exit();
            }
        }
    else {

        $ads = Advertisement::with('photos', 'category')->orderBy('created_at', 'desc')->paginate(5);
        return view('home', compact('ads'));
    }
    }

    public function myaccount(){
        if (!Auth::user()->isAdmin()) {
            if (!Auth::user()->isSeller()) {
                return redirect('/user/myaccount');
            }
            return redirect('/seller/myaccount');
        }
        return redirect('/admin');
    }

    public function show_single_ad($id){
        $ad=Advertisement::with('photos','category')->find($id);
        return view('ad-single',compact('ad'));
    }


    public function contact(){
    return view('contact');
}

    public function about(){
        return view('about');
    }

    public function faq(){
        return view('faq');
    }
}
