@extends('admin')
@section('content')
<div class="addCity container">
    <h2>Add City</h2>
    {{Form::open(array('url'=> 'add/city','method'=>'POST','enctype'=>"multipart/form-data"))}}
        <div class="layout">
            <label>Select Country</label>
            <div class="input-holder">
            <span class="fake-select">
                <select name="country_id" id="country_id">
                    <option value="">Please Select</option>
                    @foreach($response['data']['countries'] as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
            </span>
            </div>
        </div>
        <div class="layout">
            <label for="city-name">City Name</label>
            <div class="input-holder">
                <input type="text" name="city_name" placeholder="Add City">
            </div>
        </div>

        <div class="layout">
            <label for="city-pro">City priority</label>
            <div class="input-holder">
                <input type="text" name="priority" placeholder="Add Priority">
            </div>
        </div>

        <ul class="image-uploading-area">
            <li>
                <div class="file-uploader">
                    <input type="file"  name="fileToUpload" id="fileToUpload" required multiple onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
                    <div class="image-holder">
                        <img src="#" class="img-thumb1" alt="image Description">
                        <span class="propertyDocumentCloseBtn" ng-click="cancelFile(0)"><span class="icon-bin-delete"></span></span>
                    </div>
                </div>

                <span class="error-text">This is error</span>
            </li>
        </ul>
        <div class="layout">
            <label for="city-pro">Title</label>
            <div class="input-holder">
                <input type="text" name="title" placeholder="Add Meta">
            </div>
        </div>
        <div class="layout">
            <label for="city-pro">Key Word</label>
            <div class="input-holder">
                <input type="text" name="keyword" placeholder="Add KeyWord">
            </div>
        </div>
        <div class="layout">
            <label for="city-pro">Description</label>
            <div class="input-holder">
                <input type="text" name="description" placeholder="Add Priority">
            </div>
        </div>
        <div class="layout">
            <label for="city-pro">No Index</label>
            <div class="input-holder">
                <input type="text" name="index" placeholder="Add Priority">
            </div>
        </div>
        <div class="layout text-center">
            <button class="btn-default" type="submit">Add City<span class="icon-arrow-right"></span></button>
        </div>
   {{Form::close()}}
</div>
@endsection()