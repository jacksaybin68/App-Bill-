<?php if (array_filter(['/dang-ky', '/dang-nhap', '/login','/signIn','/register','/signUp'], fn($keyword) => strpos($current_url, $keyword)==0)): ?>
<data id="gt" value="<?=$TD->Setting('id-geetest')?>"></data>
<data id="public-key" value="<?=$wtSecurity->publicKey;?>"></data>
<?php endif; ?>
<script src="/<?=__LIBRARY__?>/jquery/jquery-3.7.1.min.js"></script>
<script src="/<?=__LIBRARY__?>/jquery.pjax/jquery.pjax.min.js"></script>
<script src="/<?=__LIBRARY__?>/toast@1.0.1/fuiToast.min.js"></script>
<script src="/<?=__LIBRARY__?>/toast-cute/cute-alert.js"></script>
<script src="/<?=__LIBRARY__?>/jsencrypt/jsencrypt.min.js"></script>
<script src="/<?=__LIBRARY__?>/sweetalert@2.1.2/sweetalert.min.js"></script>
<script src="//cdn.plyr.io/3.7.8/plyr.js"></script>
<script src="/<?=__LIBRARY__?>/fancybox/fancybox.umd.js"></script>
<script src="/<?=__LIBRARY__?>/lazysizes/lazysizes.min.js" async></script>
<script src="/<?=__JS__?>/wt-customize.min.js?v=<?=$TD->Setting('cache')?><?=rand(111111,2222222222);?>"></script>
<?php if (strpos($current_url, '/dang-ky') !== false): ?>
<script src="/<?=__LIBRARY__?>/captcha/gt4.js"></script>
<script src="/<?=__LIBRARY__?>/captcha/gt4-vh.js"></script>
<?php endif; ?>
<script src="/<?=__JS__?>/wt-upload.min.js?v=<?=$TD->Setting('cache')?>.343"></script>
<script src="/<?=__JS__?>/main.min.js?v=<?=rand(111111,2222222222);?>"></script>
<!--
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/685664936944b71916207e7a/1iu8nhord';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
-->
</body>
</html>