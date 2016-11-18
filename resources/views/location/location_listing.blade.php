@extends('admin')
@section('content')
    <div class="layout text-right"><a href="{{URL::to('location')}}" class="btn-hollow">Add a Location</a></div>
    {{Form::open(array('url'=> 'get/location/by/City','method'=>'GET'))}}
   <span class="fake-select">
    <select name="city_id">
        <option value="">Please Select City</option>
        @foreach($response['data']['cities'] as $city)
            <option value="{{$city->id}}" @if(isset($response['data']['cityId']) && $response['data']['cityId'] == $city->id) selected @endif>{{$city->name}}</option>
        @endforeach
    </select>
   </span>
    <button><span type="submit" ></span>Submit</button>
    {{Form::close()}}
<div class="city-listing">
    <ul class="listing-pro">
        <li class="t-h text-upparcase text-center">
            <div class="pro-id border">
                <label for="property-id" class="customCheckbox">
                    <input type="checkbox" id="property-id">
                    <span class="fake-checkbox"></span>
                    <span class="fake-label">ID</span>
                </label>
            </div>
            <div class="pro-city border"><p>City name</p></div>
            <div class="pro-priority border"><p>Location</p></div>
            <div class="pro-priority border"><p>Lat</p></div>
            <div class="pro-date border"><p>Image</p></div>
            <div class="pro-controls border"><p>Controls</p></div>
        </li>
  @if(isset($response['data']['locations']))
     @foreach($response['data']['locations'] as $location)
        <li class="t-d text-center">
            <div class="pro-id border">
                <label for="property-id-td" class="customCheckbox">
                    <input type="checkbox" id="property-id-td">
                    <span class="fake-checkbox"></span>
                    <span class="fake-label">{{$location->id}}</span>
                </label>
            </div>
            <div class="pro-city border"><p>{{$location->cityName}}</p></div>
            <div class="pro-priority border"><p>{{$location->location}}</p></div>
            <div class="pro-priority border"><p>{{$location->lat}}</p></div>
            <div class="pro-date border"><img src="{{url('/').'/'.$location->path}}" width="100" height="100"></div>
            <div class="pro-controls border">
                <ul class="control-link">
                    {{Form::open(array('url'=>'get/update/location/form','method'=>'POST','class'=>'rejectApprove-form'))}}
                    <input hidden name="location_id" value="{{$location->id}}">
                    <li class="active"><button type="submit"><span class="icon-update-arrows"></span>Update</button></li>
                    {{Form::close()}}
                    {{Form::open(array('url'=>'delete/location','method'=>'POST'))}}
                    <input hidden name="location_id" value="{{$location->id}}">
                    <li class="deactive"><button type="submit"><span class="icon-cross"></span>Delete</button></li>
                    {{Form::close()}}
                </ul>
            </div>
        </li>
     @endforeach
  @endif
        <li>
            <div class="propertyNotFound hidden">
                <strong class="no-heading">sorry, no record found</strong>
                <p>There is no property in record.</p>
            </div>
        </li>
    </ul>
</div>
@if(isset($response['data']['locations']))
    <?php
    $for_previous_link = $_GET;
    $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
    ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
    $convertPreviousToQueryString  = http_build_query($for_previous_link);
    $previousResult = URL('/get/location/by/City').'?'.$convertPreviousToQueryString;
    ?>
    <?php
    $totalPaginationValue = intval(ceil($response['data']['locationCount'] / config('constants.Pagination')));
    $for_next_link = $_GET;
    $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
    ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
    $convertToQueryString  = http_build_query($for_next_link);
    $nextResult = URL('/get/location/by/City').'?'.$convertToQueryString;
    ?>
    <ul class="pager">
        @if($totalPaginationValue !=0)
            <li><a href="{{$previousResult}}" class="previous"><span class="icon-bold-arrow-left"></span></a></li>
        @endif
        <?php
        $paginationValue = intval(ceil($response['data']['locationCount'] / config('constants.Pagination')));
        $query_str_to_array = $_GET;
        $current_page = (isset($query_str_to_array['page']))?$query_str_to_array['page']:1;
        for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
        $query_str_to_array['page'] = $i;
        $queryString  = http_build_query($query_str_to_array);
        $result = URL('/get/location/by/City').'?'.$queryString;
        ?>
        <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
        <?php }?>
        @if($totalPaginationValue !=0)
            <li><a href="{{$nextResult}}" class="next"><span class="icon-bold-arrow-right"></span></a></li>
        @endif
    </ul>
@endif
@endsection