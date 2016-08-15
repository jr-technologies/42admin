@extends('admin.admin2')
@section('content')

    <style>
        table, th, td {
            border: 1px solid black;

        }
    </style>
    <div style="max-width: 1200px; margin: 0 0 0 -200px; position: relative; left: 35%;">
        <table style="width:50%">
            <tr>
                    <th>Search Users</th>
            </tr>
            <tr>
                {{Form::open(array('url'=> 'get/users','method'=>'POST','class'=>'rejectApprove-form'))}}
                <td>
                    <label>Email</label>
                    <input type="text" name="email" value="" placeholder="please Enter email"><br /><br />
                </td>
                <td>
                    <label>Phone Number</label>
                    <input type="text" name="phone" value="" placeholder="please Enter phone"><br /><br />
                </td>
                <td>
                    <label>First Name</label>
                    <input type="text" name="fname" value="" placeholder="please Enter Name"><br /><br />
                </td>
                <td>
                    <label>Last Name</label>
                    <input type="text" name="lname" value="" placeholder="please Enter Name"><br /><br />
                </td>

                <td>
                    <label>Limit</label>
                    <input type="text" name="limit" value="" placeholder="please Enter Limit"><br /><br />
                </td>
                <td>
                    <label>Type</label>
                    <select name="type">
                        @foreach($response['data']['roles'] as $roles)
                            <option value="">Please Select Role</option>
                        <option value="{{$roles->id}}">{{$roles->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit">Search User</button>
                </td>

            </tr>
            {{Form::close()}}
        </table>
    </div>

    <div style="max-width: 1200px; margin: 0 0 0 -200px; position: relative; left: 50%;">
        <table style="width:50%">
            @if(isset($response['data']['users']))
              <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Type</th>
                <th>Action</th>
                  </tr>


                @foreach($response['data']['users'] as $user)
                <tr>

                    <td>{{(isset($user->id))?$user->id:''}}</td>
                    <td>{{(isset($user->fName))?$user->fName.' '.$user->lName:''}}</td>
                    <td>{{(isset($user->roles[0]->name))?$user->roles[0]->name:''}}</td>
                    <td>
                        {{Form::open(array('url'=>'delete/blocks','method'=>'POST','class'=>'rejectApprove-form'))}}
                        <input hidden name="block_id" value="{{isset($user->id)}}">
                        <button><span type="submit" ></span>Delete</button>
                        {{Form::close()}}
                        {{Form::open(array('url'=>'get/update/block/form','method'=>'POST','class'=>'rejectApprove-form'))}}
                        <input hidden name="block_id" value="{{isset($user->id)}}">
                        <button><span type="submit" ></span>Update</button>
                        {{Form::close()}}
                    </td>
                </tr>
                @endforeach
                 @endif
        </table>
    </div>


@endsection