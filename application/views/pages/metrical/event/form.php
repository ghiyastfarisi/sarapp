<div class="row row-xs clearfix">
    <div class="col-md-12 col-lg-12">
    <div class="card mg-b-20">
        <div class="card-header">
            <h4 class="card-header-title">
                Create new event
            </h4>
            <div class="card-header-btn">
                <a  href="" data-toggle="collapse" class="btn card-collapse" data-target="#collapse1" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                <a href="" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                <a href="" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
            </div>
        </div>
        <div class="card-body collapse show" id="collapse1">
            <div class="form-layout form-layout-1">
                <form action="<?php echo base_url('event/add_event'); ?>" method="post" enctype="multipart/form-data">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label active">Title<span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="title" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label active">Location<span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="location" placeholder="Location" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label active">Date<span class="tx-danger">*</span></label>
                                    <input type='text' name="date" class="form-control datepicker-here" placeholder="Select Date" />
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label active">Caption<span class="tx-danger">*</span></label>
                                    <textarea class="form-control" name="caption" style="height:120px"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12 mg-b-10">
                                <label class="form-control-label active">Upload Image<span class="tx-danger">*</span></label>
                                <input name="event_image" type="file" class="form-control" id="image-upload">
                            </div>
                            <div class="col-lg-12">
                                <div id="image-container"></div>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="form-layout-footer">
                        <button class="btn btn-custom-primary">Submit</button>
                        <button class="btn btn-secondary">Cancel</button>
                    </div>
                    <!-- form-layout-footer -->
                </form>
            </div>
        </div>
    </div>
    </div>
    <!--/ Top Label Layout End -->
</div>