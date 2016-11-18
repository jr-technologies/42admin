@extends('admin')
@section('content')
    <div class="addCity container">
        <h2>Update City</h2>
        {{Form::open(array('url'=> 'update/city','method'=>'POST','enctype'=>"multipart/form-data"))}}
        <input type="hidden" name="city_id" value="{{$response['data']['city']->id}}">
        <div class="layout">
            <label>Select Country</label>
            <div class="input-holder">
            <span class="fake-select">
                <select name="country_id" id="country_id">
                    <option value="">Please Select</option>
                    @foreach($response['data']['countries'] as $country)
                        <option value="{{$country->id}}" @if($response['data']['city']->countryId == $country->id) selected @endif >{{$country->name}}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>
        <div class="layout">
            <label for="city-name">City Name</label>
            <div class="input-holder">
                <input type="text" name="city_name" placeholder="Add City" value="{{$response['data']['city']->name}}">
            </div>
        </div>

        <div class="layout">
            <label for="city-pro">City priority</label>
            <div class="input-holder">
                <input type="text" name="priority" placeholder="Add Priority" value="{{$response['data']['city']->priority}}">
            </div>
        </div>
        <ul class="image-uploading-area">
            <li>
                @if($response['data']['city']->path !=null && $response['data']['city']->path !="" )
                <img src="{{url('/').'/'.$response['data']['city']->path}}" width="100px" height="100px">
                @endif
                <div class="file-uploader">
                    <input type="file" name="fileToUpload" id="fileToUpload"  multiple onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
                    <div class="image-holder">
                        <img src="#" class="img-thumb1" alt="image Description">
                        <span class="propertyDocumentCloseBtn" ng-click="cancelFile(0)"><span class="icon-bin-delete"></span></span>
                    </div>
                </div>

                <span class="error-text">This is error</span>
            </li>
        </ul>
        <div class="layout text-center">
            <button class="btn-default" type="submit">Update City<span class="icon-arrow-right"></span></button>
        </div>
        {{Form::close()}}
    </div>
@endsection()