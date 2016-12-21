@extends('admin')
@section('content')
    <div class="agents-listing-page">
        <a class="property-status-links-opener"><span class="text-container">active</span><span class="lines"></span></a>
        <ul class="property-status-links">
            <li @if(($response['data']['linkStatus']) == 'active') class="active" @endif><a href="{{URL::to('get/active/agent')}}" class="active">ACTIVE <span class="number">{{(isset($response['data']['agentCounts'][1]))?$response['data']['agentCounts'][1][0]->totalAgents:0}}</span></a></li>
            <li @if(($response['data']['linkStatus']) == 'pending')class="active" @endif><a href="{{URL::to('get/pending/agent')}}" class="pending">pending <span class="number">{{(isset($response['data']['agentCounts'][0]))?$response['data']['agentCounts'][0][0]->totalAgents:0}}</span></a></li>
            {{--<li ><a href="" class="rejected">rejected <span class="number">0</span></a></li>--}}
            {{--<li ><a href="" class="expired">expired <span class="number">0</span></a></li>--}}
            {{--<li ><a href="{{URL::to('get/deleted/agent')}}" class="deleted">deleted <span class="number">0</span></a></li>--}}
        </ul>
        <ul class="sorting-filtering">
            <li>
            <span class="fake-select">
                <select id="sort-by">
                    <option>ID</option>
                    <option>ID</option>
                    <option>ID</option>
                    <option>ID</option>
                </select>
            </span>
            </li>
            <li>
            <span class="fake-select">
                <select id="order-by">
                    <option>Ascending</option>
                </select>
            </span>
            </li>
            <li>
            <span class="fake-select">
                <select id="view-by">
                    <option>20</option>
                    <option>20</option>
                    <option>20</option>
                </select>
            </span>
            </li>
            <li>
            <span class="fake-select">
                <select id="view-by">
                    <option>20</option>
                    <option>20</option>
                    <option>20</option>
                </select>
            </span>
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
                    <div class="pro-name border"><p>Name</p></div>
                    <div class="pro-email border"><p>Email</p></div>
                    <div class="pro-address border"><p>Address</p></div>
                    <div class="pro-date border"><p>Date</p></div>
                    <div class="pro-role border"><p>Roles</p></div>
                    <div class="pro-controls border"><p>Controls</p></div>
                </li>
                @foreach($response['data']['agents'] as $agent)
                    <li class="t-d text-center">
                        <div class="pro-id border">
                            <label for="agent.{{$agent->id}}" class="customCheckbox">
                                <input class="agent_checkbox" type="checkbox" name="deleteMultiple[]" value="{{$agent->id}}" id="agent.{{$agent->id}}">
                                <span class="fake-checkbox"></span>
                                <span class="fake-label">{{$agent->id}}</span>
                            </label>
                        </div>
                        <div class="pro-name border"><p>{{$agent->fName.' '.$agent->lName}}</p></div>
                        <div class="pro-email border"><p>{{$agent->email}}</p></div>
                        <div class="pro-address border"><address>{{$agent->address}}.</address></div>
                        <div class="pro-date border"><time>{{$agent->createdAt}}</time></div>
                        <div class="pro-role border">
                            @foreach($agent->roles as $role)
                                <span class="p-role">{{$role->name}}</span>
                            @endforeach
                        </div>
                        <?php
                            $images = url('/') . "/assets/imgs/no.png";
                            if ($agent->agencies != null) {
                                if ($agent->agencies[0]->logo != null) {
                                    $images = url('/') . '/temp/' . $agent->agencies[0]->logo;
                                }
                            }
                        ?>
                       <div class="pro-controls border"></div>
                        <div class="fullDetail_ui text-left">
                            <div class="person-pic-holder">
                                <a href="#"><img src="{{$images}}" alt="image description"></a>
                            </div>
                            <div class="description">
                                <div class="layout">
                                    <strong class="heading">{{$agent->fName.' '.$agent->lName}}</strong>
                                    @if((sizeof($agent->agencies)) > 0)
                                        <p>{{str_limit($agent->agencies[0]->description,350)}}.</p>
                                    @endif
                                </div>
                                <ul class="control-link">
                                    @if(($agent->trustedAgent) == 1)
                                        {{Form::open(array('url'=>'make/agent/deActive','method'=>'POST'))}}
                                        <input hidden name="agent_id" value="{{$agent->id}}">
                                        <li><button type="submit"><span class="icon-cross" ></span>DeActive</button></li>
                                        {{Form::close()}}

                                        {{Form::open(array('url'=>'set/priority','method'=>'POST'))}}
                                        <input hidden name="agent_id" value="{{$agent->id}}">
                                        <li>
                                            <div class="layout">
                                                <input type="text" name="priority">
                                                <button type="submit">Submit</button>
                                            </div>
                                        </li>
                                        {{Form::close()}}
                                    @endif
                                    @if(($agent->trustedAgent) == 0)
                                        {{Form::open(array('url'=>'make/agent/active','method'=>'POST'))}}
                                        <input hidden name="agent_id" value="{{$agent->id}}">
                                        <li><button><span class="icon-tick"></span>Active</button></li>
                                        {{Form::close()}}

                                    @endif

                                    {{--{{Form::open(array('url'=>'agent/delete','method'=>'POST'))}}--}}
                                    {{--<input hidden name="agent_id" value="{{$agent->id}}">--}}
                                    {{--<li><button type="submit"><span class="icon-reject-thunder" type="submit"></span>Delete</button></li>--}}
                                    {{--{{Form::close()}}--}}
                                </ul>
                            </div>
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
        <?php

        $for_previous_link = $_GET;
        $first_page="";
        if($response['data']['linkStatus'] == 'active')
        {
            $first_page = URL('/get/active/agent');
        }
        elseif($response['data']['linkStatus'] == 'pending')
        {
            $first_page = URL('/get/pending/agent');
        }
        $start_page =$first_page.'?'.'page=1';
        $pageValue = (isset($for_previous_link['page']))?$for_previous_link['page']:1;
        ($pageValue ==1)?$for_previous_link['page'] = $pageValue:$for_previous_link['page'] = $pageValue-1;
        $convertPreviousToQueryString  = http_build_query($for_previous_link);
        $previousResult = $first_page.'?'.$convertPreviousToQueryString;
        ?>
        <?php
        $totalPaginationValue = intval(ceil($response['data']['agentCount'] / config('constants.Pagination')));
        $last_page = $first_page.'?'.'page='.$totalPaginationValue;
        $for_next_link = $_GET;
        $pageValue = (isset($for_next_link['page']))?$for_next_link['page']:1;
        ($pageValue == $totalPaginationValue)?$for_next_link['page'] = $pageValue:$for_next_link['page'] = $pageValue+1;
        $convertToQueryString  = http_build_query($for_next_link);
        $nextResult = $first_page.'?'.$convertToQueryString;
        ?>
        <ul class="pager">

            <li><a href="{{$start_page}}" class="first"><span class="icon-arrow1-left"></span></a></li>
            @if($totalPaginationValue !=0)
                <li><a href="{{$previousResult}}" class="previous"><span class="icon-bold-arrow-left"></span></a></li>
            @endif
            <?php
            $paginationValue = intval(ceil($response['data']['agentCount'] / config('constants.Pagination')));
            $query_str_to_array = $_GET;
            $current_page = (isset($query_str_to_array['page']))?$query_str_to_array['page']:1;
            for($i = (($current_page-3 > 0)?$current_page-3:1); $i <= (($current_page + 3 <= $paginationValue)?$current_page+3:$paginationValue);$i++){
            $query_str_to_array['page'] = $i;
            $queryString  = http_build_query($query_str_to_array);
            $result = $first_page.'?'.$queryString;
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