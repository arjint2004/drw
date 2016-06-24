<?php if( count($testimonials) ) { ?>
	<?php $id = rand(1,10)+rand();?>
   <div id="pavtestimonial<?php echo $id;?>" class="box carousel slide pavtestimonial">
    <div class="box-heading"><span>Testimoni Pelanggan</span></div>
		<div class="carousel-inner">
			 <?php foreach ($testimonials as $i => $testimonial) {  ?>
				<div class="item <?php if($i==0) {?>active<?php } ?>">
	 				<div class="testimonial-item">
						<?php if(  $testimonial['description'] ) { ?>
						<div class="testimonial">
							<div class="testimonial-info">
                                <span class="icon-quote-left icon pull-left"></span>
                                <div class="description pull-left"><?php echo $testimonial['description']; ?></div>
                            </div>
						</div>
						<?php } ?>
                        <div class="avatar-profile">
                            <div class="t-avatar pull-left"><img alt="<?php echo utf8_substr( strip_tags($testimonial['profile']),0,10);?>..." src="<?php echo $testimonial['thumb']; ?>" class="img-circle"/></div>
                            <?php if(  $testimonial['profile'] ) { ?>
                                <div class="profile pull-left">
                                    <div><?php echo $testimonial['profile']; ?></div>
                                </div>
                            <?php } ?>
                            <?php if( $testimonial['video_link']) { ?>
                                <a class="colorbox-t" href="<?php echo $testimonial['video_link'];?>"><?php echo $this->language->get('text_watch_video_testimonial');?></a>
                            <?php } ?>
                        </div>
					</div>
				</div>
			<?php } ?>
		</div>
	 		
		<?php if( count($testimonials) > 1 ){ ?>	
		<a class="carousel-control left" href="#pavtestimonial<?php echo $id;?>" data-slide="prev">&lsaquo;</a>
		<a class="carousel-control right" href="#pavtestimonial<?php echo $id;?>" data-slide="next">&rsaquo;</a>
		<?php } ?>
    </div>
	<?php if( count($testimonials) > 1 ){ ?>
	<script type="text/javascript">
	<!--
		$('#pavtestimonial<?php echo $id;?>').carousel({interval:<?php echo ( $auto_play_mode?$interval:'false') ;?>,auto:<?php echo $auto_play;?>,pause:'hover'});
	-->
	</script>
	<?php } ?>
	<script type="text/javascript"><!--
		$(document).ready(function() {
		  $('.colorbox-t').colorbox({iframe:true, innerWidth:640, innerHeight:390});
		});
//--></script> 
<?php } ?>
