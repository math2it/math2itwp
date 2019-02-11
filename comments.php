<div id="disqus_thread"></div>
<?php $disqus_line = '//'.get_option('site_disqus').'.disqus.com/embed.js'; ?>
<script>
  (function() {
    var d = document, s = d.createElement('script');
    s.src = "<?php echo $disqus_line; ?>";
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
  })();
</script>