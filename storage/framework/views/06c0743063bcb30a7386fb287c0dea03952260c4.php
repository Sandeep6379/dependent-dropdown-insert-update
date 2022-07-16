<?php if($errors->any()): ?>
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
<?php endif; ?>

<form action="<?php echo e(route('registerUser')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="text" name="name" placeholder="Enter Name">
    <br><br>
    <input type="email" name="email" placeholder="Enter Email">
    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    <br><br>
    <input type="password" name="password_confirmation" placeholder="Enter Confirm Password">
    <br><br>
    <input type="submit" value="Register">
</form>
<?php if(\Session::has('success')): ?>
        <ul>
            <li><?php echo \Session::get('success'); ?></li>
        </ul>
<?php endif; ?><?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/register.blade.php ENDPATH**/ ?>