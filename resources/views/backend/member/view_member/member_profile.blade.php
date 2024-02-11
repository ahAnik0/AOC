@extends('backend.app')
@section('title','Member Profile')
@push('css')
<style  nonce="{{ csp_nonce() }}">
    .css_1{
        display: block;
    }
</style>
@endpush
@section('main_menu','Member')
@section('active_menu','Member Profile')
@section('content')
    <div class="user-profile social-app-profile">
        <div class="row">
            @if(!check_user_data_valid($member->id))
                <div class="alert alert-danger" role="alert">
                    <p>Client Information not completed.plz correct it</p>
                </div>
            @endif
            <div class="col-sm-12 box-col-12">
                <div class="card">
                    <div class="social-tab css_1" >
                        <ul class="nav nav-tabs" id="top-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="top-timeline" data-bs-toggle="tab" href="#timeline" role="tab" aria-controls="timeline">Timeline</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" id="top-relationship" data-bs-toggle="tab" href="#relationship" role="tab" aria-controls="relationship"
                                                    aria-selected="false">Relationship</a></li>
                            <li class="nav-item"><a class="nav-link" id="top-relationship" data-bs-toggle="tab" href="#bill_payment" role="tab" aria-controls="relationship"
                                                    aria-selected="false">Bill payment</a></li>
                            <li class="nav-item"><a class="nav-link" id="top-relationship" data-bs-toggle="tab" href="#payment_history" role="tab" aria-controls="payment_history"
                                                    aria-selected="false">Payment History</a></li>
                            <li class="nav-item"><a class="nav-link" id="top-photos" data-bs-toggle="tab" href="#change_password" role="tab" aria-controls="change_password"
                                                    aria-selected="false">Password
                                    Change</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="default-according style-1 faq-accordion job-accordion">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="p-0">
                                <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon2" aria-expanded="true" aria-controls="collapseicon2">About Member
                                </button>
                            </h5>
                        </div>
                        <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2" data-parent="#accordion">
                            <div class="card-body post-about">
                                <div class="media"><img class="rounded-circle me-3" src="{{asset('uploads/member_Photograph/'.$member->photo)}}" alt="Generic
                                placeholder image" height="100px">
                                    <div class="media-body align-self-center"><a href="#">
                                            <h5 class="user-name">{{$member->fullname}}</h5></a>
                                        <h6>{{$member->member_id_inputed}}</h6>
                                    </div>
                                </div>
                                <hr>
                                <ul>
                                    <li>
                                        <div class="icon"><i data-feather="user-check"></i></div>
                                        <div>
                                            <h5>Member ID</h5>
                                            <p>{{$member->member_id_inputed}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="user-check"></i></div>
                                        <div>
                                            <h5>Badge Number</h5>
                                            <p>{{$member->badge_number}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="tag"></i></div>
                                        <div>
                                            <h5>Rank / Designation</h5>
                                            <p>{{$member->designation->name}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="phone"></i></div>
                                        <div>
                                            <h5>Phone</h5>
                                            <p>{{$member->phone}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="map-pin"></i></div>
                                        <div>
                                            <h5>Address</h5>
                                            <p>{{$member->address}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="droplet"></i></div>
                                        <div>
                                            <h5>Blood group</h5>
                                            <p>{{$member->blood_group->name}}</p>
                                        </div>
                                    </li>
                                </ul>
                                <div class="social-network theme-form">
                                    <a class="btn social-btn btn-fb mb-2 text-center" href="{{route('admin.member/id_card_front',$member->id)}}" target="_blank">Print ID Card - Front
                                    </a>
                                    <a class="btn social-btn btn-fb mb-2 text-center" href="{{route('admin.member/id_card_back',$member->id)}}" target="_blank">Print ID Card - Back
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-9">
                <div class="tab-content" id="top-tabContent">
                    <div class="tab-pane fade active show" id="timeline" role="tabpanel" aria-labelledby="timeline">
                        <div class="card card-absolute">
                            <div class="card-header bg-secondary">
                                <h5 class="text-white">Member Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="box">
                                    <div class="box-body no-padding">
                                        <table class="table table-condensed border">
                                            <tbody>
                                            <tr>
                                                <td>#.</td>
                                                <td>Member ID:</td>
                                                <td><b>{{$member->member_id_inputed}}</b></td>
                                                
                                                <td>#.</td>
                                                <td>BA No:</td>
                                                <td><b>{{$member->ba_no}}</b></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>#.</td>
                                                <td>Full Name:</td>
                                                <td><b>{{$member->fullname}}</b>
                                                </td>
                                                
                                                <td>#.</td>
                                                <td>Rank/Designation:</td>
                                                <td><b>{{$member->designation->name}}</b>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>#.</td>
                                                <td>Address:</td>
                                                <td><b>{{$member->address}}</b>
                                                </td>
                                                
                                                <td>#.</td>
                                                <td>Phone:</td>
                                                <td><b>{{$member->phone}}</b>
                                                </td>
                                            
                                            </tr>
                                            
                                            <tr>
                                                <td>#.</td>
                                                <td>Email:</td>
                                                <td><b>{{$member->email}}</b></td>
                                                
                                                <td>#.</td>
                                                <td>Emergency Contact:</td>
                                                <td><b>{{$member->emergency_contact_no}}</b>
                                                </td>
                                            
                                            </tr>
                                            
                                            <tr>
                                                <td>#.</td>
                                                <td>Blood Group:</td>
                                                <td><b>{{$member->blood_group_id}}</b>
                                                </td>
                                                
                                                <td>#.</td>
                                                <td>Parent Member:</td>
                                                <td><b>{{$member->parent_member_id? $member->parent_member->name:''}}</b></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>#.</td>
                                                <td>Relationship:</td>
                                                <td><b>{{$member->parent_member_id? $member->relationship->name:''}}</b>
                                                </td>
                                                
                                                <td>#.</td>
                                                <td>RFID:</td>
                                                <td><b>{{$member->rfid}}</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#.</td>
                                                <td>Badge Number:</td>
                                                <td><b>{{$member->badge_number}}</b>
                                                </td>
                                                
                                                <td>#.</td>
                                                <td>RFID 2:</td>
                                                <td><b>{{$member->rfid2}}</b>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td>#.</td>
                                                <td>Date of birth:</td>
                                                <td width="100px"><b></b>{{\Carbon\Carbon::parse($member->dob)->format('F d, Y')}}</td>
                                                
                                                <td>#.</td>
                                                <td>Status</td>
                                                <td>
                                                    <b class="right badge badge-{{$member->status == 1?"success":"danger"}}">{{$member->status == 1?"Active":"Inactive"}}</b>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                
                                                <td class="bg-secondary">#.</td>
                                                <td class="bg-secondary">Issue date:</td>
                                                <td class="bg-secondary" width="35%"><b>{{\Carbon\Carbon::parse($member->issue_date)->format('F d, Y')}}</b>
                                                </td>
                                                
                                                <td class="bg-success">#.</td>
                                                <td class="bg-success">Last Payment Date:</td>
                                                <td class="bg-success"><b>{{$member->connection_to?\Carbon\Carbon::parse($member->connection_to)->format('F d, Y'):'Not Inputted'}}</b>
                                                </td>
                                            
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="relationship" role="tabpanel" aria-labelledby="relationship">
                        <div class="card card-absolute">
                            <div class="card-header bg-secondary">
                                <h5 class="text-white">Relations</h5>
                            </div>
                            <div class="card-body">
                                <div class="box">
                                    <div class="box-body no-padding">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Full name</th>
                                                    <th scope="col">Member ID</th>
                                                    <th scope="col">BA no</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Relation</th>
                                                    <th scope="col">Blood Group</th>
                                                    <th scope="col">DOB</th>
                                                    <th scope="col">RFID</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($relation as $key=>$data)
                                                    <tr>
                                                        <th scope="row">{{$key+1}}</th>
                                                        <td>{{$data->fullname}}</td>
                                                        <td>{{$data->member_id_inputed}}</td>
                                                        <td>{{$data->ba_no}}</td>
                                                        <td>{{$data->phone}}</td>
                                                        <td>{{$data->relationship->name}}</td>
                                                        <td>{{$data->blood_group->name}}</td>
                                                        <td>{{\Carbon\Carbon::parse($data->dob)->format('m d, Y')}}</td>
                                                        <td>{{$data->rfid}}</td>
                                                        <td>
                                                            <a href="{{route('admin.member/id_card_front',$data->id)}}" class="btn btn-outline-success btn-xs" target="_blank">Print-Front</a>
                                                            <a href="{{route('admin.member/id_card_back',$data->id)}}" class="btn btn-outline-success btn-xs" target="_blank">Print-Back</a>
                                                            <a class="btn btn-outline-danger btn-xs " type="button" href="{{route("admin.member/relational_member_edit",$data->id)}}">Edit</a>
                                                            <a class="btn btn-outline-danger btn-xs " type="button"
                                                               href="{{route("admin.member/delete_relational_member",$data->id)}}">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="bill_payment" role="tabpanel" aria-labelledby="bill_payment">
                        <div class="card card-absolute">
                            <div class="card-header bg-secondary">
                                <h5 class="text-white">Bill payment</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.member/manual_bill_payment',$member->id)}}" method="post">
                                    @csrf
                                    <div class="box">
                                        <div class="box-body p-3">
                                            <div class="alert alert-primary dark bold" role="alert">
                                                <p>Last Payment Date: {{$member->connection_to?\Illuminate\Support\Carbon::parse($member->connection_to)->format('M d, Y'):''}}</p>
                                                <p>Total Due: {{$total_due}} Month or {{$total_due?$total_due*200:''}} TK</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="col-form-label required">Payment Date</label>
                                                <input type="date" name="pay_date" class="form-control input-lg" readonly value="<?php echo date('Y-m-d'); ?>"/>
                                            </div>

                                            <div class="mb-3">
                                                <label class="col-form-label required">Payment Type</label>
                                                <select id="selectOption" name="pay_type" class="form-control input-lg">
                                                    <option value="0">Cash</option>
                                                    <option value="1">Cheque</option>
                                                  </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="col-form-label ">Cheque No.</label>
                                                <input type="text" name="chq_no" class="form-control input-lg" >
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="col-form-label required">Amount</label>
                                                <input type="number" name="amount" class="form-control input-lg" value="{{$total_due?$total_due*200:''}}"/>
                                            </div>
                                            
                                            {{-- <button class="btn btn-success" type="submit" onclick="return confirm('Are you Sure to Save !!')"><a href="{{route('admin.member/payment_receipt_print',$member->id)}}" style="color: white;">Save</a></button> --}}
                                            <button class="btn btn-success" type="submit"  onclick="return confirm('Are you Sure to Save !!')">Save</button>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="payment_history" role="tabpanel" aria-labelledby="payment_history">
                        <div class="card card-absolute">
                            <div class="card-header bg-secondary">
                                <h5 class="text-white">Payment History</h5>
                            </div>
                            <div class="card-body">
                                <div class="box">
                                    <div class="box-body no-padding">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">payment Date</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Print</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($payment_history as $key=>$data)
                                                    <tr>
                                                        <th scope="row">{{$key+1}}</th>
                                                        <td>{{\Illuminate\Support\Carbon::parse($data->created_at)->format('M d, Y')}}</td>
                                                        <td>{{$data->credit}}</td>
                                                        <td><a class="btn btn-success btn-fb mb-2 text-center" href="{{route('admin.member/member_receipt_print',$data->id_payment_key)}}" target="_blank">Print Receipt
                                                        </a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="change_password" role="tabpanel" aria-labelledby="change_password">
                        <div class="card card-absolute">
                            <div class="card-header bg-secondary">
                                <h5 class="text-white">Change Password</h5>
                            </div>
                            <div class="card-body">
                                <div class="box">
                                    <div class="box-body no-padding">
                                        <form method="POST" action="{{route('admin.member/change_member_password',$member->id)}}">
                                            @csrf
                                            <br>
                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password <small class="text-danger">(Password needs to have at least 8
                                                        characters)
                                                    </small></label>
                                                
                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control" name="password" autocomplete="current-password">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="form-group row">
                                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">New Confirm
                                                    Password <small class="text-danger">(Password needs to have at least 8 characters)</small></label>
                                                <div class="col-md-6">
                                                    <input id="password_confirmation" type="password" class="form-control"
                                                           name="password_confirmation" autocomplete="password_confirmation">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        Update Password
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @include('backend.member.view_member.member_profile_js')
@endpush
