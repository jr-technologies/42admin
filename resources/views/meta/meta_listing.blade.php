@extends('admin')
@section('content')
    <div class="meta-listing">
        <div class="layout text-right"><a href="{{URL::to('get-meta-page')}}" class="btn-hollow">Add meta</a></div>
        <div class="table-responsive">
            <ul class="listing-pro">
                <li class="t-h text-upparcase text-center">
                    <div class="pro-id border">
                        <label for="property-id" class="customCheckbox">
                            <input type="checkbox" id="property-id">
                            <span class="fake-checkbox"></span>
                            <span class="fake-label">ID</span>
                        </label>
                    </div>
                    <div class="pro-position border"><p>Page</p></div>
                    <div class="pro-image border"><p>Title</p></div>
                    <div class="pro-image border"><p>Keywords</p></div>
                    <div class="pro-image border"><p>Description</p></div>
                    <div class="pro-controls border"><p>Controls</p></div>
                </li>
            @foreach($response['data']['metas'] as $meta)
                <li class="t-d text-center">
                    <div class="pro-id border">
                        <label for="property-id-td" class="customCheckbox">
                            <input type="checkbox" id="property-id-td">
                            <span class="fake-checkbox"></span>
                            <span class="fake-label">{{$meta->id}}</span>
                        </label>
                    </div>
                    <div class="pro-position border"><p>{{$meta->page}}</p></div>
                    <div class="pro-image border"><p>{{$meta->title}}</p></div>
                    <div class="pro-image border"><p>{{$meta->keyword}}</p></div>
                    <div class="pro-image border"><p>{{$meta->description}}</p></div>
                    <div class="pro-controls border">
                        <ul class="control-link">
                         {{Form::open(array('url'=>'get-update-page','method'=>'POST'))}}
                            <input type="hidden" name="meta_id" value="{{$meta->id}}">
                            <li class="active"><button title="Update"><span class="icon-update-arrows"></span></button></li>
                         {{Form::close()}}
                         {{Form::open(array('url'=>'delete-meta','method'=>'POST'))}}
                            <input type="hidden" name="meta_id" value="{{$meta->id}}">
                            <li class="delete"><button title="Delete"><span class="icon-bin-delete"></span></button></li>
                         {{Form::close()}}
                        </ul>
                    </div>
                </li>
            @endforeach
                <li>
                    <div class="propertyNotFound hidden">
                        <strong class="no-heading">sorry, no record found</strong>
                        <p>There is no property in record.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection()