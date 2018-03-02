<script type="text/javascript">
$(document).ready(function(){

  // make height of product cards the same
  var heights = [];
  $('.blog-desc').each(function(){
  	heights.push($(this).height());
  });
  var maxHeights = Math.max.apply(null, heights);
  $('.blog-desc').each(function(){
  	$(this).height(maxHeights+'px');
  });

});
</script>