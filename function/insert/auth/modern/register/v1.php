<div class="flex items-start justify-center pt-10 sm:pt-20 lg:pt-40">
    <div class="relative mx-auto w-full max-w-3xl mb-4">
        <?php foreach (AuthIconBank() as $bank): ?>
        <img class="bank-auth ltablet:block absolute <?=$bank['class']?> hidden object-cover lg:block pointer-events-none"
            src="/<?=__IMG__.'/icon/bank/'.$bank['file']?>.png" alt="icon <?=$bank['file']?>" width="64" height="64">
        <?php endforeach; ?>
        <div class="flex items-center justify-center">
            <form class="w-full max-w-md user-auth-register">
            <input type="hidden" name="auth" value="user-auth-register">
                <div class="nui-card nui-card-rounded-md nui-card-default p-8 thanhdieu-border-card popular">
                    <div class="text-center">
                        <h2 class="nui-heading nui-heading-3xl nui-weight-medium nui-lead-normal"> Đăng Ký 💥
                        </h2>
                        <p class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-400 mb-6">
                            Bắt đầu sử dụng dịch vụ bằng cách đăng ký tài khoản mới</p>
                    </div>
                    <div class="mb-4 space-y-4">
                        <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                            <label class="nui-input-label" for="email">Địa chỉ Email</label>
                            <div class="nui-input-outer">
                                <div>
                                    <input type="email" class="nui-input h-12 !ps-12" placeholder="Nhập địa chỉ email"
                                        name="email" autofocus="" data-field="Email" required>
                                    <div class="h-12 w-12 nui-input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="icon nui-input-icon-inner" width="1em" height="1em"
                                            viewBox="0 0 24 24">
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
                        <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                            <label class="nui-input-label" for="username">Tài Khoản</label>
                            <div class="nui-input-outer">
                                <div>
                                    <input type="text" class="nui-input h-12 !ps-12 is-tk"
                                        placeholder="Nhập tên tài khoản" name="username" minlength="6" maxlength="27" data-field="Tài Khoản" required>
                                    <div class="h-12 w-12 nui-input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="icon nui-input-icon-inner" width="1em" height="1em"
                                            viewBox="0 0 256 256">
                                            <g fill="currentColor">
                                                <path d="M192 96a64 64 0 1 1-64-64a64 64 0 0 1 64 64" opacity=".2">
                                                </path>
                                                <path
                                                    d="M230.92 212c-15.23-26.33-38.7-45.21-66.09-54.16a72 72 0 1 0-73.66 0c-27.39 8.94-50.86 27.82-66.09 54.16a8 8 0 1 0 13.85 8c18.84-32.56 52.14-52 89.07-52s70.23 19.44 89.07 52a8 8 0 1 0 13.85-8M72 96a56 56 0 1 1 56 56a56.06 56.06 0 0 1-56-56">
                                                </path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="group/password-strength relative">
                            <div
                                class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                                <label class="nui-input-label nui-input-eye" for="password">Mật
                                    Khẩu </label>
                                <div class="nui-input-outer">
                                    <div>
                                        <input type="password" class="nui-input h-12 !ps-12 is-pw"
                                            placeholder="••••••••••" name="password" minlength="6" maxlength="27" data-field="Mật Khẩu" required>
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
                            <label class="nui-input-label nui-input-eye" for="repeat-password">Nhập Lại Mật
                                Khẩu </label>
                            <div class="nui-input-outer">
                                <div>
                                    <input type="password" class="nui-input h-12 !ps-12 is-pw" minlength="6" maxlength="27" placeholder="••••••••••"
                                        name="repeat-password" data-field="Nhập Lại Mật Khẩu" required>
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
                        <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-sm nui-has-icon">
                            <div class="nui-input-outer">
                                <div class="flex w-full items-center gap-3 text-start ws-captcha"></div>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-between">
                            <div class="nui-checkbox nui-checkbox-rounded-sm nui-checkbox-primary">
                                <div class="nui-checkbox-outer">
                                    <input class="nui-checkbox-input" type="checkbox" name="terms">
                                    <div class="nui-checkbox-inner"></div>
                                    <svg aria-hidden="true" viewBox="0 0 17 12" class="nui-icon-check">
                                        <path fill="currentColor"
                                            d="M16.576.414a1.386 1.386 0 0 1 0 1.996l-9.404 9.176A1.461 1.461 0 0 1 6.149 12c-.37 0-.74-.139-1.023-.414L.424 6.998a1.386 1.386 0 0 1 0-1.996 1.47 1.47 0 0 1 2.046 0l3.68 3.59L14.53.414a1.47 1.47 0 0 1 2.046 0z">
                                        </path>
                                    </svg>
                                    <svg aria-hidden="true" viewBox="0 0 24 24" class="nui-icon-indeterminate">
                                        <path fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="4" d="M2 12h20"></path>
                                    </svg>
                                </div>
                                <div class="nui-checkbox-label-wrapper">
                                    <label class="nui-checkbox-label-text" for="terms">
                                        Tôi đồng ý với <a href="#!null"
                                            class="text-primary-500 hover:underline focus:underline">
                                            Chính sách & Điều khoản </a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <button type="submit"
                            class="nui-button fs-16px nui-button-rounded-sm nui-button-solid nui-button-primary !h-11 w-full">
                            <i class="ri-user-add-line me-2 mt-03"></i> Đăng Ký </button>
                    </div>
                    <div class="mb-6 grid gap-0 sm:grid-cols-3">
                        <hr class="border-muted-200 dark:border-muted-700 mt-3 hidden border-t sm:block">
                        <span class="text-muted-400 relative top-0.5 text-center font-sans text-sm">
                        Đã có tài khoản</span>
                        <hr class="border-muted-200 dark:border-muted-700 mt-3 hidden border-t sm:block">
                    </div>
                    <a href="<?=Redirect::Login()?>"
                        class="nui-button nui-button-md nui-button-rounded-sm nui-button-solid nui-button-default !h-11 w-full">
                        <i class="ri-arrow-right-line"></i>
                        <span>Đăng Nhập Ngay</span>
                    </a>
            </form>
        </div>
    </div>