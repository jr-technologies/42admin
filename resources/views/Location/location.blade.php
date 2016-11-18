@extends('admin')
@section('content')
<div class="addCity container">
    <h2>Add Location</h2>
    {{Form::open(array('url'=> 'add/location','method'=>'POST','enctype'=>"multipart/form-data"))}}
        <div class="layout">
            <label>Select City</label>
            <div class="input-holder">
            <span class="fake-select">
                <select name="city_id">
                    <option value="">Please Select</option>
                    @foreach($response['data']['cities'] as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>
        <div class="layout">
            <label for="city-name">Location Name</label>
            <div class="input-holder">
                <input type="text" name="location" placeholder="Add Location">
            </div>
        </div>

        <input type="file" name="path" id="fileToUpload"  onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">

        <div class="layout">
            <label for="city-name">LAT</label>
            <div class="input-holder">
                <input type="text" name="lat" placeholder="Add lat">
            </div>
        </div>
        <div class="layout">
            <label for="city-name">LONG</label>
            <div class="input-holder">
                <input type="text" name="long" placeholder="Add long">
            </div>
        </div>
            <div class="layout text-center">
                <button class="btn-default" type="submit">Add Location<span class="icon-arrow-right"></span></button>
            </div>
   {{Form::close()}}
</div>
@endsection