<h2>Student Add</h2>
<form action="" method="POST">
    <?php echo csrf_field(); ?>
    <input type="text" name="name" placeholder="name" required>
    <br><br>
    <select name="subject_id" id="subjects" required>
        <option value="">Select Subject</option>
        <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <br><br>
    <select name="plan_id" id="plans" required>
        <option value="">Select Plan</option>
    </select>
    <br><br>
    <input type="submit">
</form>

<table border=1 width="100%" cellspacing="0">

    <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Subject</th>
        <th>Plan</th>
        <th>Action</th>
    </tr>
    <?php if(count($students) > 0): ?>
        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($student->id); ?></td>
                <td><?php echo e($student->name); ?></td>
                <td><?php echo e($student['subject']['name']); ?></td>
                <td><?php echo e($student['plan']['plan']); ?></td>
                <td><a href="edit-student/<?php echo e($student->id); ?>">Edit</a></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No Record Found!</td>
        </tr>
    <?php endif; ?>

</table>


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

</script><?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/student.blade.php ENDPATH**/ ?>