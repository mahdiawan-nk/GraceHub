<?php
    $this->config->load('app_config');
?>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                2020 © <?= $this->config->item('app_name') ?>
            </div>
            <div class="col-sm-6">
                <div class="text-sm-right d-none d-sm-block">
                    Design & Develop by <?= $this->config->item('app_author') ?>
                </div>
            </div>
        </div>
    </div>
</footer>