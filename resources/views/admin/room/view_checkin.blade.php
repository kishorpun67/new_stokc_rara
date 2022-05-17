@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
        {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    <!-- Main content -->
      @error('category_id')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror  
      @error('name')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 
      @error('price')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror 
      @error('url')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
      @enderror   
      <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Checkin</h3>
              <a href="" data-toggle="modal" data-target="#myModals" style="max-width: 150px; float:right; display:inline-block;" class="btn btn-block btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Add Entry</a>
            </div>
            <div class="card-body">
              <table id="monthly-charts" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Room Type</th>
                  <th>Contact</th>
                  <th>Amount</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($checkins as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>
                        @if(!empty($item->roomType->room_type))
                        {{$item->roomType->room_type}}
                        @else
                        No Category
                        @endif
                    </td>
                    <td>{{$item->contact}}</td>
                    <td>{{$item->amount}}</td>
                    </td>
                    <td>
                    <a href=""data-toggle="modal" data-target="#myModal{{$item->id}}" > <i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                    <a href="javascript:" class="delete_form" record="item" rel="{{$item->id}}" style="display:inline;">
                        <i class="fa fa-trash fa-" aria-hidden="true" ></i>
                    </a>
                   </td>
                </tr>
                <div class="modal fade" id="myModal{{$item->id}}">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <form  method="POST"   action="{{route('admin.edit.checkin.room',$item->id)}}"  enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="class">Arrival Date</label>
                                    <input type="date" class="form-control" name="arrival_date" placeholder="" value="{{$item->arrival_date}}">
                                    <label for="class">Time</label>
                                    <input type="time" class="form-control" name="arrival_time" placeholder="" value="{{$item->arrival_time}}">
                                    <label for="class"> Departure Date</label>
                                    <input type="date" class="form-control" name="depature_date" placeholder="" value="{{$item->depature_date}}">
                                    <label for="class">Time</label>
                                    <input type="time" class="form-control" name="depature_time" placeholder="" value="{{$item->depature_time}}">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{$item->name}}">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Address" value="{{$item->address}}">
                                    <label for="name">Contact no</label>
                                    <input type="number" class="form-control" name="contact" placeholder="Contact" value="{{$item->contact}}">
                                    <label for="name">Pax</label>
                                    <select name="pax" id="" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Adult"
                                        @if(!empty($item->pax) && $item->pax=="Adult")
                                    selected
                                    @endif
                                        >Adult</option>
                                        <option value="Child"
                                        @if(!empty($item->pax) && $item->pax=="Child")
                                    selected
                                    @endif>Child</option>
                                    </select>
                                    <label for="name">Travel Agent</label>
                                    <select name="travel_agent"  class="form-control travel_agent">
                                        <option value="">Select</option>
                                        <option value="Self"
                                        @if(!empty($item->travel_agent) && $item->travel_agent=="Self")
                                    selected
                                    @endif
                                        >Self</option>
                                        <option value="Agent"
                                        @if(!empty($item->travel_agent) && $item->travel_agent=="Agent")
                                    selected
                                    @endif>Agent</option>
                                    </select>
                                    @if ($item->travel_agent == "Agent")
                                    <span class="agaent-names" >
                                      <label for="name"> Agent Name</label>
                                      <input type="text" name="agent_name" id="" class="form-control" placeholder="Agent Name" value="{{$item->agent_name}}">
                                  </span>
                                    @endif
                                    <label for="class"> Select Room type</label>
                                    <select name="room_type_id" id="" class="form-control">
                                        <option value="" >Select</option>
                                        @foreach($typeofRooms as $typeofRoom)
                                        <option value="{{$typeofRoom->id}}" 
                                            @if(!empty($item->room_type_id) && $item->room_type_id== $typeofRoom->id)
                                            selected
                                            @endif
                                            >{{$typeofRoom->room_type}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <label for="room_no">Room no</label>
                                    <input type="text" class="form-control" id="room_no" name="room_no" placeholder="Room No" value="{{$item->room_no}}">
                                    <label for="description">ID Card</label>
                                    <input type="file" name="id_card" class="form-control" id="">
                                    @if($item->id_card)
                                      <input type="hidden"  name="old_image" value="{{$item->id_card}}">
                                      <img src="{{asset($item->id_card)}}" height="200" width="400" alt="" srcset="">
                                    @endif
                                    <br>
                                    <label for="amount">Amount</label>
                                    <input type="text" class="form-control" id="room_no" name="amount" placeholder="Amount" value="{{$item->amount}}">
                                    <label for="aditional_charge">Aditional Charge</label>
                                    <input type="text" class="form-control" id="room_no" name="aditional_charge" placeholder="Aditional Charge" value="{{$item->additional_charge}}">
                                    <label for="discount">Discount</label>
                                    <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount"  value="{{$item->discount}}">
                                    <label for="advance">Advance</label>
                                    <input type="text" class="form-control" id="advance" name="advance" placeholder="Advance" value="{{$item->advance}}">
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                      </div>
                    </div>
                </div>
                @empty
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="modal fade" id="myModals">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form  method="POST"   action="{{route('admin.add.checkin.room')}}"  enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="class">Arrival Date</label>
                    <input type="date" class="form-control" name="arrival_date" placeholder="" required>
                    <label for="class">Time</label>
                    <input type="time" class="form-control" name="arrival_time" placeholder="" required>
                    <label for="class"> Departure</label>
                    <input type="date" class="form-control" name="depature_date" placeholder="" required>
                    <label for="class">Time</label>
                    <input type="time" class="form-control" name="depature_time" placeholder="" required>
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                    <label for="address">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Address" >
                    <label for="name">Contact no</label>
                    <input type="number" class="form-control" name="contact" placeholder="Contact" required>
                    <label for="name">Pax</label>
                    <select name="pax" id="" class="form-control" >
                        <option value="">Select</option>
                        <option value="adult">Adult</option>
                        <option value="child">Child</option>
                    </select>
                    <label for="name">Travel Agent</label>
                    <select name="travel_agent" id="" class="form-control travel_agent">
                        <option value="">Select</option>
                        <option value="self">Self</option>
                        <option value="Agent">Agent</option>
                    </select>
                    <span class="agaent-name" >
                        <label for="name">Agent Name</label>
                        <input type="text" name="agent_name" id="" class="form-control" placeholder="Agent Name" >
                    </span>
                    <label for="class"> Select Room type</label>
                    <select name="room_type_id" id="" class="form-control">
                        <option value="" >Select</option>
                        @forelse($typeofRooms as $typeofRoom)
                        <option value="{{$typeofRoom->id}}">{{$typeofRoom->room_type}}
                        </option>
                        @empty
                        @endforelse
                    </select>
                    <label for="room_no">Room no</label>
                    <input type="text" class="form-control" id="room_no" name="room_no" placeholder="Room No" >
                    <label for="description">ID Card</label>
                    <input type="file" name="id_card" class="form-control" id="">
                    <label for="amount">Amount</label>
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" >
                    <label for="aditional_charge">Aditional Charge</label>
                    <input type="text" class="form-control" id="room_no" name="aditional_charge" placeholder="Aditional Charge" >
                    <label for="discount">Discount</label>
                    <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount"  >
                    <label for="advance">Advance</label>
                    <input type="text" class="form-control" id="advance" name="advance" placeholder="Advance" >
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-success" value="Add">
            </div>
        </form>
      </div>
    </div>
</div>
@endsection