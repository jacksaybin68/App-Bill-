<div class="dark:bg-muted-800 flex min-h-screen bg-white select-none">
    <div class="bg-muted-100 dark:bg-muted-900 relative hidden w-0 flex-1 items-center justify-center lg:flex lg:w-3/5">
        <div class="mx-auto flex size-full max-w-4xl items-center justify-center pointer-events-none">
            <img class="mx-auto max-w-xl-none" src="/<?= __IMG__ ?>/svg/log-in-girl.svg" alt="<?=$TD->Setting('name-site')?> Banner" width="719"
                height="594">
        </div>
    </div>
    <div class="relative flex flex-1 flex-col justify-center px-6 py-12 w-auth-cover lg:flex-none">
        <div class="dark:bg-muted-800 relative mx-auto w-full max-w-sm bg-white">
            <div class="flex w-full items-center justify-between">
                <a href="/trang-chu"
                    class="text-muted-400 hover:text-primary-500 flex items-center gap-2 font-sans font-medium transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="icon size-5" width="1em" height="1em"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m1.027 11.993l4.235 4.25L6.68 14.83l-1.821-1.828L22.974 13v-2l-18.12.002L6.69 9.174L5.277 7.757z">
                        </path>
                    </svg>
                    <span>Về trang chủ</span>
                </a>
                <label class="nui-theme-toggle" for="theme-toggle-input">
                    <input type="checkbox" class="nui-theme-toggle-input"
                        id="theme-toggle-input">
                    <span class="nui-theme-toggle-inner">
                        <svg aria-hidden="true" viewBox="0 0 24 24" class="nui-sun">
                            <g fill="currentColor" stroke="currentColor" class="stroke-2">
                                <circle cx="12" cy="12" r="5"></circle>
                                <path
                                    d="M12 1v2m0 18v2M4.22 4.22l1.42 1.42m12.72 12.72 1.42 1.42M1 12h2m18 0h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42">
                                </path>
                            </g>
                        </svg>
                        <svg aria-hidden="true" viewBox="0 0 24 24" class="nui-moon">
                            <path fill="currentColor" stroke="currentColor"
                                d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" class="stroke-2"></path>
                        </svg>
                    </span>
                </label>
            </div>
            <div>
                <h2 class="nui-heading nui-heading-3xl nui-weight-medium nui-lead-relaxed mt-6 novalidate">
                    Chào mừng trở lại 👋
                </h2>
                <p class="nui-paragraph nui-paragraph-sm nui-weight-normal nui-lead-normal text-muted-400 mb-6">
                    Vui lòng đăng nhập để sử dụng dịch vụ
                </p>
                <div class="flex flex-wrap justify-between gap-4">
                    <button
                        class="dark:bg-muted-700 text-muted-800 border-muted-300 dark:border-muted-600 nui-focus relative inline-flex grow items-center justify-center gap-2 rounded-xl border bg-white px-6 py-4 dark:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="icon size-5" width="1em" height="1em"
                            viewBox="0 0 256 262">
                            <path fill="#4285F4"
                                d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622l38.755 30.023l2.685.268c24.659-22.774 38.875-56.282 38.875-96.027">
                            </path>
                            <path fill="#34A853"
                                d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055c-34.523 0-63.824-22.773-74.269-54.25l-1.531.13l-40.298 31.187l-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1">
                            </path>
                            <path fill="#FBBC05"
                                d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82c0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602z">
                            </path>
                            <path fill="#EB4335"
                                d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0C79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251">
                            </path>
                        </svg>
                        <div>Tính năng đang được phát triển</div>
                    </button>
                </div>
                <div class="flex-100 mt-8 flex items-center">
                    <hr class="border-muted-200 dark:border-muted-700 flex-auto border-t-2">
                    <span class="text-muted-400 px-4 font-sans font-light"> <marquee>MIỀN CHÍNH: <?=$TD->Setting('name-site')?></marquee> </span>
                    <hr class="border-muted-200 dark:border-muted-700 flex-auto border-t-2">
                </div>
            </div>
            <div class="mt-6">
                <div class="mt-5">
                    <form class="mt-6 user-auth-login">
                        <input type="hidden" name="auth" value="user-auth-login">
                        <div class="space-y-4">
                            <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-lg">
                                <label class="nui-input-label" for="username">
                                    Tài Khoản
                                </label>
                                <div class="nui-input-outer">
                                    <input type="text" autofocus="" class="nui-input h-12 !ps-12"
                                        placeholder="Nhập email hoặc tài khoản" name="username" minlength="6"
                                        maxlength="27" data-field="Tài Khoản" required>
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
                            <div class="nui-input-wrapper nui-input-default nui-input-md nui-input-rounded-lg">
                                <label class="nui-input-label" for="password">
                                    Mật Khẩu
                                </label>
                                <div class="nui-input-outer">
                                    <input type="password" class="nui-input h-12 !ps-12" placeholder="••••••••••"
                                        name="password" minlength="6" maxlength="27" data-field="Mật
                        Khẩu" required>
                                    <div class="h-12 w-12 nui-input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img"
                                            class="icon nui-input-icon-inner" width="1em" height="1em"
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
                        <div class="mt-6 flex items-center justify-between">
                            <div class="nui-checkbox nui-checkbox-rounded-lg nui-checkbox-primary">
                                <div class="nui-checkbox-outer">
                                    <input class="nui-checkbox-input"
                                        type="checkbox" id="remember-me" name="remember-me">
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
                                    <label class="nui-checkbox-label-text" for="remember-me">
                                        Lưu đăng nhập
                                    </label>
                                </div>
                            </div>
                            <div class="text-xs leading-5">
                                <a href="recover-password"
                                    class="text-primary-600 hover:text-primary-500 font-sans font-medium underline-offset-4 transition duration-150 ease-in-out hover:underline">
                                    Quên mật khẩu? </a>
                            </div>
                        </div>
                        <div class="mt-6">
                            <div class="block w-full rounded-md shadow-sm">
                                <button type="submit"
                                    class="nui-button nui-button-md nui-button-rounded-lg nui-button-solid nui-button-primary !h-11 w-full">
                                    <i class="ri-arrow-right-line me-2 mt-03"></i> Đăng Nhập
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="text-muted-400 mt-4 flex justify-between font-sans text-xs leading-5">
                        <span>Chưa có tài khoản?</span>
                        <a href="<?=Redirect::Register()?>"
                            class="text-primary-600 hover:text-primary-500 font-medium underline-offset-4 transition duration-150 ease-in-out hover:underline">
                            Đăng Ký Ngay </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>