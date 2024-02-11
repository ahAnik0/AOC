@extends('backend.app')
@section('title','Swim, Gym, Sauna, steam')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/css/select2.css')}}">
    <style  nonce="{{ csp_nonce() }}">
        .list-group {
            max-height: 300px;
            margin-bottom: 10px;
            overflow: scroll;
            -webkit-overflow-scrolling: touch;
        }
        .css_1{
            display: none
        }
        .css_2{
            overflow: no-content
        }
        .css_3{
            width: 40px;
        }
        .css_4{
            margin-bottom: 10px;margin-right: 10px
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu',request()->type)
@section('content')
    
    <div class="container-fluid">
        <form class="theme-form" action="{{route('admin.swim/submit_service_form')}}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-sm-12 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <b>Swim, Gym, Sauna, steam</b>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="required">Select Service</label>
                                <select name="service_name" class="form-control select2" id="service_name">
                                    <option selected disabled>Please Select</option>
                                    <option value="swimming">swimming</option>
                                    <option value="gym">Gym</option>
                                    <option value="steam_bath">Steam bath</option>
                                    <option value="sauna_bath">Sauna bath</option>
                                </select>
                            </div>
                            <div class="row align-items-center" id="member_search">
                                <div class="col-11">
                                    <div class="mb-3">
                                        <label class="col-form-label required">Search member</label>
                                        <input type="text" name="member_name" id="member_name" class="form-control input-lg"
                                               placeholder="Member name / Member ID / Ba no / Civil no / phone" autofocus/>
                                    </div>
                                
                                </div>
                                
                                <div class="col-1">
                                    <button class="btn btn-success mt-3" type="button" id="new_member_bitton" onclick="newMemberSection()">+</button>
                                </div>
                            </div>
                            
                            <input type="hidden" id="member_id" name="member_id">
                            
                            <div id="member_list"></div>
                            
                            <div id="new_member css_1" >
                                <div class="mb-3">
                                    <label class="col-form-label required">Member name</label>
                                    <input type="text" name="new_member_name" class="form-control input-lg"/>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="col-form-label required">Member Ba No</label>
                                    <input type="text" name="member_ba_no" class="form-control input-lg"/>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="col-form-label required">Member Phone</label>
                                    <input type="number" name="member_phone" class="form-control input-lg"/>
                                </div>
                            </div>
                            
                            <div class="col-md-12 css_1"  id="member_details">
                                <ul class="list-group css_2" >
                                    <li class="list-group-item">Member Id: <span id="member_id_inputed"></span></li>
                                    <li class="list-group-item">Ba No: <span id="member_ba_no"></span></li>
                                    <li class="list-group-item">Member Name: <span id="member_name_show"></span></li>
                                    <li class="list-group-item">Phone: <span id="member_phone"></span></li>
                                    <li class="list-group-item bg-warning">Status: <span id="member_status"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="col-form-label required">Number of person</label>
                                <input class="form-control" type="number" id="number_of_person" name="number_of_person"
                                       value="{{old('number_of_person')}}">
                                {!! $errors->first('number_of_person', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group mt-3">
                                        <div class="row" x-data="handler()">
                                            <div class="col">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Guest member Name</label>
                                                        <table class="table table-bordered align-items-center table-sm">
                                                            <thead class="thead-light">
                                                            <tr>
                                                                <th>Ser</th>
                                                                <th>Guest name</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <template x-for="(field, index) in fields" :key="index">
                                                                <tr>
                                                                    <td x-text="index + 1"></td>
                                                                    <td width="70%">
                                                                        <input class="form-control" type="text" id="name_of_guests[]" name="name_of_guests[]" required>
                                                                    </td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-danger btn-small" @click="removeField(index)">&times;</button>
                                                                    </td>
                                                                </tr>
                                                            </template>
                                                            </tbody>
                                                            <tfoot>
                                                            <tr>
                                                                <td colspan="5" class="text-right">
                                                                    <button type="button" class="btn btn-success f-right" @click="addNewField()">+ Add</button>
                                                                </td>
                                                            </tr>
                                                            </tfoot>
                                                        </table>
                                                        <span id="error_purpose_to_visit" class="text-danger error_field"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            
                            
                            <div class="mb-3">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h5>select extra item</h5>
                                    </div>
                                    <div class="card-body megaoptions-border-space-sm">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="checkbox">
                                                        <input id="checkbox3" type="checkbox" onchange="checkTotalqty()" name="large_towel" value="15" class="first_package">
                                                        <label for="checkbox3">Large Towel</label>
                                                    </div>
                                                    <label for="checkbox3">Qty:</label>
                                                    <label>
                                                        <input class="touchspin-vertical form-control css_3" type="text" value="1"  id="large_tawel_qty"
                                                               onkeyup="checkTotalqty()" name="large_tawel_qty">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="checkbox">
                                                        <input id="checkbox4" type="checkbox" onchange="checkTotalqty()" name="small_towel" value="10" class="second_package">
                                                        <label for="checkbox4">Small Towel</label>
                                                    </div>
                                                    <label for="checkbox3">Qty:</label>
                                                    <label>
                                                        <input class="touchspin-vertical form-control css_3" type="text" value="1"  id="small_tawel_qty"
                                                               onkeyup="checkTotalqty()" name="small_tawel_qty">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h4 class="text-center">Total Amount <span class="badge badge-primary" id="total_amount">0</span></h4>
                                <h4 class="text-center">Previous Due <span class="badge badge-danger" id="previous_due">0</span></h4>
                                <input type="hidden" id="main_amount" name="main_amount">
                            </div>
                            
                            <div class="mb-3">
                                <label class="col-form-label required">Payable Amount</label>
                                <input class="form-control" type="number" id="amount" name="amount"
                                       value="{{old('amount')}}">
                                {!! $errors->first('amount', '<p class="help-block text-danger">:message</p>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <button class="btn btn-primary btn-lg btn-block col-md-4 css_4" type="submit"  id="form_submission_button">Save</button>
                <button class="btn btn-danger btn-lg btn-block col-md-4 css_4"  onClick="window.location.reload();">Reaload</button>
            </div>
        </form>
    </div>

@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('assets/backend/js/apline.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/tooltip-init.js')}}"></script>
    @include('backend.swim.new_service_js')
@endpush
