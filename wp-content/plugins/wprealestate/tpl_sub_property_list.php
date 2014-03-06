<?php 
function tpl_carrousel($the_query)
{
	?>
<script type="text/javascript">
jQuery(window).load(function() {
  // The slider being synced must be initialized first
  jQuery('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 155,
    itemMargin: 5,
    asNavFor: '#slider'
  });
   
  jQuery('#slider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel"
  });
});
</script>

<div id="slider" class="flexslider">
  <ul class="slides">
    <?php
        while ( $the_query->have_posts() ) : 
        $the_query->the_post(); 
        ?>
    <li>
      <?php $property_imgs = get_property_images_ids(); 
                echo wp_get_attachment_image($property_imgs['property_image1'], 'full'); 
            ?>
      <div class="flex-caption">
        <h1><a href="<?php echo get_permalink( $ID ); ?>">
          <?php  the_title();?>
          </a> </h1>
        <?php the_excerpt();?>
      </div>
    </li>
    <?php 
        endwhile;	
        wp_reset_query();	
        ?>
  </ul>
</div>
<div id="carousel" class="flexslider">
  <ul class="slides">
    <?php
        while ( $the_query->have_posts() ) : 
        $the_query->the_post(); 
        ?>
    <li>
      <?php $property_imgs = get_property_images_ids(); 
                echo wp_get_attachment_image($property_imgs['property_image1'], 'thumbnail'); 
            ?>
    </li>
    <?php 
        endwhile;	
        wp_reset_query();	
        ?>
  </ul>
</div>
<?
	}

  function tpl_sub_property_list($ID) 
 {
 $post = get_post( $ID );
// var_dump($post);
//setup_postdata( $post );
$pro_ad_type = get_post_meta($ID, 'et_er_adtype', true);
?>
<div id="PropertyQuickView">
  <div class="QVImage">
    <?php $property_imgs = get_property_images_ids(true,$ID);?>
    <a href="<?php echo  get_permalink( $ID );  ?>" title="<?php echo get_the_title($ID); ?>"> <?php echo wp_get_attachment_image($property_imgs['property_image1'], 'thumbnail'); ?></a> </div>
  <div class="QVProInfo">
    <h2><a href="<?php echo get_permalink( $ID ); ?>"> <?php echo get_the_title($ID); ?> </a></h2>
    <br style="clear:right;" />
    <div class="meta"> Property ID: <?php echo $ID; ?> <br>
      <?php if (get_post_meta($ID, 'et_er_built_size', true) <> '0') { ?>
      Built Up: <?php echo get_post_meta($ID, 'et_er_built_size', true); ?><br>
      <?php } ?>
      For <?php echo $pro_ad_type; ?> : <?php echo ET_RE_Currency.number_format( get_post_meta($ID, 'et_er_price', true)); ?><br>
      <?php if (get_post_meta($ID, 'et_er_bedroom', true) <> 'Not Applicable') { ?>
      Bedrooms: <?php echo get_post_meta($ID, 'et_er_bedroom', true); ?><br>
      <?php }
	  if (get_post_meta($ID, 'et_er_bathroom', true) <> 'Not Applicable') { ?>
      Bathrooms: <?php echo get_post_meta($ID, 'et_er_bathroom', true); ?><br>
      <?php } ?>
      <div style="float:left; width:100px; bottom:0px;"><a href="<?php echo get_permalink( $ID ); ?>"><img src="<?php echo ET_RE_URL; ?>/images/view_details_button.gif" /></a></div>
    </div>
    <div class="QVProText"> <?php echo $post->post_excerpt;?> </div>
  </div>
</div>
<br style="clear:both;" />
<div class="SpacerDiv"></div>
<?php 
// wp_reset_postdata();
}


function tpl_show_breadcrumb()
{
	?>
<div class="breadcrumbs">
  <?php if(function_exists('bcn_display'))
    {
        bcn_display();
    }?>
</div>
<?php 
}
 ?>
