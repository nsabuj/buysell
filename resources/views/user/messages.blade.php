@extends( get_user_template(Auth::user()->role->name) )

@section('content')
   <div class="container">
       <div class="row">
           <div class="col-md-12">


               <div class="message_threads">
                   <ul>
                       @if(count($mychats)>0)
                       @foreach($mychats as $chat)

                        {{--@if($chat->user1==Auth::user()->id)--}}
                       <li>Product ref: <a href="">{{$chat['ad_title']}}</a>&nbsp;&nbsp;&nbsp;&nbsp; <a href="/user/chat/{{$chat['user']}}">Chat Room</a></li>
                        {{--@else--}}
                               {{--<li><a href="/user/chat/{{$chat->user1}}">Chat</a></li>--}}
                        {{--@endif--}}

                       @endforeach
                       @else
                       {{No Chat room}}
                       @endif
                   </ul>
               </div>

           </div>
       </div>
   </div>


@endsection
