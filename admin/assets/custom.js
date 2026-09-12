function Administrator(e) {
    var items = $("select[default]");
    for (var i = 0; i < items.length; i++) {
        $(items[i]).val($(items[i]).attr("default") || 0);
    }
    $("html, body").animate({ scrollTop: 0 }, "slow");
    var _thanhdieu = {};
    _thanhdieu.ws = $("body");
    _thanhdieu.ajax = "/ajax/global/admin";

    function initCaptcha(callback) {
        initGeetest4({
                captchaId: '',
                product: 'float',
                riskType: 'slide'
            },
            function(captcha) {
                captchaObj = captcha;
                captchaObj.appendTo("#captcha_login");
                if (callback) callback();
            }
        );
    }
    if (typeof initGeetest4 !== 'undefined') {
        initCaptcha();
    }

    function ThanhDieuHandle(e, custom) {
        e.preventDefault();
        if (captchaObj && typeof captchaObj.getValidate === 'function') {
            if (!captchaObj.getValidate()) {
                return FuiToast.error("Vui lòng xác minh captcha!");
            }
            if (typeof custom === 'function') {
                custom(e);
            } else {
                FuiToast.error('No custom submit handler provided!');
            }
        } else {
            FuiToast.error("Captcha object is not properly initialized!");
        }
    }
    if ($('[data-toggle="tooltip"]').length > 0) {
        $('[data-toggle="tooltip"]').tooltip();
        a
        Fancybox.bind('[data-fancybox]', {});
    }
    var isMobile = function() {
        if (/Android|SymbianOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|Midp/i.test(navigator.userAgent)) {
            return true;
        }
        return false;
    }
    if ($('[data-fancybox]').length > 0) {
        Fancybox.bind('[data-fancybox]', {});
    }
    _thanhdieu.ws.append($('<div class="td-loader"style="display:none;"><img src="/public/src/vtd/img/icon/loader.gif"></div>'));
    $('input[type="search"]').each(function() {
        if ($(this).attr('aria-controls') === 'DataTables_Table_1') {
            $(this).attr('placeholder', 'Nhập để tìm kiếm...');
        }
    });

    function Run(TDPromise) {
        FuiToast.promise(TDPromise, {
            loading: 'Vui lòng đợi...',
            success: (data) => {
                Wsloader(false);
                return data;
            },
            error: (error) => {
                Wsloader(false);
                return error;
            }
        }, {
            isClose: true
        });
    }
    window.Wsloader = function(show) {
        if (show) {
            $('.td-loader').show();
        } else {
            $('.td-loader').hide();
        }
    };
    if (window.location.pathname === '/admin/') {
        $(".nk-menu-item.home").addClass("active current-page");
    }
    if (window.location.pathname.includes('/md5/')) {
        $(".nk-menu-item.report").addClass("active current-page");
    }
    if (window.location.pathname === '/admin/') window.location.replace('/admin/dashboard');

    function MenuClick(targetClass, menuItemClass, link) {
        return function(e) {
            e.preventDefault();
            $(targetClass).show();
            $(`a[href="${link}"]`).removeClass('active');
            $(this).addClass('active');
            $('.nk-menu-item').removeClass('active current-page');
            $(this).closest('.nk-menu-item').addClass('active current-page');
            $(menuItemClass).addClass('active');
        }
    }
    _thanhdieu.ws.on('click', 'a[href="#show-newfeeds"]', MenuClick(".td-newfeeds", '.nk-menu-item.newfeeds', '#show-newfeeds'));
    _thanhdieu.ws.on('click', 'li.newfeeds > a.nk-menu-toggle', function(e) {
        e.preventDefault();
        if ($(this).closest('li.newfeeds').hasClass('active current-page')) {
            $('a[href="#show-newfeeds"]').closest('li.nk-menu-item').addClass('active current-page');
        }
    });
    _thanhdieu.ws.on('click', 'a[href="#show-product"]', MenuClick(".td-product-page", '.nk-menu-item.product-page', '#show-product'));
    if ($('li.product-page').hasClass('active current-page')) {
        $('a[href="#show-product"]').closest('li.nk-menu-item').addClass('active current-page');
    }
    _thanhdieu.ws.on('click', 'a[href="#show-users"]', MenuClick(".td-users", '.nk-menu-item.users', '#show-users'));
    if ($('li.users').hasClass('active current-page')) {
        $('a[href="#show-users"]').closest('li.nk-menu-item').addClass('active current-page');
    }
    _thanhdieu.ws.on('click', 'a[href="#show-bank"]', MenuClick(".td-bank", '.nk-menu-item.bank', '#show-bank'));
    if ($('li.bank').hasClass('active current-page')) {
        $('a[href="#show-bank"]').closest('li.nk-menu-item').addClass('active current-page');
    }
    _thanhdieu.ws.on('click', '.show-pw', function() {
        var input = $(this).closest('.input-group').find('input');
        var icon = $(this).find('i');

        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('ri-eye-line').addClass('ri-eye-off-line');
        } else {
            input.attr('type', 'password');
            icon.removeClass('ri-eye-off-line').addClass('ri-eye-line');
        }
    });
    function Timeago(Timeago) {
        var s = Math.floor((new Date() - new Date(Timeago)) / 1000);
        var phut = Math.floor(s / 60);
        var gio = Math.floor(phut / 60);
        var ngay = Math.floor(gio / 24);
        var tuan = Math.floor(ngay / 7);
        var thang = Math.floor(ngay / 30);
        var nam = Math.floor(ngay / 365);
        if (nam > 0) return nam + ' năm trước';
        if (thang > 0) return thang + ' tháng trước';
        if (tuan > 0) return tuan + ' tuần trước';
        if (ngay > 0) return ngay + ' ngày trước';
        if (gio > 0) return gio + ' giờ trước';
        if (phut > 0) return phut + ' phút trước';
        return 'vừa xong';
    }

    function UpdateTimes() {
        $('.time-ago').each(function() {
            $(this).text(Timeago($(this).data('timeago')));
        });
        requestAnimationFrame(UpdateTimes);
    }
    requestAnimationFrame(UpdateTimes);
    $(".nk-footer-copyright.display-name").html('&copy; 2021 Developed by <a href="\u0068\u0074\u0074\u0070\u0073\u003a\u002f\u002f\u0074\u0068\u0061\u006e\u0068\u0064\u0069\u0065\u0075\u002e\u0063\u006f\u006d" target="_blank">ThanhDieu \uD83D\uDC97</a>');
    var theme = GetCookie("theme");
    if (!theme) {
        SetCookie("theme", "dark", 365);
        theme = "dark";
    }
    if (theme === "dark") {
        _thanhdieu.ws.addClass("dark-mode");
        $(".toggle-theme").addClass("dark-mode");
        $(".toggle-theme em").removeClass("ni-sun").addClass("ni-moon");
    } else {
        _thanhdieu.ws.removeClass("dark-mode");
        $(".toggle-theme").removeClass("dark-mode");
        $(".toggle-theme em").removeClass("ni-moon").addClass("ni-sun");
    }
    $(".ws-toggle-theme").click(function(e) {
        e.preventDefault();
        if (_thanhdieu.ws.hasClass("dark-mode")) {
            _thanhdieu.ws.removeClass("dark-mode");
            $(".toggle-theme").removeClass("dark-mode");
            $(".toggle-theme em").removeClass("ni-moon").addClass("ni-sun");
            SetCookie("theme", "light", 365);
        } else {
            _thanhdieu.ws.addClass("dark-mode");
            $(".toggle-theme").addClass("dark-mode");
            $(".toggle-theme em").removeClass("ni-sun").addClass("ni-moon");
            SetCookie("theme", "dark", 365);
        }
    });
    if (_thanhdieu.ws.hasClass("dark-mode")) {
        $(".toggle-theme em").removeClass("ni-sun").addClass("ni-moon");
    } else {
        $(".toggle-theme em").removeClass("ni-moon").addClass("ni-sun");
    }

    function SetCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function GetCookie(name) {
        var cookieValue = null;
        if (document.cookie && document.cookie !== '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].trim();
                if (cookie.substring(0, name.length + 1) === (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
    $('.link-list-menu li a').each(function() {
        if (window.location.pathname.split('/').pop() === $(this).attr('href').split('/').pop()) {
            $(this).addClass('active');
        }
    });

    _thanhdieu.ws.on('change', 'select[name="kieubank"]', function() {
        var select = $(this).val();
        if (select === 'tudong') {
            $('.api-bank').slideDown();
        } else if (select === 'thucong') {
            $('.api-bank').slideUp();

        }
    });
    _thanhdieu.ws.on('click', '.dl-img', function(e) {
        e.preventDefault();
        var dl_url = $(this).data('download');
        var fakebill_id = $(this).data('bill-id');
        var name_site = $(this).data('name-site');
        var link = document.createElement('a');
        link.href = dl_url;
        link.download = name_site + '-' + fakebill_id;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    _thanhdieu.ws.on('click', '.td-copy', function() {
        var text = $(this).data('copy');
        navigator.clipboard.writeText(text)
            .then(() => {
                if (text.length > 35) {
                    FuiToast.success('Đã sao chép: ' + text.substring(0, 35) + '...');
                } else {
                    FuiToast.success('Đã sao chép: ' + text);
                }
            })
            .catch(err => {
                FuiToast.error('Lỗi sao chép: ' + err.message);
            });
    });
    // // Tự Động Xuống Dòng
    // $('#chucnang_code').on('input', function() {
    //     var text=$(this).val();
    //     text=text.replace(/\n/g, '<br/>');
    //     $(this).val(text);
    // });
    _thanhdieu.ws.on('input', '.ws-sotien,input[name="sotien"]', function() {
        var a = $(this).val().replace('đ', '');
        var b = a.replace(/\D/g, '');
        var c = b.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        if (c.length > 0) {
            c += 'đ';
        }
        $(this).val(c);
    });
    _thanhdieu.ws.on('input', '.ws-percent', function() {
        let value = $(this).val().replace('%', '');
        value = parseFloat(value);
        if (isNaN(value) || value < 0) {
            value = 0;
        } else if (value > 100) {
            value = 100;
        }
        $(this).val(value + '%');
    });
    $('.ws-percent').on('focus', function() {
        $(this).val($(this).val().replace('%', ''));
    });
    $('.ws-percent').on('blur', function() {
        let value = $(this).val().replace('%', '');
        value = parseFloat(value);
        if (!isNaN(value)) {
            $(this).val(value + '%');
        } else {
            $(this).val('0%');
        }
    });
    $('#slug').on('input', function() {
        var slug = $(this).val().toLowerCase().replace(/\s+/g, '-');
        // slug = XoaTiengVietCoDau(slug);
        slug=slug.replace(/[^a-z0-9-]/g, '');
        $(this).val(slug);
    });
    $("#select-image").click(function() {
        $("#td-uploads").click();
    });

    $("#td-uploads").change(function() {
        var files = $(this)[0].files;
        if (!CheckImage(files)) {
            TDUploadFile(files);
        }
    });
    
    var dropzone = document.getElementById('custom-dropzone');
    if (dropzone) {
        dropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            $(this).addClass('dragover');
        });

        dropzone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            $(this).removeClass('dragover');
        });

        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            $(this).removeClass('dragover');
            var files = e.dataTransfer.files;
            if (!CheckImage(files)) {
                TDUploadFile(files);
            }
        });
    }

    function CheckImage(files) {
        var maxFileSize = 2 * 1024 * 1024;
        for (var i = 0; i < files.length; i++) {
            if (['image/gif', 'image/jpeg', 'image/jpg', 'image/png', 'image/webp'].indexOf(files[i].type) === -1) {
                Swal.fire('Thất Bại', 'Định dạng ảnh không được hỗ trợ!', 'error');
                return true;
            } else if (files[i].size > maxFileSize) {
                Swal.fire('Thất Bại', 'Kích thước ảnh không được vượt quá 2MB!', 'error');
                return true;
            }
        }
        return false;
    }

    var SelectedFiles = [];

    function TDUploadFile(files) {
        $('.td-message').hide();
        var isMultiple = document.getElementById('td-uploads').hasAttribute('multiple');
        var maxFiles = isMultiple ? files.length : 1;
        for (var i = 0; i < maxFiles; i++) {
            (function(file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img_container = document.createElement("div");
                    img_container.className = "image-container";
                    var img = document.createElement("img");
                    img.src = e.target.result;
                    img.className = "preview-image";
                    var delete_img = document.createElement("button");
                    delete_img.innerHTML = '<em class="icon ni ni-cross"></em>';
                    delete_img.className = "delete-image";
                    delete_img.onclick = function() {
                        img_container.remove();
                        if ($("#image-preview .image-container").length === 0) {
                            $('.td-message').show();
                        }
                        var index = SelectedFiles.indexOf(file);
                        if (index !== -1) {
                            SelectedFiles.splice(index, 1);
                        }
                    };
                    img_container.appendChild(img);
                    img_container.appendChild(delete_img);
                    $("#image-preview").append(img_container);

                    SelectedFiles.push(file);
                }
                reader.readAsDataURL(file);
            })(files[i]);
        }
    }
    class ImageConverter {
        static Base64(base64Array, mimeType) {
            const blobs = [];
            base64Array.forEach(base64 => {
                const byteString = atob(base64);
                const arrayBuffer = new ArrayBuffer(byteString.length);
                const uint8Array = new Uint8Array(arrayBuffer);

                for (let i = 0; i < byteString.length; i++) {
                    uint8Array[i] = byteString.charCodeAt(i);
                }

                blobs.push(new Blob([uint8Array], {
                    type: mimeType
                }));
            });

            return blobs;
        }
    }
    if ($('#limit-account').length) {
        var slider = document.getElementById('limit-account');
        slider.noUiSlider.on('update', function(values, handle) {
            var value = Math.round(values[handle]);
            $('span[data-slider-count]').text(value);
        });
    } else if ($('#auto-delete').length) {
        var slider = document.getElementById('auto-delete');
        slider.noUiSlider.on('update', function(values, handle) {
            var value = Math.round(values[handle]);
            $('span[data-slider-count]').text(value + ' ngày');
        });
    }
    $('#is-modal').change(function() {
        var oOo = $(this).next('.custom-control-label');
        if ($(this).prop('checked')) {
            oOo.removeClass('text-danger').addClass('text-primary').text('Kích Hoạt');
        } else {
            oOo.removeClass('text-primary').addClass('text-danger').text('Vô Hiệu Hoá');
        }
    });
    _thanhdieu.ws.on('click', '.user-avatar', function() {
        var inputId = $(this).data('input');
        $('#' + inputId).click();
    });

    _thanhdieu.ws.on('change', 'input[type="file"]', function(event) {
        var input = event.target;
        var previewId = $(input).siblings('.user-avatar').data('preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#' + previewId).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

    _thanhdieu.ws.on('submit', '.auth-admin-lg', function(e) {
        ThanhDieuHandle(e, function(event) {
            var formData = $(event.target).serialize();
            var TDPromise = new Promise(function(resolve, reject) {
                $.ajax({
                    type: "post",
                    url: _thanhdieu.ajax,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            _thanhdieu.ws.fadeOut(200, function() {
                                history.go(0);
                            }).fadeIn(200);
                        } else {
                            captchaObj.reset();
                            reject(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        FuiToast.error("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                    }
                });
            });
            Run(TDPromise);
        });
    });
    _thanhdieu.ws.on('click', '.user-logout', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Bạn có chắc chắn muốn đăng xuất khỏi thông tin đăng nhập hiện tại của mình không?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, đăng xuất!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            user_logout: true
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                resolve(response.message);
                                _thanhdieu.ws.fadeOut(200, function() {
                                    history.go(0);
                                }).fadeIn(200);
                            } else {
                                reject(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('submit', '.ws-settings', function(e) {
        e.preventDefault();
        Wsloader(true);
        var formData = $(this).serialize();
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('click', '.reset-key-aes', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Thông Báo',
            text: 'Tất cả thành viên sẽ bị đăng xuất kể cả bạn, bạn vẫn muốn tiếp tục thực hiện điều này?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, reset ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            reset_key_aes: true
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 200) {
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('click', '.clear-cache', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Thông Báo',
            text: 'Chức năng này dùng để làm mới lại dữ liệu cache như JavaScript, CSS v.v.., khi bạn update code thì bạn mới cần bật chức năng này, có thể bị overload nếu máy chủ yếu.',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Làm mới ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                return FuiToast.error('Không khả dụng!');
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            clear_cache: true
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.success) {
                                resolve(response.message);
                            } else {
                                reject(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    $('#is-modal').change(function() {
        Wsloader(true);
        var modal = $(this).is(':checked') ? 1 : 0;
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: {
                    modal: modal
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('submit', '.ws-setting-info', function(e) {
        e.preventDefault();
        Wsloader(true);
        var formData = new FormData(this);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                processData: false,
                contentType: false,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    if ($('#ws-settings-security').length) {
        $('#sensitivity-anti-spam').change(function() {
            Wsloader(true);
            var AntiSpam = $(this).is(':checked') ? 1 : 0;
            var TDPromise = new Promise(function(resolve, reject) {
                $.ajax({
                    type: "post",
                    url: _thanhdieu.ajax,
                    data: {
                        anti_spam: AntiSpam
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            resolve(response.msg);
                        } else {
                            reject(response.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                    }
                });
            });
            Run(TDPromise);
        });
        $('#admin-page').change(function() {
            Wsloader(true);
            var AdminPage = $(this).is(':checked') ? 1 : 0;
            var TDPromise = new Promise(function(resolve, reject) {
                $.ajax({
                    type: "post",
                    url: _thanhdieu.ajax,
                    data: {
                        AdminPage: AdminPage
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            resolve(response.msg);
                        } else {
                            reject(response.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                    }
                });
            });
            Run(TDPromise);
        });
        $('#is-captcha').change(function() {
            Wsloader(true);
            var isCaptcha = $(this).is(':checked') ? 1 : 0;
            var TDPromise = new Promise(function(resolve, reject) {
                $.ajax({
                    type: "post",
                    url: _thanhdieu.ajax,
                    data: {
                        isCaptcha: isCaptcha
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            resolve(response.msg);
                        } else {
                            reject(response.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                    }
                });
            });
            Run(TDPromise);
        });
        _thanhdieu.ws.on('click', '#status-maintenance', function(e) {
            e.preventDefault();
            Wsloader(true);
            var maintenance = $(this).data('status') == 1 ? 0 : 1;
            var TDPromise = new Promise(function(resolve, reject) {
                $.ajax({
                    type: "post",
                    url: _thanhdieu.ajax,
                    data: {
                        maintenance: maintenance
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            resolve(response.msg);
                            $('#status-maintenance').data('status', maintenance);
                            $('#status-maintenance').text(maintenance == 1 ? 'Đang Bật' : 'Đang Tắt');
                            $('#status-maintenance').removeClass('btn-danger btn-primary').addClass(maintenance == 1 ? 'btn-primary' : 'btn-danger');
                            $('.ws-baotri .badge').removeClass('bg-danger bg-success').addClass(maintenance == 1 ? 'bg-success' : 'bg-danger').text(maintenance == 1 ? 'Đang Bảo Trì' : 'Đã Tắt Bảo Trì');
                        } else {
                            reject(response.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                    }
                });
            });
            Run(TDPromise);
        });
        _thanhdieu.ws.on('click', '#status-https', function(e) {
            e.preventDefault();
            Wsloader(true);
            var https = $(this).data('status') == 1 ? 0 : 1;
            var TDPromise = new Promise(function(resolve, reject) {
                $.ajax({
                    type: "post",
                    url: _thanhdieu.ajax,
                    data: {
                        https: https
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            resolve(response.msg);
                            $('#status-https').data('status', https);
                            $('#status-https').text(https == 1 ? 'Đang Bật' : 'Đang Tắt');
                            $('#status-https').removeClass('btn-danger btn-primary').addClass(https == 1 ? 'btn-primary' : 'btn-danger');
                        } else {
                            reject(response.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                    }
                });
            });
            Run(TDPromise);
        });
        slider.noUiSlider.on('change', function(values, handle) {
            Wsloader(true);
            var slider = document.getElementById('limit-account');
            slider.noUiSlider.on('update', function(values, handle) {
                var value = Math.round(values[handle]);
                $('span[data-slider-count]').text(value);
            });
            var limit_account = Math.round(values[handle]);
            var TDPromise = new Promise(function(resolve, reject) {
                $.ajax({
                    type: "post",
                    url: _thanhdieu.ajax,
                    data: {
                        limit_account: limit_account
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            resolve(response.msg);
                        } else {
                            reject(response.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                    }
                });
            });
            Run(TDPromise);
        });
    }
    _thanhdieu.ws.on('submit', '#Cong-Tien', function(e) {
        e.preventDefault();
        Wsloader(true);
        var formData = $(this).serialize();
        $.ajax({
            type: "post",
            url: _thanhdieu.ajax,
            data: formData,
            dataType: 'json',
            success: function(response) {
                Wsloader(false);
                if (response.status == 200) {
                    $("#cong-tien").modal('hide');
                    $("input[name='sotien']").val('');
                    $(".thanhdieu-refresh").load(location.href + " .thanhdieu-refresh > *");
                    Swal.fire("Thông Báo", response.msg, "success");
                } else {
                    Swal.fire("Thất Bại", response.msg, "error");
                }
            },
            error: function(xhr, status, error) {
                Wsloader(false);
                Swal.fire("Mất Kết Nối", "Mất kết nối đến máy chủ vui lòng kiểm tra lại! vui lòng kiểm tra lại!", "error");
            }
        });
    });
    _thanhdieu.ws.on('submit', '#Tru-Tien', function(e) {
        e.preventDefault();
        Wsloader(true);
        var formData = $(this).serialize();
        $.ajax({
            type: "post",
            url: _thanhdieu.ajax,
            data: formData,
            dataType: 'json',
            success: function(response) {
                Wsloader(false);
                if (response.status == 200) {
                    $("#tru-tien").modal('hide');
                    $("input[name='sotien']").val('');
                    $(".thanhdieu-refresh").load(location.href + " .thanhdieu-refresh > *");
                    Swal.fire("Thông Báo", response.msg, "success");
                } else {
                    Swal.fire("Thất Bại", response.msg, "error");
                }
            },
            error: function(xhr, status, error) {
                Wsloader(false);
                Swal.fire("Mất Kết Nối", "Mất kết nối đến máy chủ vui lòng kiểm tra lại! vui lòng kiểm tra lại!", "error");
            }
        });
    });
    _thanhdieu.ws.on('submit', '#editUsers', function(e) {
        e.preventDefault();
        Wsloader(true);
        var formData = $(this).serialize();
        $.ajax({
            type: "post",
            url: _thanhdieu.ajax,
            data: formData,
            dataType: 'json',
            success: function(response) {
                Wsloader(false);
                if (response.status == 200) {
                    $(".thanhdieu-refresh").load(location.href + " .thanhdieu-refresh > *");
                    Swal.fire("Thông Báo", response.msg, "success");
                } else {
                    Swal.fire("Thất Bại", response.msg, "error");
                }
            },
            error: function(xhr, status, error) {
                Wsloader(false);
                Swal.fire("Mất Kết Nối", "Mất kết nối đến máy chủ vui lòng kiểm tra lại! vui lòng kiểm tra lại!", "error");
            }
        });
    });
    _thanhdieu.ws.on('click', '#banned-users', function(e) {
        e.preventDefault();
        Wsloader(true);
        var $link = $(this);
        var user_id = $link.data('user-id');
        var TDPromise = new Promise(function(resolve, reject) {
            $.post(_thanhdieu.ajax, {
                user_id: user_id,
                banned_users: true
            }, function(response) {
                if (response.status) {
                    var statusMap = {
                        1: {
                            text: 'Mở Khoá Tài Khoản',
                            class: 'bg-danger',
                            statusText: 'Đình Chỉ'
                        },
                        0: {
                            text: 'Khoá Tài Khoản',
                            class: 'bg-success',
                            statusText: 'Hoạt Động'
                        }
                    };
                    if (response.new_status in statusMap) {
                        var newStatus = statusMap[response.new_status];
                        $link.find('span').text(newStatus.text);
                        var $tbStatus = $link.closest('tr').find('.tb-status');
                        $tbStatus
                            .removeClass('bg-success bg-danger')
                            .addClass(newStatus.class)
                            .text(newStatus.statusText);
                        if (response.new_status == 1) {
                            resolve('Đã đình chỉ tài khoản này!');
                        } else {
                            resolve('Đã mở khoá tài khoản!');
                        }
                    } else {
                        reject(response.msg);
                    }
                }
            }, "json").fail(function() {
                reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
            });

        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('click', '.truncate-logs', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Bạn có chắc chắn muốn xóa tất cả nhật ký, dữ liệu liên quan tới bảng logs sẽ không còn tồn tại nữa?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            truncate_logs: true
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                $(".thanhdieu-refresh").load(location.href + " .thanhdieu-refresh > *");
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('click', '.truncate-transfer', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Bạn có chắc chắn muốn xoá tất cả ngân hàng hiện có trong bảng?, bạn phải thiết lập lại ngân hàng mới sau khi xoá tất cả!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            truncate_transfer: true
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                $('table tbody').empty();
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('submit', '.add-transfer-bank', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        $('form.add-transfer-bank')[0].reset();
                        $('#addTransfer').modal('hide');
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('submit', '.edit-transfer-bank', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        $('.modal').modal('hide');
                        _thanhdieu.ws.fadeOut(200, function() {
                            history.go(0);
                        }).fadeIn(2020);
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('click', '.delete-transfer', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Bạn có chắc chắn muốn xoá ngân hàng này?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var transfer_id = $(this).data('transfer-id');
                var deletes = $(this);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            delete_transfer: true,
                            transfer_id: transfer_id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                deletes.closest("tr").remove();
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('submit', '.ws-setting-callback', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('submit', '.ws-create-newfeeds', function(e) {
        e.preventDefault();
        Wsloader(true);
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            url: _thanhdieu.ajax,
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                Wsloader(false);
                if (response.status == 200) {
                    Swal.fire({
                        title: "<strong>Thông Báo</strong>",
                        icon: "success",
                        html: `${response.msg}`,
                        showCancelButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: "Đồng ý",
                        onClose: () => {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire("Thất Bại", response.msg, "error");
                }
            },
            error: function(xhr, status, error) {
                Wsloader(false);
                Swal.fire("Mất Kết Nối", "Mất kết nối đến máy chủ vui lòng kiểm tra lại!, vui lòng kiểm tra lại!", "error");
            }
        });
    });
    _thanhdieu.ws.on('submit', '.re-edit-newfeeds', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('submit', '.modal-popup', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        resolve(response.message);
                    } else {
                        reject(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('click', '.delete-newfeeds', function(e) {
        e.preventDefault();
        var id_newfeeds = $(this).data('newfeeds-id');
        var deletes = $(this);
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Bạn có chắn chắc xoá bảng tin này không?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            delete_newfeeds: true,
                            id_newfeeds: id_newfeeds
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                deletes.closest("tr").remove();
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('click', '#delete-account', function(e) {
        e.preventDefault();
        var username = $(this).data('username');
        var deletes_user = $(this);
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Bạn có chắc chắn muốn xóa thành viên này, mọi dữ liệu liên quan đến thành viên này sẽ bị xoá!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            delete_users: true,
                            username: username
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                deletes_user.closest("tr").remove();
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('click', '.hide-newfeeds', function(e) {
        e.preventDefault();
        var id_newfeeds = $(this).data('newfeeds-id');
        var hide = $(this);
        Wsloader(true);

        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: {
                    hide_newfeeds: true,
                    id_newfeeds: id_newfeeds
                },
                dataType: "json",
                success: function(response) {
                    Wsloader(false);
                    if (response.status == 200) {
                        var tr = hide.closest('tr');
                        var badge = tr.find('.badge');
                        if (response.new_status == '1') {
                            hide.find('span').text('Ẩn Bảng Tin');
                            badge.removeClass('bg-outline-danger').addClass('bg-outline-success').text('Hoạt Động');
                        } else {
                            hide.find('span').text('Hiện Bảng Tin');
                            badge.removeClass('bg-outline-success').addClass('bg-outline-danger').text('Đang Ẩn');
                        }
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    Wsloader(false);
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });

        Run(TDPromise);
    });

    _thanhdieu.ws.on('click', '#fuck-devtools', function(e) {
        e.preventDefault();
        Wsloader(true);
        var fuckdevtools = $(this).data('status') == 1 ? 0 : 1;
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: {
                    fuckdevtools: fuckdevtools
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 200) {
                        resolve(response.msg);
                        $('#fuck-devtools').data('status', fuckdevtools);
                        $('#fuck-devtools').text(fuckdevtools == 1 ? 'Đang Bật' : 'Đang Tắt');
                        $('#fuck-devtools').removeClass('btn-danger btn-primary').addClass(fuckdevtools == 1 ? 'btn-primary' : 'btn-danger');
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('submit', '#TaoThanhVien', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        $('form')[0].reset();
                        $('#addUser').modal('hide');
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('click', '.backup-sql', function(e) {
        e.preventDefault();
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: {
                    backup_sql: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        window.location.href = response.file;
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('submit', '.create-new-plan', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        $('form.create-new-plan')[0].reset();
                        setTimeout(() => {
                            _thanhdieu.ws.fadeOut(200, function() {
                                history.go(0);
                            }).fadeIn(200);
                        }, 1300);
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('click', '.lock-plan', function(e) {
        e.preventDefault();
        Wsloader(true);
        var $link = $(this);
        var goi_id = $link.data('plan-id');
        var TDPromise = new Promise(function(resolve, reject) {
            $.post(_thanhdieu.ajax, {
                goi_id: goi_id,
                action: 'lock-plan'
            }, function(response) {
                if (response.status == 200) {
                    var statusMap = {
                        0: {
                            text: 'Mở Khoá',
                            class: 'btn-warning',
                            icon: 'ri-lock-unlock-line'
                        },
                        1: {
                            text: 'Khoá Gói',
                            class: 'btn-danger',
                            icon: 'ri-lock-2-line'
                        }
                    };
                    var newStatus = statusMap[response.new_status];
                    $link
                        .removeClass('btn-danger btn-warning')
                        .addClass(newStatus.class)
                        .html('<i class="' + newStatus.icon + ' me-1"></i>' + newStatus.text);
                    var $tbStatus = $link.closest('tr').find('.tb-status');
                    $tbStatus
                        .removeClass('bg-success bg-danger')
                        .addClass(newStatus.class)
                        .text(newStatus.text);
                    if (response.new_status == 1) {
                        resolve('Đã mở khoá gói này!');
                    } else {
                        resolve('Đã khoá gói này!');
                    }
                } else {
                    reject(response.msg);
                }
            }, "json").fail(function() {
                reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
            });
        });

        Run(TDPromise);
    });
    _thanhdieu.ws.on('click', '.truncate-plans', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Bạn có chắc chắn muốn xóa tất cả các gói, tất cả dữ liệu gói sẽ không còn tồn tại nữa?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            action: 'truncate-plans'
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                $(".thanhdieu-refresh").load(location.href + " .thanhdieu-refresh > *");
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('click', '.truncate-history-plans', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Bạn có chắc chắn muốn xóa tất cả các gói mà thành viên đã mua, sao khi xoá không thể khôi phục bằng cách nào!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            action: 'truncate-history-plans'
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                $('table tbody').empty();
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('submit', '.re-edit-plan', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        $('.modal').modal('hide');
                        $(".thanhdieu-refresh").load(location.href + " .thanhdieu-refresh > *");
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('submit', '.set-limit-bill', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        $('.modal').modal('hide');
                        $('form.set-limit-bill')[0].reset();
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('submit', '.set-time-bill', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        $('.modal').modal('hide');
                        $('form.set-time-bill')[0].reset();
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('click', '.truncate-all-bill', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Xoá tất cả lịch sử tạo bill để giải phóng dung lượng, tuy nhiên khách hàng sẽ không còn thấy ảnh tạo bill ở lịch sử tạo, bạn có muốn tiếp tục?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            action: 'truncate-all-bill'
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                $('table tbody').empty();
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('click', '.delete-bill', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Bạn có chắc chắn muốn xoá bill này?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var bill_id = $(this).data('bill-id');
                var deletes = $(this);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            action: 'delete-bill',
                            bill_id: bill_id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                deletes.closest("tr").remove();
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    _thanhdieu.ws.on('click', '.banned-plan', function(e) {
        e.preventDefault();
        Wsloader(true);
        var $link = $(this);
        var plan_id = $link.data('plan-id');
        var TDPromise = new Promise(function(resolve, reject) {
            $.post(_thanhdieu.ajax, {
                plan_id: plan_id,
                action: 'banned-plan'
            }, function(response) {
                if (response.status) {
                    var statusMap = {
                        1: {
                            text: 'Hoạt Động',
                            class: 'bg-outline-success',
                            buttonText: 'Khoá',
                            icon: '<i class="ri-lock-2-line me-1"></i>'
                        },
                        2: {
                            text: 'Tạm Khoá',
                            class: 'bg-outline-warning',
                            buttonText: 'Mở Khoá',
                            icon: '<i class="ri-lock-unlock-line me-1"></i>'
                        }
                    };
                    if (response.new_status in statusMap) {
                        var newStatus = statusMap[response.new_status];
                        var $tbStatus = $link.closest('tr').find('.tb-status');
                        $tbStatus
                            .removeClass('bg-outline-success bg-outline-warning bg-outline-danger')
                            .addClass(newStatus.class)
                            .text(newStatus.text);
                        $link
                            .removeClass('bg-secondary bg-warning')
                            .addClass(response.new_status === 1 ? 'bg-warning' : 'bg-secondary')
                            .html(newStatus.icon + newStatus.buttonText);

                        if (response.new_status == 2) {
                            resolve('Đã tạm khoá gói này!');
                        } else {
                            resolve('Đã mở khoá gói này!');
                        }
                    } else {
                        reject(response.msg);
                    }
                }

            }, "json").fail(function() {
                reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
            });

        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('click', '.delete-plan', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Bạn có chắc chắn muốn xoá gói thành viên này?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var plan_id = $(this).data('plan-id');
                var deletes = $(this);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            action: 'delete-plan',
                            plan_id: plan_id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                deletes.closest("tr").remove();
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
    if ($('#auto-delete').length) {
        slider.noUiSlider.on('change', function(values, handle) {
            Wsloader(true);
            var slider = document.getElementById('auto-delete');
            slider.noUiSlider.on('update', function(values, handle) {
                var value = Math.round(values[handle]);
                $('span[data-slider-count]').text(value + ' ngày');
            });
            var values = Math.round(values[handle]);
            var TDPromise = new Promise(function(resolve, reject) {
                $.ajax({
                    type: "post",
                    url: _thanhdieu.ajax,
                    data: {
                        action: 'auto-delete-bill',
                        values: values
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 200) {
                            resolve(response.msg);
                        } else {
                            reject(response.msg);
                        }
                    },
                    error: function(xhr, status, error) {
                        reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                    }
                });
            });
            Run(TDPromise);
        });
    }
    _thanhdieu.ws.on('submit', '.set-expiration-all-plan', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        Wsloader(true);
        var TDPromise = new Promise(function(resolve, reject) {
            $.ajax({
                type: "post",
                url: _thanhdieu.ajax,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        $('.modal').modal('hide');
                        $('form.set-expiration-all-plan')[0].reset();
                        resolve(response.msg);
                    } else {
                        reject(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('submit', '.ws-create-products', function(e) {
        e.preventDefault();
        Wsloader(true);
        if (SelectedFiles.length === 0) {
            Wsloader(false);
            Swal.fire("Thất Bại", "Vui lòng chọn một hình ảnh để tải lên!", "error");
            return;
        }
        var formData = new FormData(this);
        SelectedFiles.forEach(function(file, index) {
            formData.append("anhsanpham[" + index + "]", file);
        });
        $.ajax({
            type: "POST",
            url: _thanhdieu.ajax,
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response) {
                Wsloader(false);
                if (response.status==200) {
                    $('.ws-create-products')[0].reset();
                    Swal.fire({
                        title: "<strong>Thông Báo</strong>",
                        icon: "success",
                        html: `${response.msg}`,
                        showCancelButton: false,
                        allowOutsideClick: false,
                        confirmButtonText: "Đồng ý",
                        onClose: () => {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire("Thất Bại", response.msg, "error");
                }
            },
            error: function(xhr, status, error) {
                Wsloader(false);
                Swal.fire("Mất Kết Nối", "Mất kết nối đến máy chủ vui lòng kiểm tra lại!, vui lòng kiểm tra lại!", "error");
            }
        });
    });
    _thanhdieu.ws.on("submit", ".re-edit-newfeed", function (e) {
        e.preventDefault();
        var t = new FormData(this);
        Wsloader(true);
        var TDPromise = new Promise(function (resolve, reject) {
            $.ajax({
                type: "POST",
                url: _thanhdieu.ajax,
                data: t,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function (res) {
                    if (res.status == 200) {
                        resolve(res.msg);
                    } else {
                        reject(res.msg);
                    }
                },
                error: function () {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });    
    _thanhdieu.ws.on("submit", ".re-edit-product", function (e) {
        e.preventDefault();
        var t = new FormData(this);
        var TDPromise = new Promise(function (resolve, reject) {
            $.ajax({
                type: "POST",
                url: _thanhdieu.ajax,
                data: t,
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function (res) {
                    if (res.status == 200) {
                        resolve(res.msg);
                    } else {
                        reject(res.msg);
                    }
                },
                error: function () {
                    reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });    
    _thanhdieu.ws.on("click", ".delete-products", function (e) {
        e.preventDefault();
        var t = $(this).data("product-id"),
            n = $(this);
        Swal.fire({
            title: "Cảnh Báo",
            text: "Sau khi xoá tất cả dữ liệu liên quan đến đơn hàng này như lượt bán, lượt xem, dữ liệu khách hàng đã mua v.v... sẽ không còn tồn tại nữa. Bạn có chắc chắn muốn xoá?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Có, xoá ngay!",
            cancelButtonText: "Hủy bỏ",
        }).then(function (result) {
            if (result.isConfirmed) {
                Wsloader(true);
                const TDPromise = new Promise(function (resolve, reject) {
                    $.ajax({
                        type: "POST",
                        url: _thanhdieu.ajax,
                        data: {
                            action: 'delete-product',
                            id_product: t
                        },
                        dataType: "json",
                        success: function (res) {
                            Wsloader(false);
                            if (res.status==200) {
                                n.closest("tr").remove();
                                resolve(res.msg);
                            } else {
                                reject(res.msg);
                            }
                        },
                        error: function () {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                r(TDPromise);
            }
        });
    });    
    _thanhdieu.ws.on("click", ".discontinued-product", function (e) {
        e.preventDefault();
        var productId = $(this).data("product-id");
        var $btn = $(this);
    
        const TDPromise = new Promise(function (resolve, reject) {
            $.ajax({
                type: "POST",
                url: _thanhdieu.ajax,
                data: {
                    action: 'discontinued-product',
                    id_product: productId
                },
                dataType: "json",
                success: function (res) {
                    if (res.status === 200) {
                        const label = res.new_status == 1 ? "Ngừng Bán" : "Mở Bán Lại";
                        $btn.find("span").text(label);
                        const $statusTd = $('.product-status[data-product-id="' + productId + '"]');
                        if (res.new_status == 1) {
                            $statusTd.html('<span class="badge badge-dim rounded-pill bg-outline-success">Hoạt Động</span>');
                        } else {
                            $statusTd.html('<span class="badge badge-dim rounded-pill bg-outline-warning">Tạm Ngừng Bán</span>');
                        }
                        resolve(res.msg);
                    } else {
                        reject(res.msg);
                    }
                },
                error: function () {
                    reject("Mất kết nối đến máy chủ, vui lòng kiểm tra lại!");
                }
            });
        });
        Run(TDPromise);
    });
    _thanhdieu.ws.on('click', '.truncate-all-product', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Xác nhận hành động xoá tất cả đơn hàng, lưu ý không thể khôi phục lại đơn hàng khi bị xoá, bạn vẫn muốn tiếp tục?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            action: 'truncate-all-product'
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                $('table tbody').empty();
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });

    _thanhdieu.ws.on('click', '.truncate-all-history-product', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Cảnh Báo',
            text: 'Xác nhận hành động xoá tất cả lịch sử mua, nếu khách hàng đã mua đơn hàng thì mọi dữ liệu bên phía họ cũng sẽ biến mất, bạn có muốn tiếp tục?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Có, xoá ngay!'
        }).then((result) => {
            if (result.isConfirmed) {
                Wsloader(true);
                var TDPromise = new Promise(function(resolve, reject) {
                    $.ajax({
                        type: "post",
                        url: _thanhdieu.ajax,
                        data: {
                            action: 'truncate-all-history-product'
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                resolve(response.msg);
                            } else {
                                reject(response.msg);
                            }
                        },
                        error: function(xhr, status, error) {
                            reject("Mất kết nối đến máy chủ vui lòng kiểm tra lại!");
                        }
                    });
                });
                Run(TDPromise);
            }
        });
    });
}
$(document).ready(Administrator);