@extends('admin')
@section('content')
    <div class="addProject container">
        <h2>Add Features</h2>
        {{Form::open(array('url'=>'add/feature','method'=>'POST','enctype'=>"multipart/form-data"))}}

             <div class="layout">
                <label>Select Type</label>
                <div class="input-holder">
                <span class="fake-select">
                    <select name="subTypeId">
                     @foreach($response['data']['subTypes'] as $subType)
                        <option value="{{$subType->id}}">{{$subType->name}}</option>
                     @endforeach
                    </select>
                </span>
                </div>
            </div>
        <div class="layout">
            <label>Select Feature Section</label>
            <div class="input-holder">
                <span class="fake-select">
                    <select name="feature_section_id">
                        @foreach($response['data']['featureSection'] as $featureSection)
                            <option value="{{$featureSection->id}}">{{$featureSection->name}}</option>
                        @endforeach
                    </select>
                </span>
            </div>
        </div>
            <div class="layout">
                <label for="title">Feature Name</label>
                <div class="input-holder">
                    <input type="text" name="feature_name" id="feature">
                </div>
            </div>
            <div class="layout">
                <label>Select Html Type</label>
                <div class="input-holder">
                <span class="fake-select">
                     <select name="feature_html_structure_id">
                         @foreach($response['data']['htmlStructures'] as $htmlStructure)
                             <option value="{{$htmlStructure->id}}">{{$htmlStructure->name}}</option>
                         @endforeach
                     </select>
                </span>
                </div>
            </div>
            <div class="layout">
                <label for="title">Priority</label>
                <div class="input-holder">
                    <input type="text" name="feature_priority" id="title">
                </div>
            </div>
            <div class="layout">
                <label for="description">Possible Values</label>
                <div class="input-holder">
                    <textarea id="description" name="feature_possible_values"></textarea>
                </div>
            </div>
            <div class="layout text-center">
                <button class="btn-default" type="submit">Add Feature<span class="icon-arrow-right"></span></button>
            </div>
        {{Form::close()}}
    </div>
@endsection