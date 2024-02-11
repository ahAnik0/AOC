<div class="row">
    <div class="col-md-12">
        <div class="card card-dark">
            <form action="" method="post" id="search_form">
                <div class="row p-3">
                    <div class="col-3">
                       <label>Service name</label>
                        <select name="service_name" class="form-control" id="service_name">
                            <option value="no_value" selected>Please Select</option>
                            <option value="tennis" {{$type == 'tennis'?'selected':''}}>Tennis</option>
                            <option value="bowling" {{$type == 'bowling'?'selected':''}}>Bowling</option>
                        </select>
                    </div>
                    
                    <div class="col-3">
                        <label>Member Id:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="member_id">
                        </div>
                    </div>
                    
                    <div class="col-3">
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
