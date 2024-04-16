<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Stay From</label>
            <input  type="date" id="staydate"
            required="required" name="stay_from"
            class="form-control" placeholder="Enter Company Name"
            min="{{ date('Y-m-d') }}"
            />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Leave At</label>
            <input  type="date" id="leavedate"
            required="required" name="leave_at" class="form-control"
            placeholder="Enter Company Name"
            min="{{ date('Y-m-d') }}"
            />
        </div>
    </div>
</div>
