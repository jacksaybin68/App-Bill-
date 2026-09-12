<?php $options_header = ['title' => 'Khôi Phục Tài Khoản', 'description' => 'Vui lòng hoàn tất các bước xác minh để có thể khôi phục tài khoản của bạn!',];
require($_SERVER['DOCUMENT_ROOT'].'/include/head.php');
require($_SERVER['DOCUMENT_ROOT'].'/server/models/object/global/isLoginModel.php');
require($_SERVER['DOCUMENT_ROOT'].'/function/insert/auth/header.php');?>
<div class="flex items-start justify-center pt-<?=isMobile() ? 32 : 24?> lg:pt-32">
    <div class="relative mx-auto w-full max-w-3xl">
        <?php foreach (AuthIconBank() as $bank): ?>
        <img class="bank-auth ltablet:block absolute <?=$bank['class']?> hidden object-cover lg:block pointer-events-none"
            src="/<?=__IMG__.'/icon/bank/'.$bank['file']?>.png" alt="icon <?=$bank['file']?>" width="64" height="64">
        <?php endforeach; ?>
        <div class="flex items-center justify-center">
        <?php
                class ForgotPassword extends DatabaseConnection
                {   
                    public $hided = false;
                    private $TD;
                    private $wtSecurity;
                    public function __construct($TD, $wtSecurity)
                    {
                        $this->TD = $TD;
                        $this->wtSecurity = $wtSecurity;
                    }

                    public function execute()
                    {
                        $data = isset($_GET['identify']) ? $_GET['identify'] : null;
                        if ($data) {
                            $identified = $this->wtSecurity->decrypt($data, $this->TD->Setting('key-aes'));
                            if ($identified) 
                            {
                                list($action, $otp_code, $token, $username) = explode('|', $identified);
                                if (!$this->checkUser($username)) {
                                    exit('<meta http-equiv="refresh" content="0; url=/oauth/dang-nhap">');
                                } elseif ($this->checkToken($token)) 
                                {
                                    if ($this->checkOtp($otp_code)) {
                                        if ($this->ChangePassword($action)) 
                                        {
                                            $this->hided = true;
                                        }
                                    } else {
                                        exit('<meta http-equiv="refresh" content="0; url=/oauth/dang-nhap">');
                                    }
                                } else {
                                    exit('<meta http-equiv="refresh" content="0; url=/oauth/dang-nhap">');
                                }
                            } else {
                                exit('<meta http-equiv="refresh" content="0; url=/oauth/dang-nhap">');
                            }
                        } else {
                            // exit("<pre>400 / Cannot request parameter.</pre>");
                        }
                    }
                    private function checkUser($username)
                    {
                        $vtd = self::ThanhDieuDB()->prepare("SELECT * FROM users WHERE username = ?");
                        $vtd->bind_param("s", $username);
                        $vtd->execute();
                        $OoO = $vtd->get_result();
                        return $OoO->num_rows > 0;
                    }

                    private function checkToken($token)
                    {
                        $vtd = self::ThanhDieuDB()->prepare("SELECT * FROM ws_otpmailler WHERE token = ? AND is_used = 0 AND expires_at > NOW()");
                        $vtd->bind_param("s", $token);
                        $vtd->execute();
                        $OoO = $vtd->get_result();
                        return $OoO->num_rows > 0;
                    }

                    private function checkOtp($otp_code)
                    {
                        $vtd = self::ThanhDieuDB()->prepare("SELECT * FROM ws_otpmailler WHERE otp_code = ? AND is_used = 0");
                        $vtd->bind_param("s", $otp_code);
                        $vtd->execute();
                        $OoO = $vtd->get_result();
                        return $OoO->num_rows > 0;
                    }

                    private function ChangePassword($action)
                    {
                        if ($action === 'ResetPw') 
                        {
                            return true;
                        }
                    }
                }
                $ForgotPassword = new ForgotPassword($TD, $wtSecurity);
                $ForgotPassword->execute();
                $MainForm = $ForgotPassword->hided;
                ?>
                <?php if ($MainForm) { ?>
                    <form class="w-full max-w-md user-reset-pw">
                    <input type="hidden" name="action" value="user-reset-pw">
                <div class="nui-card nui-card-rounded-md nui-card-default p-8 thanhdieu-border-card popular">
                    <div class="text-center">
                        <h2 class="nui-heading nui-heading-2xl nui-weight-medium nui-lead-normal"> Đặt Lại Mật Khẩu 🔐
                        </h2>
                        <p class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-400 mb-6">
                        Để bảo mật tài khoản hơn, hãy sử dụng mật khẩu gồm chữ cái và kí tự đặc biệt.</p>
                    </div>
                    <div class="mb-4 space-y-4">
                    <div class="group/password-strength relative">
                            <div
                                class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                <label class="nui-input-label nui-input-eye" for="password_new">Mật
                                    Khẩu </label>
                                <div class="nui-input-outer">
                                    <div>
                                        <input type="password" class="nui-input h-12 !ps-12 is-pw"
                                            placeholder="••••••••••" name="password_new" autocomplete="off" data-field="Mật Khẩu" minlength="6" maxlength="27" required>
                                        <div class="h-12 w-12 nui-input-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="icon nui-input-icon-inner"  width="1em" height="1em"
                                                viewBox="0 0 24 24">
                                                <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2">
                                                    <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <button
                                            class="wt-pw-eye leading-0 text-muted-400 peer-focus-within:text-primary-500 nui-focus absolute right-0 top-0 flex size-10 items-center justify-center text-center text-xl disabled:cursor-not-allowed"
                                            type="button" tabindex="0" data-nui-tooltip="Hiện mật khẩu">
                                            <div class="relative flex size-full items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                                                    role="img" class="icon size-5" width="1em" height="1em"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13">
                                                    </path>
                                                </svg>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="border-muted-200 dark:border-muted-700 shadow-muted-300/30 dark:shadow-muted-800/20 dark:bg-muted-800 pointer-events-none absolute -bottom-1 start-0 z-20 translate-y-full rounded-lg border bg-white p-6 opacity-0 shadow-xl transition-opacity duration-300 group-focus-within/password-strength:pointer-events-auto group-focus-within/password-strength:opacity-100">
                                <ul class="flex flex-col gap-4">
                                    <li class="flex items-center justify-between gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="icon text-muted-400 dark:text-muted-500 size-4 shrink-0" width="1em"
                                            height="1em" viewBox="0 0 24 24">
                                            <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3m.08 4h.01"></path>
                                            </g>
                                        </svg>
                                        <span
                                            class="grow text-xs dark:text-slate-400 dark:text-slate-350 font-semibold">Tối
                                            thiểu 6 ký tự, càng nhiều càng tốt.</span>
                                    </li>
                                    <li class="flex items-center justify-between gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="icon text-muted-400 dark:text-muted-500 size-4 shrink-0" width="1em"
                                            height="1em" viewBox="0 0 24 24">
                                            <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3m.08 4h.01"></path>
                                            </g>
                                        </svg>
                                        <span
                                            class="grow text-xs dark:text-slate-400 dark:text-slate-350 font-semibold">Hãy
                                            sử dụng mật khẩu có chữ cái và kèm theo số (hoặc chữ in hoa).</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                            <label class="nui-input-label nui-input-eye" for="password_confirm">Xác Nhận Mật
                                Khẩu </label>
                            <div class="nui-input-outer">
                                <div>
                                    <input type="password" class="nui-input h-12 !ps-12 is-pw" placeholder="••••••••••"
                                        name="password_confirm" autocomplete="off" data-field="Xác Nhận Mật Khẩu" minlength="6" maxlength="27" required>
                                    <div class="h-12 w-12 nui-input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="icon nui-input-icon-inner"  width="1em" height="1em"
                                            viewBox="0 0 24 24">
                                            <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2">
                                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect>
                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                            </g>
                                        </svg>
                                    </div>
                                    <button
                                        class="wt-pw-eye leading-0 text-muted-400 peer-focus-within:text-primary-500 nui-focus absolute right-0 top-0 flex size-10 items-center justify-center text-center text-xl disabled:cursor-not-allowed"
                                        type="button" tabindex="0" data-nui-tooltip="Hiện mật khẩu">
                                        <div class="relative flex size-full items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                                class="icon size-5" width="1em" height="1em" viewBox="0 0 24 24">
                                                <path fill="currentColor"
                                                    d="M2 5.27L3.28 4L20 20.72L18.73 22l-3.08-3.08c-1.15.38-2.37.58-3.65.58c-5 0-9.27-3.11-11-7.5c.69-1.76 1.79-3.31 3.19-4.54zM12 9a3 3 0 0 1 3 3a3 3 0 0 1-.17 1L11 9.17A3 3 0 0 1 12 9m0-4.5c5 0 9.27 3.11 11 7.5a11.8 11.8 0 0 1-4 5.19l-1.42-1.43A9.86 9.86 0 0 0 20.82 12A9.82 9.82 0 0 0 12 6.5c-1.09 0-2.16.18-3.16.5L7.3 5.47c1.44-.62 3.03-.97 4.7-.97M3.18 12A9.82 9.82 0 0 0 12 17.5c.69 0 1.37-.07 2-.21L11.72 15A3.064 3.064 0 0 1 9 12.28L5.6 8.87c-.99.85-1.82 1.91-2.42 3.13">
                                                </path>
                                            </svg>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="token" value="<?=$_GET['token'] ?? null?>">
                    <div class="mb-6">
                        <button type="submit"
                            class="nui-button fs-16px nui-button-rounded-sm nui-button-solid nui-button-primary !h-11 w-full">
                            <i class="ri-check-line me-2 mt-03"></i> Đổi Mật Khẩu</button>
                    </div>
            </form>
            <?php } else { ?>
                <form class="w-full max-w-md user-auth-forgotpw">
                <input type="hidden" name="action" value="user-auth-forgotpw">
                <div class="nui-card nui-card-rounded-md nui-card-default p-8 thanhdieu-border-card popular">
                    <div class="text-center">
                        <h2 class="nui-heading nui-heading-2xl nui-weight-medium nui-lead-normal"> Khôi Phục Mật Khẩu 🔐
                        </h2>
                        <p class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-400 mb-6">
                            Làm theo hướng dẫn được gửi đến địa chỉ email của bạn </p>
                    </div>
                    <div class="mb-4 space-y-4">
                        <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                            <label class="nui-input-label" for="email">Địa Chỉ E-mail</label>
                            <div class="nui-input-outer">
                                <div>
                                    <input type="email" class="nui-input h-12 !ps-12"
                                        placeholder="Nhập địa chỉ email..." name="email" maxlength="40" autofocus="" required>
                                    <div class="h-12 w-12 nui-input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="icon nui-input-icon-inner" width="1em" height="1em"
                                            viewBox="0 0 24 24" data-v-b4402e20="">
                                            <g fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2">
                                                <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                                <path d="m22 7l-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                            </g>
                                        </svg>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <button type="submit"
                            class="nui-button fs-16px nui-button-rounded-sm nui-button-solid nui-button-primary !h-11 w-full">
                            <i class="ri-check-line me-2"></i> Xác Nhận </button>
                    </div>
                    <p class="text-muted-400 mt-4 flex justify-between font-sans text-sm leading-5">
                        <span> </span>
                        <a href="/oauth/dang-nhap"
                            class="text-primary-600 hover:text-primary-500 font-medium underline-offset-4 transition duration-150 ease-in-out hover:underline">
                            Đăng Nhập <i class="ri-arrow-right-s-line"></i></a>
                    </p>
            </form>
            <?php }?>
        </div>
    </div>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/include/foot.php');?>