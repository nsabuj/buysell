
@extends( get_user_template(Auth::user()->role->name) )

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <h2>Profile Update</h2>

                @if (count($errors) > 0)
                    <ul class="errors">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                 <form action="/user/edit" method="post" enctype="multipart/form-data">
                     {{ csrf_field() }}
                     <div class="form-group">
                         <label for="name">Full Name</label>
                         <input type="text" name="name" id="name" class="form-control" value="{{$user_details['name']}}">
                     </div>
                     <div class="form-group">
                         <label for="email">Email</label>
                         <input type="text" name="email" id="email" class="form-control" value="{{$user_details['email']}}">
                     </div>


                     <div class="form-group">
                         <label for="password">New Password</label>
                         <input type="password" name="password" id="password" class="form-control">
                     </div>
                     <div class="form-group">
                         <label for="password_confirmation">Confirm Password</label>
                         <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                     </div>
                     <div class="form-group">
                         <label for="cell">Phone Number</label>
                         <input type="text" name="cell" id="cell" class="form-control" value="@if($user_details->user_meta){{$user_details->user_meta->phone}}
                         @endif">
                     </div>
                     <div class="form-group">
                         <label for="profile">Upload Profile:</label>
                         <input type="file" class="form-control" id="profile" name="profile">
                     </div>
                     @if($user_details->profile_pic)
                         <div class="current-profile-pic">
                             <img src="{{asset('/').$user_details->profile_pic->filename}}"/>
                         </div>
                     @endif
                     <button type="Update" class="btn btn-default">Submit</button>
                 </form>
            </div>
        </div>
    </div>

@endsection