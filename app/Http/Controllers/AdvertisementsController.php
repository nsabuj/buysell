<?php

namespace App\Http\Controllers;
use App\AdvertisementsPhoto;
use App\Http\Requests\UploadRequest;
use Illuminate\Http\Request;
use View;
use App\Category;
use App\Advertisement;
use App\PaymentDetails;
use Auth;
use Carbon\Carbon;
use App\AdminOption;
class AdvertisementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $category_list=Category::all();


//        dd($category_list);
        return View::make('advertisement.add',compact('category_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(UploadRequest $request)
    {
        $request['expires']=date('d-m-Y', strtotime('+2 months'));
        $request['user_id']=Auth::user()->id;
        $ad = Advertisement::create($request->all());
        if($request->photos) {
            foreach ($request->photos as $photo) {

                $file = $photo;

                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

                $name = $timestamp. '-' .$file->getClientOriginalName();

                $filename = 'ad_photos/'.$name;

                $file->move(public_path().'/ad_photos/', $name);

                AdvertisementsPhoto::create([
                    'advertisement_id' => $ad['id'],
                    'filename' => $filename
                ]);
            }
        }

        if($request->payment_method){
            if($request->payment_method=='card'){
                return redirect('/seller/card/'.$ad['id']);
            }elseif($request->payment_method=='paypal'){
                return redirect('/seller/paypal/'.$ad['id']);
            }else{
                return redirect('/seller/my_ads');
            }

        }else{
            return redirect('/seller/my_ads');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function allAds()
    {
        $ads=Advertisement::get()->where('user_id',Auth::user()->id);

        return View::make('advertisement.allads',compact('ads'));
    }

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_list=Category::all();
        $ad=Advertisement::findOrFail($id);
      $photos=AdvertisementsPhoto::get()->where('advertisement_id',$id);
        return View::make('advertisement.edit',compact('ad','category_list','photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadRequest $request)
    {

        $ad = Advertisement::find($request['ad_id']);
        $ad->title=$request['title'];
        $ad->price=$request['price'];
        $ad->description=$request['description'];
        $ad->category_id=$request['category_id'];
        $ad->city=$request['city'];
         $ad->save();
         if($request->photos) {
             foreach ($request->photos as $photo) {

                 $file = $photo;

                 $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

                 $name = $timestamp. '-' .$file->getClientOriginalName();

                 $filename = 'ad_photos/'.$name;

                 $file->move(public_path().'/ad_photos/', $name);

                 AdvertisementsPhoto::create([
                     'advertisement_id' => $request['ad_id'],
                     'filename' => $filename
                 ]);
             }
         }
        return redirect('/seller/my_ads');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Advertisement::findOrFail($id)->delete();
        $ad_photos=AdvertisementsPhoto::get()->where('advertisement_id',$id);
        foreach ($ad_photos as $photo){
            AdvertisementsPhoto::findOrFail($photo['id'])->delete();
        }

        return redirect('/seller/my_ads');
    }


    public function delete_ad_image(Request $request){
        AdvertisementsPhoto::findOrFail($request->ad_img_id)->delete();
        return 1;
    }




    // admin options

    public function admin_create()
    {


        $category_list=Category::all();


//        dd($category_list);
        return View::make('advertisement.add_admin',compact('category_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function admin_store(UploadRequest $request)
    {
        $request['expires']=date('d-m-Y', strtotime('+2 months'));
        $request['user_id']=Auth::user()->id;
        $ad = Advertisement::create($request->all());
        if($request->photos) {
            foreach ($request->photos as $photo) {

                $file = $photo;

                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

                $name = $timestamp. '-' .$file->getClientOriginalName();

                $filename = 'ad_photos/'.$name;

                $file->move(public_path().'/ad_photos/', $name);

                AdvertisementsPhoto::create([
                    'advertisement_id' => $ad['id'],
                    'filename' => $filename
                ]);
            }
        }

        return redirect('/admin/all_ads');

 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_allAds()
    {

       
        
        $Allads=Advertisement::with('payment_details')->get();
     //   dd($ads);
        $allads=array();
        foreach ($Allads as $key => $value) {
            $this_ad['id']=$value->id;
            $this_ad['title']=$value->title;
            $this_ad['price']=$value->price;
            $this_ad['city']=$value->city;
            $this_ad['description']=$value->description;
            $this_ad['approved']=$value->approved;
            $this_ad['expires']=$value->expires;
          if($value->payment_details()){

            $this_ad['paid_amount']=$value->payment_details['amount'];
            $this_ad['status']=$value->payment_details['status'];
       
          }
          // dd($value->payment_details);  
          array_push($allads,$this_ad);
        }

       $ads=$allads;
        

//     foreach($ads as $ad)
// {
//     echo $ad['id'];
//     echo $ad['title'];
//     echo $ad['price'];
//     echo $ad['city'];
//     echo $ad['description'].'</br>';
// }
    //  die();   
        return View::make('advertisement.allads_admin',compact('ads'));
    }

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_edit($id)
    {
        $category_list=Category::all();
        $ad=Advertisement::findOrFail($id);
      $photos=AdvertisementsPhoto::get()->where('advertisement_id',$id);
        return View::make('advertisement.edit_admin',compact('ad','category_list','photos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_update(UploadRequest $request)
    {

        // dd($request);

        $ad = Advertisement::find($request['ad_id']);
        $ad->title=$request['title'];
        $ad->price=$request['price'];
        $ad->description=$request['description'];
        $ad->category_id=$request['category_id'];
        $ad->city=$request['city'];
        $ad->approved=$request['ad_status'];
         $ad->save();
         if($request->photos) {
             foreach ($request->photos as $photo) {

                 $file = $photo;

                 $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

                 $name = $timestamp. '-' .$file->getClientOriginalName();

                 $filename = 'ad_photos/'.$name;

                 $file->move(public_path().'/ad_photos/', $name);

                 AdvertisementsPhoto::create([
                     'advertisement_id' => $request['ad_id'],
                     'filename' => $filename
                 ]);
             }
         }
        return redirect('/admin/all_ads');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function admin_destroy($id)
    // {

    //     Advertisement::findOrFail($id)->delete();
    //     $ad_photos=AdvertisementsPhoto::get()->where('advertisement_id',$id);
    //     foreach ($ad_photos as $photo){
    //         AdvertisementsPhoto::findOrFail($photo['id'])->delete();
    //     }

    //     return redirect('/seller/my_ads');
    // }


    
}
