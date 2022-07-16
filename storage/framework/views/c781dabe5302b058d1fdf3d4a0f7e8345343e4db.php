
<html>
 <head>
  <title>Laravel 6 Pagination with Next Previous Button Link using Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 </head>
 <body>
     <?php echo csrf_field(); ?>
     <div id="table_data">
    <?php echo $__env->make('pagination_child', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   </div>
 </body>
</html>


<script>
$(document).ready(function(){

 $(document).on('click', '.relative', function(event){
    event.preventDefault(); 
    var page = $(this).attr('href').split('page=')[1];
    fetch_data(page);
 });

 function fetch_data(page)
 {
  var _token = $("input[name=_token]").val();
  $.ajax({
      url:"<?php echo e(route('pagination.fetch')); ?>",
      method:"POST",
      data:{_token:_token, page:page},
      success:function(data)
      {
       $('#table_data').html(data);
      }
    });
 }

});
</script> <?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/pagination_parent.blade.php ENDPATH**/ ?>