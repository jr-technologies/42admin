@extends('admin')
@section('content')
<div class="property-listing-page">
    <a class="property-status-links-opener"><span class="text-container">active</span><span class="lines"></span></a>
    <ul class="property-status-links">
        <li @if(isset($response['data']['linkStatus']) && ($response['data']['linkStatus']) == 'active') class="active" @endif><a href="{{URL::to('get/active/property')}}" class="active">ACTIVE <span class="number">{{$response['data']['totalPropertiesCounts'][5]}}</span></a></li>
        <li @if(isset($response['data']['linkStatus']) &&($response['data']['linkStatus']) == 'pending')class="active" @endif><a href="{{URL::to('get/pending/property')}}" class="pending">pending <span class="number">{{$response['data']['totalPropertiesCounts'][10]}}</span></a></li>
        <li @if(isset($response['data']['linkStatus']) &&($response['data']['linkStatus']) == 'rejected')class="active" @endif><a href="{{URL::to('get/rejected/property')}}" class="rejected">rejected <span class="number">{{$response['data']['totalPropertiesCounts'][15]}}</span></a></li>
        <li @if(isset($response['data']['linkStatus']) &&($response['data']['linkStatus']) == 'expire')class="active" @endif><a href="{{URL::to('get/expired/property')}}" class="expired">expired <span class="number">{{$response['data']['totalPropertiesCounts'][20]}}</span></a></li>
        <li @if(isset($response['data']['linkStatus']) &&($response['data']['linkStatus']) == 'expire')class="active" @endif><a href="{{URL::to('get/deleted/property')}}" class="deleted">deleted <span class="number">{{$response['data']['totalPropertiesCounts'][25]}}</span></a></li>
    </ul>
    <ul class="sorting-filtering">
        <li>
            <label for="sort-by">Sort By</label>
            <div class="input-holder">
                <span class="fake-select">
                    <select name="sort_by" id="sort">
                        <option value='' selected >Default Order</option>
                        <option value='price_asc' @if(isset($response['data']['oldValues']) && ($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'price_asc') selected @endif>Price Low to High</option>
                        <option value='price_desc' @if(isset($response['data']['oldValues']) &&($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'price_desc') selected @endif>Price High to Low</option>
                        <option value='land_asc' @if(isset($response['data']['oldValues']) &&($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'land_asc') selected @endif>Area Low to High</option>
                        <option value='land_desc' @if(isset($response['data']['oldValues']) &&($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'land_desc') selected @endif>Area High to Low</option>
                        {{--<option value='date_desc' @if(($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'date_desc') selected @endif>Date New to Old</option>--}}
                        {{--<option value='date_asc' @if(($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'date_asc') selected @endif>Date Old to New</option>--}}
                        {{--<option value='verified_desc' @if(($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'verified_desc') selected @endif>Verified Only</option>--}}
                        {{--<option value='picture_desc' @if(($response['data']['oldValues']['sortBy'].'_'.$response['data']['oldValues']['order']) == 'picture_desc') selected @endif>With Photos</option>--}}
                    </select>
                </span>
            </div>
        </li>
        <li>
            <label for="order-by">Order</label>
            <div class="input-holder">
                <span class="fake-select">
                    <select id="order-by">
                        <option>Ascending</option>
                    </select>
                </span>
            </div>
        </li>
        <li>
            <label for="order-by">Select User</label>
            <div class="input-holder">
                {{Form::open(array('url'=>'get-properties-by-User','action'=>'post'))}}
                   <select name="user_id" class="js-example-basic-single" id="select-user">
                     @foreach($response['data']['users'] as $user)
                        <option value="{{$user->id}}">{{$user->fName.' '.$user->lName}}</option>
                     @endforeach
                  </select>
                <button type="submit">Go</button>
               {{Form::close()}}
            </div>
        </li>
    </ul>
    <ul class="multipal-actions">
        <li><a href="#" class="multipal-delete"><span class="icon-bin-delete"></span></a></li>
    </ul>
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
                <div class="pro-type border"><p>TYPE</p></div>
                <div class="pro-location border"><p>LOCATION</p></div>
                <div class="pro-price border"><p>PRICE (Pkr)</p></div>
                <div class="pro-size border"><p>Size</p></div>
                <div class="pro-date border"><p>Date</p></div>
                <div class="pro-controls border"><p>Controls</p></div>
            </li>
            @foreach($response['data']['properties'] as $property)
            <li class="t-d text-center">
                <div class="pro-id border">
                    <label for="property{{$property->id}}" class="customCheckbox">
                        <input type="checkbox" name="multiPulIds[]" value="{{$property->id}}" id="property{{$property->id}}">
                        <span class="fake-checkbox"></span>
                        <span class="fake-label">{{$property->id}}</span>
                    </label>
                </div>
                <div class="pro-type border"><p>{{$property->type->subType->name}}</p></div>
                <div class="pro-location border"><p>{{$property->location->location->location}}</p></div>
                <div class="pro-price border"><p>{{App\Libs\Helpers\PriceHelper::numberToRupees($property->price)}}</p></div>
                <div class="pro-size border"><p>{{$property->land->area.' '.$property->land->unit->name}}</p></div>
                <div class="pro-date border"><p>{{$property->createdAt}}</p></div>
                <div class="pro-controls border"></div>
                <div class="fullDetail_ui text-left">
                    <div class="listing-imageSlider">
                        <div class="mask">
                            <div class="slideset">
                                <?php

                                $count = 0;
                                $betweenCountIndex=0;
                                $image = url('/')."/assets/imgs/no.png";
                                $count++
                                ?>
                                @if(sizeof($property->documents) > 0)
                                    @foreach($property->documents as $document)
                                        <div class="slide">
                                            <a href="property?propertyId={{$property->id}}">
                                                @if($document->type == 'image'  && $document->path != "")
                                                    <img src="{{ url('/').'/temp/'.$document->path}}" alt="image description">
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                    @else
                                        <div class="slide">
                                            <a href="property?propertyId={{$property->id}}">
                                                <img src="{{$image}}" alt="image description">
                                            </a>
                                        </div>
                                    @endif
                            </div>
                        @if(sizeof($property->documents) > 0)
                            <a href="#" class="btn-prev"><span class="icon-keyboard_arrow_left"></span></a>
                            <a href="#" class="btn-next"><span class="icon-keyboard_arrow_right"></span></a>
                        @endif
                        </div>
                    </div>
                    <div class="description">
                        <div class="layout">
                            <a href="property?propertyId={{$property->id}}"><strong class="heading">{{ ''.$property->land->area.' '.$property->land->unit->name .' '}}{{$property->type->subType->name.' '.                                                (($property->wanted)?'required ':''). $property->purpose->name.'
                                  in '.$property->location->location->location." ".'('.$property->location->city->name.')'}}</strong></a>
                            <p>{{str_limit($property->description,348) }}</p>
                        </div>
                        <ul class="control-link">
                            @if($property->propertyStatus->id == 5)
                                {{Form::open(array('url'=>'property/deActive','method'=>'POST'))}}
                                <input hidden name="propertyId" value="{{$property->id}}">
                                <li><button type="submit"><span class="icon-cross" ></span>DeActive</button></li>
                                {{Form::close()}}
                            @endif
                            @if($property->propertyStatus->id == 20 || ($property->propertyStatus->id == 10))
                                {{Form::open(array('url'=>'property/approve','method'=>'POST'))}}
                                <input hidden name="propertyId" value="{{$property->id}}">
                                <li><button><span class="icon-tick"></span>Active</button></li>
                                {{Form::close()}}

                            @endif
                            @if(($property->propertyStatus->id == 5) || ($property->propertyStatus->id == 10))
                                    {{Form::open(array('url'=>'property/reject','method'=>'POST'))}}
                                    <input hidden name="propertyId" value="{{$property->id}}">
                                    <li><button type="submit"><span class="icon-reject-thunder" type="submit"></span>Reject</button></li>
                                    {{Form::close()}}

                            @endif
                            @if( ($property->propertyStatus->id == 15) || ($property->propertyStatus->id == 20))
                                {{Form::open(array('url'=>'property/delete','method'=>'POST'))}}
                                     <input hidden name="propertyId" value="{{$property->id}}">
                                    <li><button type="submit"><span class="icon-reject-thunder" type="submit"></span>SoftDelete</button></li>
                                {{Form::close()}}
                            `{{Form::open(array('url'=>'property/deActive','method'=>'POST'))}}
                                    <input hidden name="propertyId" value="{{$property->id}}">
                                    <li><button type="submit"><span class="icon-cross" ></span>DeActive</button></li>
                                    {{Form::close()}}
                            @endif
                            @if($property->propertyStatus->id == 25)
                                {{Form::open(array('url'=>'property/deleted','method'=>'POST'))}}
                                <input hidden name="propertyId" value="{{$property->id}}">
                                <li><button type="submit"><span class="icon-reject-thunder" type="submit"></span>ForceDelete</button></li>
                                {{Form::close()}}
                                    {{Form::open(array('url'=>'property/deActive','method'=>'POST'))}}
                                    <input hidden name="propertyId" value="{{$property->id}}">
                                    <li><button type="submit"><span class="icon-cross" ></span>DeActive</button></li>
                                    {{Form::close()}}
                            @endif
                        </ul>
                    </div>
                </div>
            </li>
           @endforeach
        </ul>
    </div>
    <?php

    $for_previous_link = $_GET;
    $first_page =URL('/get/active/property').'?'.'page=1';
    $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
    ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
    $convertPreviousToQueryString  = http_build_query($for_previous_link);
    $previousResult = URL('/get/active/property').'?'.$convertPreviousToQueryString;
    ?>
    <?php
    $totalPaginationValue = intval(ceil($response['data']['propertiesCount'] / config('constants.Pagination')));
    $last_page = URL('/get/active/property').'?'.'page='.$totalPaginationValue;
    $for_next_link = $_GET;
    $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
    ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
    $convertToQueryString  = http_build_query($for_next_link);
    $nextResult = URL('/get/active/property').'?'.$convertToQueryString;
    ?>
    <ul class="pager">

        <li><a href="{{$first_page}}" class="first"><span class="icon-arrow1-left"></span></a></li>
        @if($totalPaginationValue !=0)
            <li><a href="{{$previousResult}}" class="previous"><span class="icon-bold-arrow-left"></span></a></li>
        @endif
        <?php
        $paginationValue = intval(ceil($response['data']['propertiesCount'] / config('constants.Pagination')));
        $query_str_to_array = $_GET;
        $current_page = (isset($query_str_to_array['page']))?$query_str_to_array['page']:1;
        for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
        $query_str_to_array['page'] = $i;
        $queryString  = http_build_query($query_str_to_array);
        $result = URL('/get/active/property').'?'.$queryString;
        ?>
        <li @if($current_page == $i)class="active" @endif><a href="{{$result}}">{{$i}}</a></li>
        <?php }?>
        @if($totalPaginationValue !=0)
            <li><a href="{{$nextResult}}" class="next"><span class="icon-bold-arrow-right"></span></a></li>
        @endif
        <li><a href="{{$last_page}}" class="last"><span class="icon-arrow1-right"></span></a></li>
    </ul>
</div>
@endsection()