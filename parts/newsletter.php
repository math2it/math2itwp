<section class="section" id="newsletter">
  <div class="container">

    <div class="row list-of-post justify-content-center">
      <div class="col-12 col-xl-10">
        <div class="container">
          <div class="row align-items-center justify-content-md-center">
            <div class="col-12">
              <div class="newsletter">
                <div class="photo">
                  <img src="<?php echo  get_template_directory_uri() ?>/img/send.png">
                </div>
                <div class="form">
                  <div class="newsletter-text">
                    Cập nhật bài đăng mới qua email?
                  </div>
                  <form method="post" class="newsletter-form" action="<?php echo get_bloginfo( 'wpurl' ) ?>/?na=s" onsubmit="if (!window.__cfRLUnblockHandlers) return false; return newsletter_check(this)">
                    <input type="hidden" name="nlang" value="">
                    <input type="hidden" name="nr" value="page">
                    <input class="name" type="text" name="nn" placeholder="Tên bạn">
                    <input type="email" name="ne" placeholder="Email của bạn" class="email">
                    <input type="submit" value="OK" class="submit">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
