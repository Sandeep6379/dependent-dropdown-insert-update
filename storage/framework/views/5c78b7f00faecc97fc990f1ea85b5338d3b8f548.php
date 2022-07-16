
<?php if($errors->any()): ?>
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
<?php endif; ?>

<form action="/insert" method="POST">
<?php echo csrf_field(); ?>
    <input type="text" name="name">
    <br><br>
    Ballibal<input type="checkbox" name="hobby[]" value="Balliball">
    Cricket<input type="checkbox" name="hobby[]" value="Cricket">
    Hockey<input type="checkbox" name="hobby[]" value="Hockey">
    <input type="submit">
</form><?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/form.blade.php ENDPATH**/ ?>