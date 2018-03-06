@extends( get_user_template(Auth::user()->role->name) )


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="panel-heading">Upload Advertisement</div>

                    <div class="panel-body">

                        <form action="/admin/update_ad" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <input type="hidden" name="ad_id" value="{{$ad->id}}">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$ad->title}}">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="price" value="{{$ad->price}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea cols="70" rows="10" name="description" id="description" class="form-control">{{$ad->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category:</label>
                                <select name="category_id" class="form-control">
                                    @foreach($category_list as $category)
                                        <option value="{{$category->id}}" @if($ad->category_id==$category->id)

                                        {{'selected'}} @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{$ad->city}}">
                            </div>

                            <div class="form-group">
                            <label for="ad_status"></label>
                            <select name="ad_status" id="ad_status" class="form-control">
                                <option value="" @if($ad->approved=='')

                                        {{'selected'}} @endif >Pending</option>
                                <option value="no" @if($ad->approved=='no')

                                        {{'selected'}} @endif >Decline</option>
                                <option value="yes" @if($ad->approved=='yes')

                                        {{'selected'}} @endif>Approav</option>
                            </select>
                            </div>


                            <div class="form-group">
                                <label for="photos">Upload Photos:</label>
                                <input type="file" class="form-control" id="photos[]" name="photos[]" multiple>
                            </div>
                            <div class="ads_images">
                                <div class="row">

                                    @if(count($photos)>0)
                                  @foreach($photos as $image)
                                      <div class="col-md-2 {{$image->id}}">
                                          <div class="ad-thumb">
                                          <img class="ad_photo" src="{{ asset('/').$image['filename'] }}" />
                                          <a class="btn ad_photo_delete" id="{{$image->id}}"><i class="fa fa-times"></i> </a>
                                          </div>
                                      </div>
                                  @endforeach
                                        @endif
                                </div>
                            </div>

                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
