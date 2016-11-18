@extends('admin')
@section('content')
    <div class="addNews container">
        <h2>Add News</h2>
        {{Form::open(array('url'=> 'add/news','method'=>'POST','enctype'=>"multipart/form-data"))}}
            <div class="layout">
                <label for="title">Title</label>
                <div class="input-holder">
                    <input type="text" name="title" placeholder="Add title">
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
                        <input type="file" name="fileToUpload[]" id="fileToUpload"  onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
                        <div class="image-holder">
                            <img src="#" class="img-thumb1" alt="image Description">
                            <span class="propertyDocumentCloseBtn" ng-click="cancelFile(0)"><span class="icon-bin-delete"></span></span>
                        </div>
                    </div>

                    <span class="error-text">This is error</span>
                </li>
            </ul>
            <div class="layout text-center">
                <button class="btn-default" type="submit">Add News<span class="icon-arrow-right"></span></button>
            </div>
        {{Form::close()}}
    </div>
@endsection