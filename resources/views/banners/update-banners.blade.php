@extends('admin')
@section('content')

    <div class="addBanner container">
        <h2>Update Banners</h2>
        {{Form::open(array('url'=> 'update/banner','method'=>'POST','class'=>'rejectApprove-form','enctype'=>"multipart/form-data"))}}
        <input type="hidden" name="banner_id" value="{{$response['data']['banner']->id}}">
        <div class="layout">
            <div class="layout-holder">
                <label>Select Society</label>
                <div class="input-holder">
                    <select class="js-example-basic-single" name="society_id[]" multiple>
                        @foreach($response['data']['locations'] as $location)
                            <option value="{{$location->id }}" <?= (isset($response['data']['bannerSocieties']) && in_array($location->id,$response['data']['bannerSocieties']))? 'selected':'' ?>  >{{$location->location}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layout-holder">
                <label>Select Pages</label>
                <div class="input-holder">
                    <select class="js-example-basic-single" name="pages[]" multiple>
                        @foreach($response['data']['pages'] as $pages)
                            <option value="{{$pages->id }}" <?= (in_array($pages->id,$response['data']['bannerPages']))? 'selected':'' ?>>{{$pages->page}}</option>
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
                                <option value="{{$i}}" <?= (in_array($i,$response['data']['bannersSize']['area']))? 'selected':'' ?>>{{$i}}</option>
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
                            <option value="marla" <?= ((!emptyArray($response['data']['bannersSize']['unit']) && $response['data']['bannersSize']['unit'][0]) == 'marla')?'selected':''?>>Marla</option>
                            <option value="kanal" <?= ((!emptyArray($response['data']['bannersSize']['unit']) && $response['data']['bannersSize']['unit'][0]) == 'kanal')?'selected':''?>>Kanal</option>
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
                                <option value="top" <?= (($response['data']['banner']->position) == 'top')?'selected':''?> >Top</option>
                                <option value="left" <?= (($response['data']['banner']->position) == 'left')?'selected':''?>>Left</option>
                                <option value="between" <?= (($response['data']['banner']->position) == 'between')?'selected':''?>>Between</option>
                            </select>
                    </span>
                </div>
            </div>
            <div class="layout-holder">
                <label for="banner-pro">Banner Priority</label>
                <div class="input-holder">
                    <input type="text" name="priority" value="{{$response['data']['banner']->bannerPriority}}" placeholder="please Enter priority" required><br/><br/>
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
                            <option value="fix" <?= (($response['data']['banner']->bannerType) == 'fix')?'selected':''?>>Fix</option>
                            <option value="relevant" <?= (($response['data']['banner']->bannerType) == 'relevant')?'selected':''?> >Relevant</option>
                        </select>
                    </span>
                </div>
            </div>
            <div class="layout-holder">
                <label for="banner-links">Post Banner Link</label>
                <div class="input-holder">
                    <input type="text" name="banner_link" value="{{$response['data']['banner']->bannerLink}}" placeholder="please Enter Banner Link">
                </div>
            </div>
        </div>
        <ul class="image-uploading-area">
            @if($response['data']['banner']->image !="" && $response['data']['banner']->image !=null)
            <img src="{{url('/').'/'.$response['data']['banner']->image}}" width="100px" height="100px">
            @endif
            <li>
                <div class="file-uploader">
                    <input type="file" name="fileToUpload" id="fileToUpload"  onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
                    <div class="image-holder">
                        <img src="#" class="img-thumb1" alt="image Description">
                        <span class="propertyDocumentCloseBtn" ng-click="cancelFile(0)"><span class="icon-bin-delete"></span></span>
                    </div>
                </div>
                <span class="error-text">This is error</span>
            </li>
        </ul>
        <div class="layout text-center">
            <button class="btn-default" type="submit">Add Banner<span class="icon-arrow-right"></span></button>
        </div>
        {{Form::close()}}
    </div>




@endsection