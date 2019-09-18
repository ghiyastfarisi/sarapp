<div class="row row-xs clearfix">
    <div class="col-md-2 col-lg-2">
        <a href="<?php echo base_url('event/form'); ?>" class="btn btn-primary btn-block mg-b-10">
            <i class="fa fa-send mg-r-10"></i> Create New Event
        </a>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="card mg-b-20">
            <div class="card-header">
                <h4 class="card-header-title">
                    Event Management
                </h4>
                <div class="card-header-btn">
                    <a  href="#" data-toggle="collapse" class="btn card-collapse" data-target="#collapse1" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                    <!-- <a href="#" data-toggle="refresh" class="btn card-refresh"><i class="ion-android-refresh"></i></a> -->
                    <a href="#" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                    <a href="#" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
                </div>
            </div>
            <div class="card-body collapse show" id="collapse1">
                <table id="tbl-event-management" class="table wrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($eventData)) {
                            foreach($eventData as $i => $v) {
                                echo '<tr>';
                                echo '<td>'.$v['ordered'].'</td>';
                                echo '<td><img style="height:128px" src="'.$v['image_url'].'"/></td>';
                                echo '<td>'.$v['title'].'</td>';
                                echo '<td>'.$v['location_name'].'</td>';
                                echo '<td>'.$v['date'].'</td>';
                                echo '<td>'.$v['action'].'</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo 'no data';
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>