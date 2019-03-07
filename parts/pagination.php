<?php
// pagination
if ($number_of_pages > 1):?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <?php
          echo '<div class="paginate-links">';
            echo paginate_links( $pag_arg );
          echo '</div>';
        ?>
      </div>
    </div>
  </div>
<?php
endif;
?>