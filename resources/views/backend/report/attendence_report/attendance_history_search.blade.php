<div class="row">
    <div class="col-md-12">
        <div class="card card-dark">
            <form action="" method="post" id="search_form">
                <div class="row p-3">
                    
                    <div class="col-2">
                        <label>Devices</label>
                        <select id="device_id" class="form-control select2">
                            <option value="" selected>Please Select</option>
                            @foreach(\App\Models\DeviceModel::all() as $data)
                            <option value="{{$data->id}}">{{$data->device_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-2">
                        <label>Member Id:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="member_id">
                        </div>
                    </div>
                    
                    <div class="col-2">
                        <label>Member Name:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="member_name">
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label>Date from:</label>
                            <input type="date" class="form-control" name="from_date" id="from_date">
                        </div>
                    </div>
                    
                    <div class="col-3">
                        <div class="form-group">
                            <label>Date to:</label>
                            <input type="date" class="form-control" name="to_date" id="to_date">
                        </div>
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
