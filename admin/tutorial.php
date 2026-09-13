<?php require_once('partials/head.php');?>
<?php require_once('partials/nav.php');?>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Hướng Dẫn Cho Admin</h3>
                            <div class="nk-block-des text-soft">
                                <p>Przewodnik konfiguracji i korzystania z panelu administratora</p>
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
                                        <h5 class="title">Szybki Start</h5>
                                    </div>
                                </div>
                                <ul class="list-group mt-3">
                                    <li class="list-group-item d-flex">
                                        <span class="badge rounded-pill bg-info me-2">1</span>
                                        <span>Najpierw skonfiguruj ustawienia w <strong>settings.php</strong> (m.in. Nạp Tiền, cuphap, bank).</span>
                                    </li>
                                    <li class="list-group-item d-flex">
                                        <span class="badge rounded-pill bg-info me-2">2</span>
                                        <span>Zarządzaj użytkownikami na stronie <strong>user-list.php</strong> oraz zbanowanymi na <strong>user-banned.php</strong>.</span>
                                    </li>
                                    <li class="list-group-item d-flex">
                                        <span class="badge rounded-pill bg-info me-2">3</span>
                                        <span>Dodawaj produkty w <strong>add-product.php</strong> i nowe wiadomości w <strong>add-newfeeds.php</strong>.</span>
                                    </li>
                                    <li class="list-group-item d-flex">
                                        <span class="badge rounded-pill bg-info me-2">4</span>
                                        <span>Włącz tác vụ cron w <strong>cron-jobs.php</strong>: auto-bank i payment (wymagany token).</span>
                                    </li>
                                    <li class="list-group-item d-flex">
                                        <span class="badge rounded-pill bg-info me-2">5</span>
                                        <span>Monitoruj przychody w <strong>bank.php</strong> i <strong>payment.php</strong>.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once('partials/foot.php'); ?>