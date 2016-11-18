 @extends('admin')
@section('content')
    <div class="addProject container">
        <h2>Update Projects</h2>
        {{Form::open(array('url'=> 'update/project','method'=>'POST','enctype'=>"multipart/form-data"))}}
        <input type="hidden" name="project_id" value="{{$response['data']['project']->id}}">
        <div class="layout">
            <label for="title">Project Title</label>
            <div class="input-holder">
                <input type="text" name="title" placeholder="Add title" value="{{$response['data']['project']->title}}">
            </div>
        </div>
        <div class="layout">
            <label>Select City</label>
            <div class="input-holder">
                <span class="fake-select">
                    <select name="city_id" id="cityId">
                        <option value="">Please Select</option>
                        @foreach($response['data']['cities'] as $city)
                            <option value="{{$city->id}}" @if($response['data']['project']->cityId == $city->id) selected @endif>{{$city->name}}</option>
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
                        @foreach($response['data']['societies'] as $society)
                            <option value="{{$society->id}}" @if($response['data']['project']->societyId == $society->id ) selected @endif>{{$society->name}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>
        <div class="layout">
            <label for="description">Description</label>
            <div class="input-holder">
                <textarea name="description" placeholder="Add description">{{$response['data']['project']->description}}</textarea>
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
            <button class="btn-default" type="submit">Update Project<span class="icon-arrow-right"></span></button>
        </div>
        {{Form::close()}}
    </div>
@endsection