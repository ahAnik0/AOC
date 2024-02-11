@extends('backend.app')
@section('title','Barber shop')
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
            overflow: no-content;
        }
        .css_3{
            margin-bottom: 10px;margin-right: 10px
        }
    </style>
@endpush
@section('main_menu','Home')
@section('active_menu',request()->type)
@section('content')
    
    <div class="container-fluid">
        <form class="theme-form" action="{{route('admin.salon/submit_service_form')}}" method="post">
            @csrf
            <div class="row justify-content-center">
                <div class="col-sm-12 col-xl-8">
                    <div class="card">
                        <div class="card-body">
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
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label class="required"> Select Member Type</label>
                                        <select class="form-select digits select2" name="officer_type" data-prop="">
                                            <option selected disabled>Please Select</option>
                                            <option value="Officer">Officer</option>
                                            <option value="Officers Children">Officers Children</option>
                                            <option value="Officers Guest">Officers Guest</option>
                                            <option value="Retired Officer">Retired Officer</option>
                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header pb-0">
                                            <h5>Salon Section</h5>
                                            <hr>
                                        </div>
                                        <div class="container">
                                            <input type="checkbox" value="100.00" id="cbx1" name="Hair_Cut"/>
                                            <label>Hair Cut - 100TK</label>
                                            <br>
                                            <input type="checkbox" value="40.00" id="cbx2" name="Gel_Shave"/>
                                            <label>Gel Shave - 40TK</label>
                                            <br>
                                            <input type="checkbox" value="35.00" id="cbx3" name="Foam_Shave"/>
                                            <label>Foam Shave - 35TK</label>
                                            <br>
                                            <input type="checkbox" value="50.00" id="cbx4" name="Beard_Trimming"/>
                                            <label>Beard Trimming - 50TK</label>
                                            <br>
                                            <input type="checkbox" value="300.00" id="cbx5" name="Hair_Color"/>
                                            <label>Hair Color (Bigen)/High Speed - 300TK</label>
                                            <br>
                                            <input type="checkbox" value="500.00" id="cbx5" name="Hair_Beard_Color"/>
                                            <label>Hair & Beard Color (Bigen)/High Speed - 500TK</label>
                                            <br>
                                            <input type="checkbox" value="350.00" id="cbx5" name="Hair_Color_Loreal"/>
                                            <label>Hair Color (Loreal) - 350TK</label>
                                            <br>
                                            <input type="checkbox" value="100.00" id="cbx5" name="Hair_Color_Only"/>
                                            <label>Applying Hair Color Only - 100TK</label>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-header pb-0">
                                                    <h5>Grooming Section</h5>
                                                    <hr>
                                                </div>
                                                <div class="container">
                                                    <input type="checkbox" value="400.00" id="cbx11" name="Facial"/>
                                                    <label>Facial - 400TK</label>
                                                    <br>
                                                    <input type="checkbox" value="50.00" id="cbx21" name="Face_Wash"/>
                                                    <label>Face Wash - 50TK</label>
                                                    <br>
                                                    <input type="checkbox" value="150.00" id="cbx31" name="Face_Scrub"/>
                                                    <label>Face Scrub - 150TK</label>
                                                    <br>
                                                    <input type="checkbox" value="100.00" id="cbx41" name="Charcoal_Face_Mask"/>
                                                    <label>Charcoal Face Mask - 100TK</label>
                                                    <br>
                                                    <input type="checkbox" value="50.00" id="cbx51" name="Head_Massage"/>
                                                    <label>Head Massage (Without Oil-15Min) - 50TK</label>
                                                    <br>
                                                    <input type="checkbox" value="75.00" id="cbx52" name="Head_Massage"/>
                                                    <label>Head Massage (With Oil-15Min) - 75TK</label>
                                                    <br>
                                                    <input type="checkbox" value="100.00" id="cbx53" name="Shampoo_without_Conditioner"/>
                                                    <label>Shampoo (without Conditioner) - 100TK</label>
                                                    <br>
                                                    <input type="checkbox" value="150.00" id="cbx54" name="Shampoo_with_Conditioner"/>
                                                    <label>Shampoo (with Conditioner) - 150TK</label>
                                                    <br>
                                                    <input type="checkbox" value="200.00" id="cbx55" name="Manicure"/>
                                                    <label>Manicure - 200TK</label>
                                                    <br>
                                                    <input type="checkbox" value="300.00" id="cbx56" name="Pedicure"/>
                                                    <label>Pedicure - 300TK</label>
                                                    <br>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header pb-0">
                                                        <h5>Packages</h5>
                                                    </div>
                                                    <div class="card-body megaoptions-border-space-sm">
                                                        <form class="mega-inline">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="card">
                                                                        <div class="media p-20">
                                                                            <div class="radio radio-primary me-3">
                                                                                <input id="radio19" type="radio" name="package" cost="730" value="package_1"
                                                                                       data-prop="" data-id="730">
                                                                                <label for="radio19"></label>
                                                                            </div>
                                                                            <div class="media-body">
                                                                                <h6 class="mt-0 mega-title-badge">Package-1 : 730 TK</h6>
                                                                                <ul>
                                                                                    <li><a href="">Gel Shave</a></li>
                                                                                    <li><a href="">Hair Cut</a></li>
                                                                                    <li><a href="">Shampoo with Conditioner</a></li>
                                                                                    <li><a href="">Face Scrub</a></li>
                                                                                    <li><a href="">Fcial</a></li>
                                                                                
                                                                                </ul>
                                                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="card">
                                                                        <div class="media p-20">
                                                                            <div class="radio radio-secondary me-3">
                                                                                <input id="radio20" type="radio" name="package" cost="1250" value="package_2"
                                                                                       data-prop="" data-id="1250">
                                                                                <label for="radio20"></label>
                                                                            </div>
                                                                            <div class="media-body">
                                                                                <h6 class="mt-0 mega-title-badge">Package-2 : 1250 TK</h6>
                                                                                <ul>
                                                                                    <li><a href="">Gel Shave</a></li>
                                                                                    <li><a href="">Hair Cut</a></li>
                                                                                    <li><a href="">Shampoo with Conditioner</a></li>
                                                                                    <li><a href="">Face Scrub</a></li>
                                                                                    <li><a href="">Fcial</a></li>
                                                                                    <li><a href="">Pedicure</a></li>
                                                                                    <li><a href="">Manicure</a></li>
                                                                                </ul>
                                                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                            <div class="card">
                                                <label for="grandtotal">Total:</label>
                                                <input type="text" id="grandtotal" readonly name="amount" min="1"/>
                                            </div>
                                            
                                            <div class="row justify-content-center">
                                                <button class="btn btn-primary btn-lg btn-block col-md-4 css_3" type="submit" 
                                                        id="form_submission_button">Save
                                                </button>
                                                <button class="btn btn-danger btn-lg btn-block col-md-4 css_3"  type="button" onClick="window.location
                                                .reload();
">Reaload
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@push('js')
    <script src="{{asset('assets/backend/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/backend/js/select2/select2-custom.js')}}"></script>
    <script src="{{asset('assets/backend/js/sweetalert2.all.js')}}"></script>
    <script src="{{asset('assets/backend/js/datatable_sum.js')}}"></script>
    <script src="{{asset('assets/backend/js/tooltip-init.js')}}"></script>
    @include('backend.salon.new_service_js')
@endpush
