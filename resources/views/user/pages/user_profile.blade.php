@extends('user.app')
@section('title','user Profile')
@push('css')
@endpush
@section('main_menu','Home')
@section('active_menu','user Profile')
@section('link',route('user.userdashboard'))
@section('content')
    
    
    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <h5 class="p-0">
                                    <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon2" aria-expanded="true" aria-controls="collapseicon2">About
                                        Member
                                    </button>
                                </h5>
                            </div>
                            <div class="card-body post-about">
                                <ul>
                                    <li>
                                        <div class="icon"><i data-feather="user-check"></i></div>
                                        <div>
                                            <h5>Member ID</h5>
                                            <p>{{$member->member_id_inputed}}</p>
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
{{--                                <div class="social-network theme-form">--}}
{{--                                    <button class="btn social-btn btn-fb mb-2 text-center">Print ID Card Front</button>--}}
{{--                                    <button class="btn social-btn btn-twitter mb-2 text-center">Print ID Card Back</button>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
                                                        aria-selected="true">Timeline
                                    </a></li>
                                <li class="nav-item"><a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
                                                        aria-selected="false">Relationship</a></li>
                            </ul>
                            <br>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <div class="container-fluid">
                                        <div class="user-profile">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Member Details</h5>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-condensed border">
                                                                <tbody>
                                                                <tr>
                                                                    <td>#.</td>
                                                                    <td>Member ID:</td>
                                                                    <td><b>{{$member->member_id}}</b></td>
                                                                    
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
                                                                    <td class="bg-success">Next Renewal Date:</td>
                                                                    <td class="bg-success"><b>{{\Carbon\Carbon::parse($member->connection_to)->format('F d, Y')}}</b>
                                                                    </td>
                                                                
                                                                </tr>
                                                                
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    <!-- hj -->
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div class="container-fluid">
                                        <div class="user-profile">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Relationship Details</h5>
                                                        </div>
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
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                                    <div class="container-fluid">
                                        <div class="user-profile">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Password Details</h5>
                                                        </div>
                                                        <div class="table-responsive">
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
@endpush
