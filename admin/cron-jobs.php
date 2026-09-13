<?php require_once('partials/head.php');?>
<?php require_once('partials/nav.php');?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Tác Vụ Cron Jobs</h3>
                            <div class="nk-block-des text-soft">
                                <p>Quản lý tác vụ tự động hệ thống (auto-bank, payment, v.v.)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h5 class="title">Kết Nối Endpoint Cron</h5>
                                    </div>
                                </div>
                                <div class="card card-bordered mt-3">
                                    <div class="card-inner">
                                        <p class="mb-1">Endpoint globalny (wymaga autoryzacji callback token):</p>
                                        <code class="d-block bg-lighter p-2 rounded">GET /cron-jobs/global</code>
                                        <p class="mt-2 mb-1">Endpoint auto-bank:</p>
                                        <code class="d-block bg-lighter p-2 rounded">GET /call-back/api/auto-bank</code>
                                        <p class="mt-2 mb-1">Endpoint payment:</p>
                                        <code class="d-block bg-lighter p-2 rounded">GET /call-back/api/payment</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('partials/foot.php'); ?>