<div class="page-container container">
    <?php $this->load->view('pages/'.$builder.'/menu'); ?>
    <div class="page-content">
    <?php $this->load->view('pages/'.$builder.'/header'); ?>
        <div class="page-inner" style="min-height:100vh">
            <div id="main-wrapper">
                <?php $this->load->view('pages/'.$builder.'/pageheader'); ?>
                <?php
                    if (isset($MAIN_CONTENT)) {
                        $this->load->view('pages/'.$builder.'/'.$MAIN_CONTENT);
                    } else {
                        echo '{{$MAIN_CONTENT}}';
                    }
                ?>
            </div>
        </div>
        <?php $this->load->view('pages/'.$builder.'/footer') ?>
    </div>
</div>
<a href="" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>