<div class="nk-sidebar-profile nk-sidebar-profile-fixed dropdown">
    <a href="#" class="toggle" data-target="profileDD">
        <div class="user-avatar">
            <img class="ws-avatar-1" src="<?=Avatar($user['username'], $user['avatar'])?>" alt="<?=THANHDIEU($user['username']);?>">
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-md m-1 nk-sidebar-profile-dropdown" data-content="profileDD">
        <div class="dropdown-inner user-card-wrap d-none d-md-block">
            <div class="user-card">
                <div class="user-avatar">
                    <img class="ws-avatar-1" src="<?=Avatar($user['username'], $user['avatar'])?>"
                        alt="<?=THANHDIEU($user['username']);?>">
                </div>
                <div class="user-info">
                    <span class="lead-text"><?=THANHDIEU($user['username']);?></span>
                    <span class="sub-text text-soft"><?=THANHDIEU($user['email']??'Chưa xác minh');?></span>
                </div>
            </div>
        </div>
        <div class="dropdown-inner">
            <ul class="link-list">
                <li>
                    <a class="user-logout" href="javascript:;">
                        <em class="icon ni ni-signout"></em>
                        <span>Đăng Xuất</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>