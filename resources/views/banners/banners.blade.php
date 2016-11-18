@extends('admin')
@section('content')
    <div class="addBanner container">
        <h2>Add Banners</h2>
        {{Form::open(array('url'=> 'add/banner','method'=>'POST','class'=>'rejectApprove-form','enctype'=>"multipart/form-data"))}}
            <div class="layout">
                <div class="layout-holder">
                    <label>Select Society</label>
                    <div class="input-holder">
                        <select class="js-example-basic-single" name="society_id[]" multiple>
                            @foreach($response['data']['locations'] as $location)
                                <option value="{{$location->id }}">{{$location->location}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="layout-holder">
                    <label>Select Pages</label>
                    <div class="input-holder">
                        <select class="js-example-basic-single" name="pages[]" multiple>
                            @foreach($response['data']['pages'] as $pages)
                                <option value="{{$pages->id }}">{{$pages->page}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="layout">
                <div class="layout-holder">
                    <label>Land Area</label>
                    <div class="input-holder">
                    <span class="fake-select">
                        <select name="area[]">
                            <option value="" selected>All Sizes</option>
                            @for($i =1; $i <=100; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label>Land Unit</label>
                    <div class="input-holder">
                    <span class="fake-select">
                        <select name="unit" >
                            <option value="">Please Select Unit</option>
                            <option value="marla">Marla</option>
                            <option value="kanal">Kanal</option>
                        </select>
                    </span>
                    </div>
                </div>
            </div>
            <div class="layout">
                <div class="layout-holder">
                    <label>Banner Position</label>
                    <div class="input-holder">
                    <span class="fake-select">
                        <select name="position" required>
                            <option value="" selected >Please Select Position</option>
                            <option value="top">Top</option>
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                            <option value="between">Between</option>
                        </select>
                    </span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label for="banner-pro">Banner Priority</label>
                    <div class="input-holder">
                        <input type="number" name="priority" value="" placeholder="please Enter priority" required>
                    </div>
                </div>
            </div>
            <div class="layout">
                <div class="layout-holder">
                    <label>Banner Type</label>
                    <div class="input-holder">
                    <span class="fake-select">
                        <select name="type" required>
                            <option value="">Please Select Type</option>
                            <option value="fix">Fix</option>
                            <option value="relevant">Relevant</option>

                        </select>
                    </span>
                    </div>
                </div>
                <div class="layout-holder">
                    <label for="banner-links">Post Banner Link</label>
                    <div class="input-holder">
                        <input type="text" name="banner_link" value="" placeholder="please Enter Banner Link">
                    </div>
                </div>
            </div>
            <ul class="image-uploading-area">
                <li>
                    <div class="file-uploader">
                        <input type="file" name="fileToUpload" id="fileToUpload" required onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
                        <div class="image-holder">
                            <img src="#" class="img-thumb1" alt="image Description">
                            <span class="propertyDocumentCloseBtn" ng-click="cancelFile(0)"><span class="icon-bin-delete"></span></span>
                        </div>
                    </div>
                    <input type="text"  class="picture-name" placeholder="Title">
                    <span class="error-text">This is error</span>
                </li>
            </ul>
            <div class="layout text-center">
                <button class="btn-default" type="submit">Add Banner<span class="icon-arrow-right"></span></button>
            </div>
        {{Form::close()}}
    </div>

@endsection