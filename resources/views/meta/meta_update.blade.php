@extends('admin')
@section('content')
    <div class="addCity container">
        <h2>Add Page Meta</h2>
        {{Form::open(array('url'=> 'update/meta','method'=>'POST','enctype'=>"multipart/form-data"))}}
        <input type="hidden" name="meta_id" value="{{$response['data']['meta']->id}}">
        <div class="layout">
            <label>Select Country</label>
            <div class="input-holder">
            <span class="fake-select">
                <select name="page" id="page_id">
                    <option value="">Please Select Page</option>
                    <option value="/" @if($response['data']['meta']->page == '/') selected @endif>Index</option>
                    <option value="search" @if($response['data']['meta']->page == 'search') selected @endif>property Listing</option>
                    <option value="property" @if($response['data']['meta']->page == 'property') selected @endif>property Detail</option>
                    <option value="agents" @if($response['data']['meta']->page == 'agents') selected @endif>Agent Listing</option>
                    <option value="agent" @if($response['data']['meta']->page == 'agent') selected @endif>Agent Detail</option>
                </select>
            </span>
            </div>
        </div>
        <div class="layout">
            <label for="city-pro">Add Meta Title</label>
            <div class="input-holder">
                <input type="text" name="title" value="{{$response['data']['meta']->title}}">
            </div>
        </div>
        <div class="layout">
            <label for="city-pro">Add Meta Keyword</label>
            <div class="input-holder">
                <input type="text" name="keyword" value="{{$response['data']['meta']->keyword}}">
            </div>
        </div>
        <div class="layout">
            <label for="city-pro">Add Meta Description</label>
            <div class="input-holder">
                <textarea name="description">{{$response['data']['meta']->description}}</textarea>
            </div>
        </div>
        <div class="layout text-center">
            <button class="btn-default" type="submit">Update Meta<span class="icon-arrow-right"></span></button>
        </div>
        {{Form::close()}}
    </div>
@endsection()