<table>
    <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Hobbies</th>
    </tr>

    <?php if(count($userData) > 0): ?>
        <?php $__currentLoopData = $userData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($data->id); ?></td>
            <td><?php echo e($data->name); ?></td>
            <td>
                <?php
                    $hobbies = json_decode($data->hobbies);
                ?>
                <?php $__currentLoopData = $hobbies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hobby): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($hobby); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <tr>
            <td colspan="3">No Data Found</td>
        </tr>
    <?php endif; ?>

</table><?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/data.blade.php ENDPATH**/ ?>