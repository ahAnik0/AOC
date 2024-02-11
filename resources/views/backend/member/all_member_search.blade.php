<div class="row">
    <div class="col-md-12">
        <div class="card card-dark">
            <form action="" method="post" id="search_form">
                <div class="row p-3">
                    <div class="col-3">
                        <label>Ba NO:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="ba_no">
                        </div>
                    </div>

                    <div class="col-3">
                        <label>Member Id:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="member_id_inputed">
                        </div>
                    </div>

                    <div class="col-3">
                        <label>Name:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="name">
                        </div>
                    </div>

                    <div class="col-3">
                        <label>Email:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="email">
                        </div>
                    </div>

                    <div class="col-3">
                        <label>Phone:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="phone">
                        </div>
                    </div>

                    <div class="col-3">
                        <label>Designation:</label>
                        <div class="form-group">
                            <select id="designation_id" class="form-control select2">
                                <option value="" selected>Please Select</option>
                                @foreach($ranks as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group">
                            <label>Blood Group:</label>
                            <select class="form-control select2" id="blood_group_id">
                                <option selected disabled>Please Select</option>
                                @foreach($blood_groups as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-2">
                        <label>Status</label>
                        <select id="status" class="form-control select2">
                            <option value="" selected>Please Select</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <label>Member Type</label>
                        <select id="member_type" class="form-control select2">
                            <option value="" selected>Please Select</option>
                            <option value="1">Ba No</option>
                            <option value="2">Civil No</option>
                            <option value="4">Guest</option>
                        </select>
                    </div>


                    <div class="card-footer">
                        <button class="btn btn-primary col-md-3" type="submit">Submit</button>
                        <button class="btn btn-secondary" onclick="form_reset()">Clear</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
