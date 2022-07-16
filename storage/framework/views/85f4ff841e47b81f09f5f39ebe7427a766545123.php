<h2>Student Update</h2>

<form action="<?php echo e(route('updateStudent')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="id" value="<?php echo e($student[0]['id']); ?>">
    <input type="text" name="name" placeholder="name" value="<?php echo e($student[0]['name']); ?>" required>
    <br><br>
    <select name="subject_id" id="subjects" required>
        <option value="">Select Subject</option>
        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($student[0]['subject_id'] == $subject->id): ?>
                <option value="<?php echo e($subject->id); ?>" selected><?php echo e($subject->name); ?></option>
            <?php else: ?>
                <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->name); ?></option>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>
    <select name="plan_id" id="plans" required>
        <option value="">Select Plan</option>
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($student[0]['plan_id'] == $plan->id): ?>
                <option value="<?php echo e($plan->id); ?>" selected><?php echo e($plan->plan); ?></option>
            <?php else: ?>
                <option value="<?php echo e($plan->id); ?>"><?php echo e($plan->plan); ?></option>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>
    <input type="submit" value="Update">
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

    $(document).ready(function(){

        $("#subjects").change(function(){

            var subject_id = $(this).val();
            if(subject_id == ""){
                $("#plans").html("<option value=''>Select Plan</option>");
            }

            $.ajax({
                url:"/get-plans/"+subject_id,
                type:"GET",
                success:function(data){
                    var plans = data.plans;
                    var html = "<option value=''>Select Plan</option>";
                    for(let i =0;i<plans.length;i++){
                        html += `
                        <option value="`+plans[i]['id']+`">`+plans[i]['plan']+`</option>
                        `;
                    }
                    $("#plans").html(html);
                }
            });

        });

    });

</script><?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/editStudent.blade.php ENDPATH**/ ?>