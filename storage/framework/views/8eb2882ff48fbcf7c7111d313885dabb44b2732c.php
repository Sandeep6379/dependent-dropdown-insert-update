<table>
    <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($row->id); ?></td>
            <td><?php echo e($row->name); ?></td>
            <td><?php echo e($row->email); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
  
<?php echo $data->links(); ?>


<?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/pagination_child.blade.php ENDPATH**/ ?>