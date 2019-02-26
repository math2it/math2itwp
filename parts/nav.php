<nav class="navbar nav-bg navbar-custom">
  <div class="container">
    <?php header_nav(); ?> <!-- in functions-files/nav.php -->
    <div class="nav-search">
      <form action="/" method="get">
        <input name="s" class="mr-2 nav-search-input" type="search" placeholder="tìm bài viết..." aria-label="tìm bài viết...">
        <button class="nav-search-submit" type="submit">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </form>
    </div>
  </div> <!-- /.container -->
</nav>
