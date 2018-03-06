@extends( get_user_template(Auth::user()->role->name) )

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <meta name="csrf-token" content="{{ csrf_token() }}" />

                <h4>Hellow  {{Auth::user()->name}} ! </h4>
                <div class="col-lg-4 col-lg-offset-4">
                <span id="user_id" class="hidden">{{Auth::user()->id}}</span>
                    <span id="chat_id" class="hidden">{{$chat_id}}</span>
                <div id="chat-window" class="col-lg-12">
                @foreach($messages as $message)
                        <div class="msg-single sender-{{$message->sender_id}}">{{$message->message}}</div>
                @endforeach
                </div>
                <div class="col-lg-12">
                <div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="text" id="text" class="form-control col-lg-12" autofocus="" onblur="notTyping()">
                <a href="" class="btn btn-primary send">Send</a>
                </div>
                </div>
            </div>
        </div>
    </div>


@endsection
