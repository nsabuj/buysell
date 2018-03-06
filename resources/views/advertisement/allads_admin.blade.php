@extends('backpack::layout')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{--@if(isset($error))--}}
                <p class="error">{{session('error')}}</p>
                {{--@endif--}}
                    {{--@if(isset($success))--}}
                        <p class="error">{{session('success')}}</p>
                    {{--@endif--}}
            <div class="table-responsive">
            <table id="myads"class="table dataTable">
                <thead>
                <tr>
                <th>#ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>City</th>
                <th>Status</th>
                <th>Paid</th>
                <th></th>
                <th></th>
                <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($ads as $key=>$ad)
                
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$ad['title']}}</td>
                        <td>{{$ad['price']}}$</td>
                        <td>{{$ad['city']}}</td>
                        <td>
                        @if($ad['approved'])
                          @if($ad['approved']=='yes')
                          Approved
                          @else
                          Declined
                          @endif
                        @else 
                          Pending
                        @endif
                        </td>
                        <td>
                        @if($ad['status'])
                          @if($ad['status']=='1')
                          Yes
                          @else
                          No
                          @endif
                        @else 
                          No
                        @endif                     
                        </td>
                        <td><a href="/single-ad/{{$ad['id']}}">View</a></td>
                        <td><a href="edit_ad/{{$ad['id']}}">Edit</a></td>
                        <td><a href="delete_ad/{{$ad['id']}}">Delete</a></td>
                    </tr>
                 @endforeach
                 
                </tbody>

            </table>
            </div>
            </div>
        </div>
    </div>
@endsection
