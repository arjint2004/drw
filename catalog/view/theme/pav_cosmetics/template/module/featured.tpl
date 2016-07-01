<?php 
  $cols = 4;
  $span = 12/$cols;
?>
<div class="box box-product special highlighted nopadding">
  <div class="box-heading"><span><?php echo $heading_title; ?></span></div>
  <div class="box-content">
    <div class="box-product" >
        <?php foreach ($products as $i => $product) { ?>
         <?php if( $i++%$cols == 0 ) { ?>
          <div class="row">
        <?php } ?> 
<div class="col-lg-<?php echo $span;?> col-md-<?php echo $span;?> col-sm-6 col-xs-12">
                                <div class="product-block">

                                    <?php if ($product['thumb']) { ?>

                                    <div class="image">
                                        <?php if( $product['special'] ) {   ?>
                                            <span class="product-label-special label"><?php echo $this->language->get( 'text_sale' ); ?></span>
                                        <?php } ?>
                                        <?php if( $categoryPzoom ) { $zimage = str_replace( "cache/","", preg_replace("#-\d+x\d+#", "",  $product['thumb'] ));  ?>
                                            <a href="<?php echo $zimage;?>" class="colorbox product-zoom" rel="nofollow" title="<?php echo $product['name']; ?>"><span class="icon-zoom-in"></span></a>
                                        <?php } ?>
                                        <div class="face">
                                            <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>"></a>
                                        </div>
                                        <div class="faceback">
                                            <?php
                                            if( $categoryConfig['show_swap_image'] ){
                                            $product_images = $this->model_catalog_product->getProductImages( $product['product_id'] );
                                            if(isset($product_images) && !empty($product_images)) {
                                            $thumb2 = $this->model_tool_image->resize($product_images[0]['image'],  $this->config->get('config_image_product_width'),  $this->config->get('config_image_product_height') );
                                            ?>
                                            <a class="img back" href="<?php echo $product['href']; ?>">
                                                    <img src="<?php echo $thumb2; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>">
                                            </a>
                                            <?php } } ?>
                                        </div>
                                        <div class="product_quickview">
                                            <?php //#2 Start fix quickview in fw?>
                                            <?php if ($quickview) { ?>
                                                <a class="pav-colorbox" href="<?php echo $this->url->link("themecontrol/product",'product_id='.$product['product_id'] );?>"><span class="glyphicon glyphicon-eye-open"></span><?php echo $this->language->get('Quick View'); ?></a>
                                            <?php } ?>
                                            <?php //#2 End fix quickview in fw?>
                                        </div>

                                    </div>
                                    <?php } ?>
                                    <div class="product-meta">
                                        <h3 class="name"><a
                                                href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></h3>
                                        <div class="description">
                                            <?php echo utf8_substr( strip_tags($product['description']),0,100);?>
                                            ...
                                        </div>
                                        <?php if ($product['rating']) { ?>
                                        <div class="rating"><img
                                                    src="catalog/view/theme/<?php echo $this->config->get('config_template');?>/image/stars-<?php echo $product['rating']; ?>.png"
                                                    alt="<?php echo $product['reviews']; ?>"/></div>
                                        <?php } ?>
                                        <?php if ($product['price']) { ?>
                                        <div class="price">
                                            <?php if (!$product['special']) { ?>
                                            <?php echo $product['price']; ?>
                                            <?php } else { ?>
                                            <span class="price-old"><?php echo $product['price']; ?></span> <span
                                                    class="price-new"><?php echo $product['special']; ?></span>
                                            <?php } ?>
                                        </div>
                                        <?php } ?>

                                        <div class="product-hover">
                                            <div class="cart">
                                                <input type="button" value="<?php echo $button_cart; ?>"
                                                       onclick="addToCart('<?php echo $product['product_id']; ?>');"
                                                       class="button"/>
                                            </div>

                                            <div class="wishlist"><a class="icon-heart"
                                                                     onclick="addToWishList('<?php echo $product['product_id']; ?>');"
                                                                     data-placement="top" data-toggle="tooltip"
                                                                     data-original-title="<?php echo $this->language->get("button_wishlist");?>"><span><?php echo $this->language->get("button_wishlist"); ?></span></a></div>
                                            <div class="compare"><a class="icon-retweet"
                                                                    onclick="addToCompare('<?php echo $product['product_id']; ?>');"
                                                                    data-placement="top" data-toggle="tooltip"
                                                                    data-original-title="<?php echo $this->language->get("button_compare"); ?>"><span><?php echo $this->language->get("button_compare"); ?></span></a></div>
                                        </div>
                                    </div>


                                </div>
                            </div>
        
       <?php if( $i%$cols == 0 || $i==count($products) ) { ?>
         </div>
        <?php } ?>
      
        <?php } ?>

    </div>
  </div>
   </div>
