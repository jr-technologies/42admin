@extends('admin')
@section('content')
<div class="addCity container">
    <h2>Add Page Meta</h2>
    {{Form::open(array('url'=> 'add/meta','method'=>'POST','enctype'=>"multipart/form-data"))}}
        <div class="layout">
            <label>Select PAge</label>
            <div class="input-holder">
            <span class="fake-select">
                <select name="page" id="page_id">
                    <option value="">Please Select Page</option>
                    <option value="/">Index</option>
                    <option value="search">property Listing</option>
                    <option value="property">property Detail</option>
                    <option value="agents">Agent Listing</option>
                    <option value="agent">Agent Detail</option>
                </select>
            </span>
            </div>
        </div>
        <div class="layout">
            <label for="city-pro">Add Meta Title</label>
            <div class="input-holder">
                <input type="text" name="title">
            </div>
        </div>
        <div class="layout">
            <label for="city-pro">Add Meta Keyword</label>
            <div class="input-holder">
                <input type="text" name="keyword" >
            </div>
        </div>
        <div class="layout">
            <label for="city-pro">Add Meta Description</label>
            <div class="input-holder">
                <textarea name="description"></textarea>
            </div>
        </div>
        <div class="layout text-center">
            <button class="btn-default" type="submit">Add Meta<span class="icon-arrow-right"></span></button>
        </div>
   {{Form::close()}}
</div>
@endsection()