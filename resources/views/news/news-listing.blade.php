@extends('admin')
@section('content')
<div class="news-listing">
        <div class="layout text-right"><a href="{{URL::to('news')}}" class="btn-hollow">Add a news</a></div>
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
                    <div class="pro-city border"><p>Title</p></div>
                    <div class="pro-priority border"><p>Description</p></div>
                    <div class="pro-date border"><p>Date</p></div>
                    <div class="pro-image border"><p>Image</p></div>
                    <div class="pro-controls border"><p>Controls</p></div>
                </li>
            @if(isset($response['data']['news']))
              @foreach($response['data']['news'] as $news)
                <li class="t-d text-center">
                    <div class="pro-id border">
                        <label for="property-id-td" class="customCheckbox">
                            <input type="checkbox" id="property-id-td">
                            <span class="fake-checkbox"></span>
                            <span class="fake-label">{{$news->id}}</span>
                        </label>
                    </div>
                    <div class="pro-city border"><p>{{$news->title}}</p></div>
                    <div class="pro-priority border text-left"><p>{{str_limit($news->description,20)}}</p></div>
                    <div class="pro-date border"><time>11/12/2015</time></div>
                    <div class="pro-image border"><img src=@if(isset($news->images[0]))"{{ url('/').'/'.$news->images[0]->image}}"@endif></div>
                    <div class="pro-controls border">
                        <ul class="control-link">
                            {{Form::open(array('url'=>'get/update/news/form','method'=>'POST','class'=>'rejectApprove-form'))}}
                            <input hidden name="news_id" value="{{$news->id}}">
                            <li class="active"><button type="submit"><span class="icon-update-arrows"></span>Update</button></li>
                            {{Form::close()}}
                            {{Form::open(array('url'=>'delete/news','method'=>'POST'))}}
                            <input hidden name="news_id" value="{{$news->id}}">
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
    </div>

    <?php
    $for_previous_link = $_GET;
    $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
    ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
    $convertPreviousToQueryString  = http_build_query($for_previous_link);
    $previousResult = URL('/maliksajidawan786@gmail.com/news/listing').'?'.$convertPreviousToQueryString;
    ?>
    <?php
    $totalPaginationValue = intval(ceil($response['data']['newsCount'] / config('constants.Pagination')));

    $for_next_link = $_GET;
    $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
    ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
    $convertToQueryString  = http_build_query($for_next_link);
    $nextResult = URL('/maliksajidawan786@gmail.com/news/listing').'?'.$convertToQueryString;
    ?>
    <ul class="pager">
        @if($totalPaginationValue !=0)
            <li><a href="{{$previousResult}}" class="previous"><span class="icon-bold-arrow-left"></span></a></li>
        @endif
        <?php
        $paginationValue = intval(ceil($response['data']['newsCount'] / config('constants.Pagination')));
        $query_str_to_array = $_GET;
        $current_page = (isset($query_str_to_array['page']))?$query_str_to_array['page']:1;
        for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
        $query_str_to_array['page'] = $i;
        $queryString  = http_build_query($query_str_to_array);
        $result = URL('/maliksajidawan786@gmail.com/news/listing').'?'.$queryString;
        ?>
        <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
        <?php }?>
        @if($totalPaginationValue !=0)
            <li><a href="{{$nextResult}}" class="next"><span class="icon-bold-arrow-right"></span></a></li>
        @endif
    </ul>

@endsection