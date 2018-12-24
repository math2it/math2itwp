<?php $elements = herald_woocommerce_cart_elements(); ?>
<?php if (!empty($elements)): ?>
<div class="herald-menu-popup-search herald-cart-icon">
	<a class="fa fa-shopping-cart herald-custom-cart" href="<?php echo $elements['cart_url']; ?>">
		<?php if( $elements['products_count'] > 0 ) : ?>
			<span class="herald-cart-count"><?php echo $elements['products_count']; ?></span>
		<?php endif; ?>
	</a>
</div>
<?php endif; ?>