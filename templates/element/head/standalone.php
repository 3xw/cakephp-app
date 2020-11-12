<link rel="manifest" href="<?= $fullBase.$folder ?>manifest.json">

<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="white">

<script type="text/javascript">
(function (document, navigator, standalone) { if ((standalone in navigator) && navigator[standalone]) { var curnode, location = document.location, stop = /^(a|html)$/i; document.addEventListener('click', function (e) { curnode = e.target; while (!(stop).test(curnode.nodeName)) { curnode = curnode.parentNode; } if ('href' in curnode && (curnode.href.indexOf('http') || ~curnode.href.indexOf(location.host))) { e.preventDefault(); location.href = curnode.href; } }, false); } })(document, window.navigator, 'standalone');
</script>
