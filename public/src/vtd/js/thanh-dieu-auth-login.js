/**
 * ThanhDieu Auth Login Handler
 * Binds submit on .user-auth-login forms to /function/handle/login.php
 * Preserves existing flow; only intercepts when form has class user-auth-login.
 */
(function () {
  'use strict';

  var handler = null;

  function getAuthData($form) {
    var authValue = $form.find('input[name="auth"]').val() || 'user-auth-login';
    var username = $form.find('input[name="username"]').val().trim() || '';
    var password = $form.find('input[name="password"]').val() || '';
    var rememberMe = $form.find('input[name="remember-me"]').is(':checked') ? 'on' : 'off';

    var oauth = {
      auth: authValue,
      username: username,
      password: password,
      'remember-me': rememberMe
    };

    return {
      action: '_auth',
      _auth: JSON.stringify(oauth)
    };
  }

  function showError(msg) {
    if (typeof cuteAlert === 'function') {
      try { cuteAlert('error', msg, 3000); } catch (e) {}
    } else if (typeof swal === 'function') {
      try { swal('Lỗi', msg, 'error'); } catch (e) {}
    } else {
      alert(msg);
    }
  }

  function handleResponse(data) {
    if (!data || typeof data !== 'object') {
      showError('Phản hồi không hợp lệ. Vui lòng thử lại.');
      return;
    }
    var status = data.status;
    if (status === 200 || status === 'success' || data.status === '200') {
      // Đăng nhập thành công — reload hoặc redirect về trang trước
      var redirectUrl = ThanhDieuHandle && ThanhDieuHandle.root_path ? '/' : '/';
      try {
        if (typeof window.history.replaceState === 'function') {
          window.history.replaceState({}, '', redirectUrl);
        }
      } catch (e) {}
      // Reload 페이지 để cập nhật trạng thái đăng nhập
      window.location.reload();
    } else {
      var msg = data.msg || data.message || 'Đăng nhập thất bại. Vui lòng kiểm tra lại.';
      showError(msg);
    }
  }

  function submitLoginForm(e) {
    var $form = $(this);
    if (!$form.hasClass('user-auth-login')) return;

    e.preventDefault();

    var $btn = $form.find('button[type="submit"], input[type="submit"]').first();
    var originalText = $btn.text();
    $btn.prop('disabled', true).text('Đang xử lý...');

    var postData = getAuthData($form);

    $.ajax({
      url: '/function/handle/login.php',
      type: 'POST',
      data: postData,
      dataType: 'json',
      timeout: 15000,
      success: function (resp) {
        $btn.prop('disabled', false).text(originalText);
        handleResponse(resp);
      },
      error: function (jqXHR, textStatus, errorThrown) {
        $btn.prop('disabled', false).text(originalText);
        var msg = 'Không thể kết nối đến máy chủ. Vui lòng kiểm tra mạng và thử lại.';
        if (textStatus === 'timeout') {
          msg = 'Yêu cầu bị hết thời gian. Vui lòng thử lại.';
        } else if (textStatus === 'parsererror') {
          msg = 'Lỗi phản hồi từ máy chủ. Vui lòng thử lại.';
        }
        showError(msg);
      }
    });
  }

  function init() {
    // Gắn sự kiện cho các form đăng nhập hiện có
    $(document).on('submit', 'form.user-auth-login', submitLoginForm);

    // Nếu form đăng nhập đã tồn tại khi trang load
    $('form.user-auth-login').each(function () {
      $(this).off('submit.user-auth-login').on('submit.user-auth-login', submitLoginForm);
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
