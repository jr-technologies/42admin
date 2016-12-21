@extends('admin')
@section('content')
<div class="layout text-right"><a href="{{URL::to('banners')}}" class="btn-hollow">Add a Banner</a></div>
    <div class="banner-listing">
        <div class="table-responsive"><ul class="listing-pro">
            <li class="t-h text-upparcase text-center">
                <div class="pro-id border">
                    <label for="property-id" class="customCheckbox">
                        <input type="checkbox" id="property-id">
                        <span class="fake-checkbox"></span>
                        <span class="fake-label">ID</span>
                    </label>
                </div>
                <div class="pro-city border"><p>Page name</p></div>
                <div class="pro-priority border"><p>Type</p></div>
                <div class="pro-position border"><p>Position</p></div>
                <div class="pro-date border"><p>Date</p></div>
                <div class="pro-image border"><p>Image</p></div>
                <div class="pro-controls border"><p>Controls</p></div>
            </li>
            @if(isset($response['data']['banners']))
                @foreach($response['data']['banners'] as $banner)
            <li class="t-d text-center">
                <div class="pro-id border">
                    <label for="property-id-td" class="customCheckbox">
                        <input type="checkbox" id="property-id-td">
                        <span class="fake-checkbox"></span>
                        <span class="fake-label">{{$banner->id}}</span>
                    </label>
                </div>
                <div class="pro-city border"><p>{{$banner->page}}</p></div>
                <div class="pro-priority border"><p>{{$banner->bannerType}}</p></div>
                <div class="pro-position border"><time>{{$banner->position}}</time></div>
                <div class="pro-date border"><time>{{$banner->createdAt}}</time></div>
                <div class="pro-image border"><img src="{{url('/').'/'.$banner->image}}" width="100" height="100"></div>
                <div class="pro-controls border">
                    <ul class="control-link">
                        {{Form::open(array('url'=>'get/update/banner/form','method'=>'POST','class'=>'rejectApprove-form'))}}
                        <input hidden name="banner_id" value="{{$banner->id}}">
                        <li class="active" title="Update"><button><span class="icon-update-arrows"></span></span></button></li>
                        {{Form::close()}}
                        {{Form::open(array('url'=>'delete/banner','method'=>'POST'))}}
                        <input hidden name="banner_id" value="{{$banner->id}}">
                        <li class="deactive" title="Delete"><button><span class="icon-cross"></span></button></li>
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
        </ul></div>
    </div>
    <?php
    $for_previous_link = $_GET;
    $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
    ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
    $convertPreviousToQueryString  = http_build_query($for_previous_link);
    $previousResult = URL('/maliksajidawan786@gmail.com/banners/listing').'?'.$convertPreviousToQueryString;
    ?>
    <?php
    $totalPaginationValue = intval(ceil($response['data']['bannerCounts'] / config('constants.Pagination')));

    $for_next_link = $_GET;
    $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
    ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
    $convertToQueryString  = http_build_query($for_next_link);
    $nextResult = URL('/maliksajidawan786@gmail.com/banners/listing').'?'.$convertToQueryString;
    ?>
    <ul class="pager">
        @if($totalPaginationValue !=0)
            <li><a href="{{$previousResult}}" class="previous"><span class="icon-bold-arrow-left"></span></a></li>
        @endif
        <?php
        $paginationValue = intval(ceil($response['data']['bannerCounts'] / config('constants.Pagination')));
        $query_str_to_array = $_GET;
        $current_page = (isset($query_str_to_array['page']))?$query_str_to_array['page']:1;
        for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
        $query_str_to_array['page'] = $i;
        $queryString  = http_build_query($query_str_to_array);
        $result = URL('/maliksajidawan786@gmail.com/banners/listing').'?'.$queryString;
        ?>
        <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
        <?php }?>
        @if($totalPaginationValue !=0)
            <li><a href="{{$nextResult}}" class="next"><span class="icon-bold-arrow-right"></span></a></li>
        @endif
    </ul>

@endsection