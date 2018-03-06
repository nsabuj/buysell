@extends('backpack::layout')


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

                        <form action="/admin/create_ad" method="post" enctype="multipart/form-data" id="add_ad">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="price">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea cols="70" rows="10" name="description" id="description" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category:</label>
                                <select name="category_id" class="form-control">
                                    @foreach($category_list as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">City :</label>
                                <input type="text" class="form-control" id="city" name="city">
                            </div>
                            <div class="form-group">
                                <label for="photos">Upload Photos:</label>
                                <input type="file" class="form-control" id="photos[]" name="photos[]">
                            </div>
                            <input type="hidden" name="payment_method" id="payment_method" value="">

                            <button type="submit" class="btn btn-default btn_add_ad">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
