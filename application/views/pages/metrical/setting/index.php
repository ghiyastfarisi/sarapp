<div class="row row-xs clearfix">
    <div class="col-md-12 col-lg-12">
    <div class="card mg-b-20">
        <div class="card-header">
            <h4 class="card-header-title">
                Setting
            </h4>
            <div class="card-header-btn">
                <a  href="" data-toggle="collapse" class="btn card-collapse" data-target="#collapse1" aria-expanded="true"><i class="ion-ios-arrow-down"></i></a>
                <a href="" data-toggle="expand" class="btn card-expand"><i class="ion-android-expand"></i></a>
                <a href="" data-toggle="remove" class="btn card-remove"><i class="ion-android-close"></i></a>
            </div>
        </div>
        <div class="card-body collapse show" id="collapse1">
            <div class="form-layout form-layout-1">
                <form action="<?php echo base_url('setting/update'); ?>" method="post">
                    <div class="row mg-b-25">
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label active">Email</label>
                                    <input value="<?php echo $user[0]['email']; ?>" class="form-control" type="text" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label active">Password<span class="tx-danger" style="font-size:70%"> *isi jika ingin update password</span></label>
                                    <input value="" class="form-control" type="password" name="password" placeholder="Password" >
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label active">Nama Lengkap</label>
                                    <input value="<?php echo $user[0]['nama_lengkap']; ?>" class="form-control" type="text" name="nama_lengkap" placeholder="nama lengkap" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-custom-primary">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <a class="btn btn-secondary" href="<?php echo base_url('event'); ?>">Cancel</a>
                    </div>
                    <!-- form-layout-footer -->
                </form>
            </div>
        </div>
    </div>
    </div>
    <!--/ Top Label Layout End -->
</div>