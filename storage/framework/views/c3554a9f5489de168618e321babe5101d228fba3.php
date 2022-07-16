<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body> 
   
<div class="container">
   
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Body</th>
        </tr>
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($post->id); ?></td>
            <td><?php echo e($post->title); ?></td>
            <td><?php echo e($post->body); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
    <a href="<?php echo e($posts->nextPageUrl()); ?>">Next</a>
    <a href="<?php echo e($posts->previousPageUrl()); ?>">Previous</a>
</div>
   
</body>
</html><?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/posts.blade.php ENDPATH**/ ?>