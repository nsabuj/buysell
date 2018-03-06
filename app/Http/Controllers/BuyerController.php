<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\UserMeta;
use App\ProfilePhoto;
use Carbon\Carbon;
use Hash;
use App\ChatMessage;
use App\Chat;
use App\ChatRef;

class BuyerController extends Controller
{


    public function index(){
        return view('user.dashboard');
    }

    public function edit(){
        $user_id=Auth::user()->id;
        $user_details = User::findOrFail($user_id);
        return view('user.edit_profile',compact('user_details'));
    }

    public function update_user(UpdateProfileRequest $request){
       $user_id=Auth::user()->id;
       $user=User::find($user_id);
       $user->name=$request['name'];
       $user->email=$request['email'];
       $user->last_ip=\Request::ip();
       if($request['password']){
           $user->password=Hash::make($request['password']);
       }
       $user->save();
        if($request->profile){

            $old_profile=ProfilePhoto::where('user_id',$user_id)->first();
            if(count($old_profile)>0){

                $file = $request->profile;

                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

                $name = $timestamp . '-' . $file->getClientOriginalName();

                $filename = 'profile_photos/' . $name;

                $file->move(public_path() . '/profile_photos/', $name);

                $old_profile->filename=$filename;
                $old_profile->save();

              }else {

              //  die('testing');
                $file = $request->profile;

                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());

                $name = $timestamp . '-' . $file->getClientOriginalName();

                $filename = 'profile_photos/' . $name;

                $file->move(public_path() . '/profile_photos/', $name);

                ProfilePhoto::create([
                    'user_id' => $user_id,
                    'filename' => $filename
                ]);
                   }
    }

    // update phone number
        if($request->cell) {
           // die($request->cell);
            $usermeta = UserMeta::where('user_id', $user_id)->first();

            if (count($usermeta) > 0) {
                $usermeta->phone = $request['cell'];
                $usermeta->ip = \Request::ip();
                $usermeta->save();
            } else {
                UserMeta::create([
                    'user_id' => $user_id,
                    'phone' => $request['cell'],
                    'ip' => \Request::ip(),
                ]);
            }
        }

    return redirect('/user/edit');
    }

  public function chats(){
        $name=Auth::user()->name;
        $user_id=Auth::user()->id;
        $chats=Chat::with('ref')->where('user1',$user_id)->orWhere('user2',$user_id)->get();
        $chat_ref=array();
        foreach ($chats as $key=>$chat){
        if($chat->user1==$user_id){
            $secend_user=$chat->user2;
        }else{
            $secend_user= $chat->user1;
        }
        $ref_id=$chat->ref->ref_id;
        $ref=Advertisement::find($ref_id);
        $ref_title=$ref->title;
            $chat_ref[$key]=array(
                'user'=>$secend_user,
                'ad_id'=>$ref_id,
                'ad_title'=>$ref_title
            );

        }
        $mychats=$chat_ref;
//       foreach ($mychats as $chats){
////          foreach ($chats as $chat){
////              echo $chat[];
////          }
//          echo $chats['user'];
//       }
//        exit();
        return view('user.messages',compact('name','mychats'));
  }

    public function chat($id){

        $self=Auth::user();
        $next=User::find($id);

        if($self->id==$id){
            return redirect('/user/messages');
        }


        $whereData1 = array(array('user1',$self->id) , array('user2',$next->id));
        $whereData2 = array(array('user1',$next->id), array('user2',$self->id));

        $is_chat_already= Chat::where($whereData1)->orWhere($whereData2)->first();

        if(count($is_chat_already)<1){
            Chat::create([
                'user1' => $self->id,
                'user2' => $next->id,
            ]);
            return redirect('/user/chat/'.$id);
        }
        $chat_id=$is_chat_already->id;
        $messages=$is_chat_already->messages;

        return view('user.chat',compact('messages','chat_id'));


    }



    public function create_chat($id,$ref,$ref_id){

        $self=Auth::user();
        $next=User::find($id);

        if($self->id==$id){
            return redirect('/user/messages');
        }


        $whereData1 = array(array('user1',$self->id) , array('user2',$next->id));
        $whereData2 = array(array('user1',$next->id), array('user2',$self->id));

        $is_chat_already= Chat::where($whereData1)->orWhere($whereData2)->first();

        if(count($is_chat_already)<1){
            $chat=Chat::create([
                'user1' => $self->id,
                'user2' => $next->id,
            ]);

            $chat_id=$chat->id;
            $refname='';
            if($ref=='ref_ad'){
             $refname='ad';
            }
            ChatRef::create([
                'chat_id' => $chat_id,
                'ref_name' => $refname,
                'ref_id' =>  $ref_id
            ]);

            return redirect('/user/chat/'.$id);
        }
        $chat_id=$is_chat_already->id;
        $messages=$is_chat_already->messages;

        return view('user.chat',compact('messages','chat_id'));


    }

}
