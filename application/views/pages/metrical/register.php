<div class="ht-100v d-flex">
    <div class="card shadow-none pd-20 mx-auto wd-300 text-center bd-1 align-self-center">
    <h4 class="card-title mt-3 text-center">Hallovent</h4>
    <p class="text-center">Selamat Datang</p>
    <form action="<?php echo base_url('base/action_register'); ?>" method="post">
        <div class="form-group input-group">
        <!-- kotak username -->
            <div class="input-group-prepend">
                <span class="input-group-text pd-x-9"> <i class="fa fa-user"></i> </span>
            </div>
            <input class="form-control form-control-sm" placeholder="Full Name" type="text" name="nama_lengkap" required="required">
        </div>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text pd-x-9"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input class="form-control form-control-sm" placeholder="Email" type="email" name="email" required="required">
        </div>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input class="form-control form-control-sm" placeholder="Password" type="password" name="password" required="required">
        </div>
        <!-- <p class="text-center"><a href="page-password.html">Forget Password?</a></p> -->
        <div class="form-group">
            <button type="submit" class="btn btn-custom-primary btn-block tx-13 hover-white"> Daftar </button>
            <a href="<?php echo base_url("base"); ?>" class="btn btn-default btn-block"> Masuk </a>
        </div>
        <!-- <p class="text-center">Don't have an account?<br/> <a href="page-singup.html">Create Account</a> </p> -->
    </form>
    </div>
</div>