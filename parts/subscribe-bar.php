<section class="subscribe-bar">
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12">
		<div class="form">
			<div class="newsletter-text">
				Nhận bài qua email?
			</div>
			<form method="post" class="newsletter-form" action="<?php echo get_bloginfo( 'wpurl' ) ?>/?na=s" onsubmit="if (!window.__cfRLUnblockHandlers) return false; return newsletter_check(this)">
				<input type="hidden" name="nlang" value="">
        <input type="hidden" name="nr" value="page">
        <input type="text" name="nn" placeholder="Tên bạn" class="name">
				<input type="email" name="ne" placeholder="Email bạn" class="email">
				<input type="submit" value="OK" class="submit">
			</form>
		</div>
		</div>
	</div>
</div>
</section>
