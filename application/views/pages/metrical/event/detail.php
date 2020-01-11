<div class="row row-xs clearfix">
    <div class="col-md-12 col-lg-12">
    <div class="card mg-b-20">
        <div class="card-header">
            <h4 class="card-header-title">
                Event Detail Info
            </h4>
            <div class="card-header-btn">
                <a  href="" data-toggle="collapse" class="btn card-collapse" data-target="#collapse1" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                <a href="" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                <a href="" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
            </div>
        </div>
        <div class="card-body collapse show" id="collapse1">
            <dl>
                <dt>Title</dt>
                <dd>
                    <?php echo $event[0]['title']; ?>
                </dd>
                <dt>Location</dt>
                <dd>
                    <?php echo $event[0]['location_name']; ?>
                </dd>
                <dt>Date</dt>
                <dd>
                    <?php echo $event[0]['date']; ?>
                </dd>
                <dt>Image</dt>
                <dd>
                    <?php echo '<img width="256px" src="'.base_url($event[0]['image_url']).'">'; ?>
                </dd>
                <dt>Caption</dt>
                <dd>
                    <?php echo $event[0]['caption']; ?>
                </dd>
            </dl>
            <a class="btn btn-info" href="<?php echo base_url('event'); ?>"><i class="ion-ios-arrow-left"></i> back</a>
        </div>
    </div>
    </div>
    <!--/ Top Label Layout End -->
</div>