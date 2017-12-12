<?php 
//yourplayer.us - info@yourplayer.us
$dt_player = get_post_meta($post->ID, 'repeatable_fields', true); 
$width = get_option('dt_width_layout','1100'); 
$light = get_option('dt_player_luces','true');
$report = get_option('dt_player_report','true');
$ads = get_option('dt_player_ads','not');
$qual = get_option('dt_player_quality','true');
$viewsc = get_option('dt_player_views','true');
$clic = get_option('dt_player_ads_hide_clic','true');
$time = get_option('dt_player_ads_time','20');
$ads_300 = get_option('dt_player_ads_300');
// Reportar templante
get_template_part('inc/parts/single/report-video'); 
// Player
?>
<div id="playex" class="player_sist">
	<?php  if ( $dt_player ) : ?>
	<div class="playex">
		<?php  if ($ads =='true') : ?>
		<div id="playerads" class="ads_player">
			<div class="ads_box">
				<div class="ads">
					<?php if($ads_300) : echo '<div class="code">'. stripslashes($ads_300). '</div>'; endif; ?>
					<?php if ($clic =='true'): ?><span class="notice"><?php _e('click on ad to close','mtms'); ?></span><?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php $numerado = 1; { foreach ( $dt_player as $field ) { ?>
		<?php if($field['select'] == 'iframe') {  ?>
			<div id="option-<?php echo $numerado; ?>" class="play-box-iframe fixidtab">
				<iframe src="<?php echo $field['url']; ?>" frameborder="0" allowfullscreen></iframe>
			</div>
		<?php } if($field['select'] == 'mp4') {  ?>
			<div id="option-<?php echo $numerado; ?>" class="play-box-iframe fixidtab">
				
<?php
//yourplayer.us - info@yourplayer.us
$inboxf = $field['url'];

    $plain_txt = base64_encode($inboxf);
    $string = $plain_txt;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key); 
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    $encrypted_txt = $output;
    $urlen = $encrypted_txt;
//yourplayer.us - info@yourplayer.us	
?>
<iframe style="border:0px #FFFFFF none;" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="480" width="100%" src="//yourplayer.us/e/wp-embed.php?url=<?php echo $urlen; ?>" allowfullscreen></iframe>


			</div>
		<?php } if($field['select'] == 'dtshcode') {  ?>
			<div id="option-<?php echo $numerado; ?>" class="play-box-shortcode fixidtab">
				<?php echo do_shortcode($field['url']); ?>
			</div>
		<?php } $numerado++; } } ?> 
	</div>
	<?php endif; ?>
	<div class="control">
		<nav class="player">
			<ul class="options">
				<li>
					<a><i class="icon-menu"></i> <b><?php _e('Options','mtms'); ?></b></a>
					<?php  if ( $dt_player ) : ?>
						<ul class="idTabs">
						<?php $numerado = 1; { foreach ( $dt_player as $field ) { ?>
							<li><a href="#option-<?php echo $numerado; ?>"><?php echo $field['name']; ?> </a></li>
						<?php $numerado++; } } ?> 
						</ul>
					<?php endif; ?>
				</li>
			</ul>
		</nav>
		<?php if ($qual =='true') : if($quali = $terms = strip_tags( $terms = get_the_term_list( $post->ID, 'dtquality'))) {  ?><span class="qualityx">HD</span><?php } endif; ?>
		<?php if ($viewsc =='true') : if($views = dt_get_meta('dt_views_count')) { echo '<span class="views"><strong>'. $views .'</strong> '. __('Views','mtms') .'</span>'; } endif; ?>
		<nav class="controles">
			<ul class="list">
				<?php  if ($ads =='true') : ?><li id="count" class="contadorads"><?php _e('Ad','mtms'); ?> <i id="contador"><?php echo $time; ?></i></li><?php endif; ?>
				<?php  if ($light =='true') : ?><li><a class="lightSwitcher" href="javascript:void(0);"><i class="icon-wb_sunny"></i></a></li><?php endif; ?>
				<?php  if ($report =='true') : ?><li><a class="report-video"><i class="icon-textsms"></i></a></li><?php endif; ?>
			</ul>
		</nav>
	</div>
	<?php if($_GET[ 'report' ] =='send') { send_report(); } ?>
</div>
<script type='text/javascript'>
	$(document).ready(function(){
	$("#oscuridad").css("height", $(document).height()).hide();
	$(".lightSwitcher").click(function(){
	$("#oscuridad").toggle();
	if ($("#oscuridad").is(":hidden"))
	$(this).html("<i class='icon-wb_sunny'></i>").removeClass("turnedOff");
		else
	$(this).html("<i class='icon-wb_sunny'></i>").addClass("turnedOff");
		});
	});
<?php  if ($ads =='true') : ?>
	var segundos = <?php echo $time; ?>; 
	function ads_time(){  
		var t = setTimeout("ads_time()",1000);  
			document.getElementById('contador').innerHTML = '' +segundos--+'';  
		if (segundos==0){
			$('#playerads').fadeOut('slow');
			$('#count').fadeOut('slow');
			clearInterval(setTimeout);
		}  
	}  
	ads_time();
<?php endif; ?>
<?php if ($clic =='true'): ?>
		$(".code").click(function() {
		  $("#playerads").fadeOut("slow");
		  $("#count").fadeOut("slow");
		});
		$(".notice").click(function() {
		  $("#playerads").fadeOut("slow");
		  $("#count").fadeOut("slow");
		});
<?php
//yourplayer.us - info@yourplayer.us


 endif; ?>
</script>


