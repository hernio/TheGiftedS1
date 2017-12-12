<?php 
$url = file_get_contents($_GET['id']);
$mp4u = explode('transcode_remote%22%3A%22transcoded%2F', $url);
$mp4u = explode('.mp4%22%2C%22width', $mp4u[1]);
$link = ('https://cldup.com/'.$mp4u[0]);
?>
<!DOCTYPE html><html><head><title>CloudUp</title>
<link rel="icon" href="../images/favicon.gif" type="image/x-icon"/>
<meta name="robots" content="noindex"/><meta name="googlebot" content="noindex"/>
<meta name="referrer" content="never"/><meta name="referrer" content="no-referrer"/>
<script src="//ssl.p.jwpcdn.com/player/v/7.11.2/jwplayer.js"></script>
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<style>*{margin:0px;}html{overflow:hidden;}</style>
</head><body><div id="cdlp"></div><script>
jwplayer.key = "XsWyeNQ1jdztTqhiD5MXEpz37wrnHdV05j7Ocg==";
var Cdlplay = jwplayer("cdlp");
Cdlplay.setup({
sources: [{'file':'<?php  echo $link ?>','type':'video/mp4'}],
preload: 'auto',
primary: 'html5',
width: $(window).width(),
height: $(window).height()
})
$(document).ready(function(){
$(window).resize(function(){
jwplayer().resize($(window).width(),$(window).height())
})
})
</script></body></html>
