@extends('layouts.admin_layout.admin_layout')
@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
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
        <section class="content">

        <div class="container-fluid">
            <div class="card card-default">
                <form action="{{route('admin.checkout.user.bill', $checkinDetails->id)}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom: 30px">
                                            <label for="amount">Checkin Date</label>
                                            <p> {{$checkinDetails['arrival_time']}} {{$checkinDetails['arrival_date']}} </p>
                                        </div>
                                        <div class="form-group">
                                            <label for="class"> Departure Date</label>
                                            <input type="date" class="form-control" name="depature_date" placeholder="" value="{{$checkinDetails->depature_date}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="class">Time</label>
                                            <input type="time" class="form-control" name="depature_time" placeholder="" value="{{$checkinDetails->depature_time}}">
                                        </div>
                                        <div class="form-group">
                                        <label for="amount">Charge</label>
                                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Category Name"
                                        @if(!empty($checkinDetails['amount']))
                                        value= "{{$checkinDetails['amount']}}"
                                        @else value="{{old('amount')}}"
                                        @endif>
                                        </div>

                                    </div>   
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="amount">Additional Charge</label>
                                        <input type="text" class="form-control" name="additional_charge"  value="{{$checkinDetails['additional_charge']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Advance</label>
                                            <input type="text" class="form-control" name="advance"  value="{{$checkinDetails['advance']}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Additional Charge</label>
                                            <input type="text" class="form-control" name="discount"  value="{{$checkinDetails['discount']}}">
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Checkout</button>
                    </div>
                </form>
            </div>
            
            
            <div class="row">
           
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> {{$admins->hotel}}
                        <small class="float-right">Date: 2/10/2014</small>
                    </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>{{$admins->hotel}}</strong><br>
                        {{$admins->hotel_address}}<br>
                        Phone: (+977) {{$admins->hotel_contact}}<br>
                        Email: {{$admins->hotel_email}}
                    </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                    To
                    <address>
                        <strong>{{$checkinDetails->name}}</strong><br>
                        {{$checkinDetails->address}}<br>
                        Phone: (+977) {{$checkinDetails->contact}}<br>
                        {{-- Email: {{$checkinDetails->}} --}}
                    </address>
                    </div>
                    
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                        <th>S.N.</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Charges</th>
                        <th>Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                        <td>1</td>
                        <td>{{$checkinDetails->created_at}}</td>
                        <td>Room Charge</td>
                        <td>{{$checkinDetails->amount}}</td>
                        <td>{{$checkinDetails->amount}}</td>
                        </tr>
                        <tr>
                        <td>2</td>
                        <td>{{$checkinDetails->created_at}}</td>
                        <td>Additional Charge</td>
                        <td>{{$checkinDetails->additional_charge}}</td>
                        <td>{{$checkinDetails->additional_charge}}</td>
                        </tr>
                        <tr>
                        <td>3</td>
                        <td>{{$checkinDetails->created_at}}</td>
                        <td>Advance</td></td>
                        <td>{{$checkinDetails->advance}}</td>
                        <td>{{$checkinDetails->advance}}</td>
                        </tr>
                        <tr>
                        <td>4</td>
                        <td>{{$checkinDetails->created_at}}</td>
                        <td>Discount</td>
                        <td>{{$checkinDetails->discount}}</td>
                        <td>{{$checkinDetails->discount}}</td>
                        </tr>
                        
                        </tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                    {{-- <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem --}}
                        {{-- plugg
                        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p> --}}
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                    <p class="lead">Amount Due 2/22/2014</p>

                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td>{{$checkinDetails->additional_charge + $checkinDetails->amount -  $checkinDetails->discount}}</td>
                        </tr>
                        {{-- <tr>
                            <th>Tax (9.3%)</th>
                            <td>$10.34</td>
                        </tr>
                        <tr>
                            <th>Shipping:</th>
                            <td>$5.80</td>
                        </tr> --}}
                        <tr>
                            <th>Total:</th>
                            <td>{{$checkinDetails->additional_charge + $checkinDetails->amount -  $checkinDetails->discount}}</td>
                        </tr>
                        </table>
                    </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                    <a href="" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                        Payment
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                    </button>
                    </div>
                </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
    <!-- /.content -->
  </div>
  @endsection