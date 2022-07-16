<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

        <form>
        <?php echo csrf_field(); ?>
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                <span class="email_err"></span>

                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                <span class="pswd_err"></span>

                <label for="address">Address:</label>
                <textarea class="form-control" name="address" id="address" placeholder="Address"></textarea>
                <span class="address_err"></span>
            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
        </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".btn-submit").click(function(e){
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var email = $("#email").val();
                var pswd = $("#pwd").val();
                var address = $("#address").val();

                $.ajax({
                    url: "<?php echo e(route('ajax.validation.store')); ?>",
                    type:'POST',
                    data: {_token:_token, email:email, pswd:pswd,address:address},
                    success: function(data) {
                    console.log(data.error)
                        if($.isEmptyObject(data.error)){
                            alert(data.success);
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                });
            }); 

            function printErrorMsg (msg) {
                $.each( msg, function( key, value ) {
                    console.log(key);
                    $('.'+key+'_err').text(value);
                });
            }
        });
    </script>
</body>
</html><?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/ajaxValidation.blade.php ENDPATH**/ ?>