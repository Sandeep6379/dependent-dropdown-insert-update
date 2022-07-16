<?php if($errors->any()): ?>
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>

<?php if(\Session::has('error')): ?>
    <p><?php echo e(\Session::get('error')); ?></p>
<?php endif; ?>

<form action="<?php echo e(route('loginUser')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="email" name="email" placeholder="Enter Email">
    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    <br><br>
    <input type="submit" value="Login">
</form><?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/login.blade.php ENDPATH**/ ?>