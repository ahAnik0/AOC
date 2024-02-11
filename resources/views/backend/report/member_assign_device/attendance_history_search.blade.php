<div class="row">
    <div class="col-md-12">
        <div class="card card-dark">
            <form action="" method="post" id="search_form">
                <div class="row p-3">
                    
                    <div class="col-4">
                        <label>Devices</label>
                        <select id="device_id" class="form-control select2">
                            <option value="" selected>Please Select</option>
                            @foreach(\App\Models\DeviceModel::all() as $data)
                            <option value="{{$data->id}}">{{$data->device_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
{{--                    <div class="col-3">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Date from:</label>--}}
{{--                            <input type="date" class="form-control" name="from_date" id="from_date" value="<?php echo date('Y-m-d'); ?>">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    --}}
{{--                    <div class="col-3">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Date to:</label>--}}
{{--                            <input type="date" class="form-control" name="to_date" id="to_date"--}}
{{--                                   value="{{\Carbon\Carbon::now()->addDay(1)->toDateString()}}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    
                    <div class="card-footer">
                        <button class="btn btn-primary col-md-3" type="submit">Submit</button>
                        <button class="btn btn-secondary" onclick="form_reset()">Clear</button>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</div>
