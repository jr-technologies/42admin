@extends('admin')
@section('content')

    <div class="addProject container">
        <h2>Add Projects</h2>
        {{Form::open(array('url'=> 'add/project','method'=>'POST','enctype'=>"multipart/form-data"))}}
            <div class="layout">
                <label for="title">Project Title</label>
                <div class="input-holder">
                    <input type="text" name="title" placeholder="Add title">
                </div>
            </div>
            <div class="layout">
                <label>Select City</label>
                <div class="input-holder">
                <span class="fake-select">
                    <select name="city_id" id="cityId">
                        <option value="">Please Select</option>
                        @foreach($response['data']['cities'] as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </span>
                </div>
            </div>
            <div class="layout">
                <label>Select Location</label>
                <div class="input-holder">
                <span class="fake-select">
                    <select name="society_id" id="societies">
                        <option value="">Select Societies</option>
                    </select>
                </span>
                </div>
            </div>
            <div class="layout">
                <label for="description">Description</label>
                <div class="input-holder">
                    <textarea name="description" placeholder="Add description"></textarea>
                </div>
            </div>
            <ul class="image-uploading-area">
                <li>
                    <div class="file-uploader">
                        <input type="file" ype="file" name="fileToUpload[]" onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
                        <div class="image-holder">
                            <img src="#" class="img-thumb1" alt="image Description">
                            <span class="propertyDocumentCloseBtn" ng-click="cancelFile(0)"><span class="icon-bin-delete"></span></span>
                        </div>
                    </div>
                    <p>*Banner should be 1MB</p>
                </li>
            </ul>
            <div class="layout text-center">
                <button class="btn-default" type="submit">Add Project<span class="icon-arrow-right"></span></button>
            </div>
        {{Form::close()}}
    </div>
@endsection