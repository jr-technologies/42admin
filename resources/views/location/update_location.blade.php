@extends('admin')
@section('content')
    <div class="addCity container">
        <h2>Update Location</h2>
        {{Form::open(array('url'=> 'update/location','method'=>'POST','enctype'=>"multipart/form-data"))}}
        <input type="hidden" name="location_id" value="{{$response['data']['location']->id}}">
        <div class="layout">
            <label>Select City</label>
            <div class="input-holder">
            <span class="fake-select">
                <select name="city_id">
                    <option value="">Please Select</option>
                    @foreach($response['data']['cities'] as $city)
                        <option value="{{$city->id}}" @if($response['data']['location']->cityId == $city->id) selected @endif>{{$city->name}}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>
        <div class="layout">
            <label for="city-name">Location Name</label>
            <div class="input-holder">
                <input type="text" name="location" placeholder="Add Location" value="{{$response['data']['location']->location}}">
            </div>
        </div>
        @if($response['data']['location']->path !="" && $response['data']['location']->path !=null)
            <img src="{{url('/').'/'.$response['data']['location']->path}}" width="100" height="100">
        @endif
        <input type="file" name="path" id="fileToUpload"  onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
        <div class="layout">
            <label for="city-name">LAT</label>
            <div class="input-holder">
                <input type="text" name="lat" placeholder="Add lat" value="{{$response['data']['location']->lat}}">
            </div>
        </div>
        <div class="layout">
            <label for="city-name">LONG</label>
            <div class="input-holder">
                <input type="text" name="long" placeholder="Add long" value="{{$response['data']['location']->long}}">
            </div>
        </div>
        <div class="layout text-center">
            <button class="btn-default" type="submit">Update Location<span class="icon-arrow-right"></span></button>
        </div>
        {{Form::close()}}
    </div>
@endsection