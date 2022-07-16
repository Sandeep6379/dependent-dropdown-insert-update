<h2>Student Add</h2>
<form action="" method="POST">
    @csrf
    <input type="text" name="name" placeholder="name" required>
    <br><br>
    <select name="subject_id" id="subjects" required>
        <option value="">Select Subject</option>
        @foreach($subjects as $subject)
        <option value="{{ $subject->id }}">{{$subject->name}}</option>
        @endforeach
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
    @if(count($students) > 0)
        @foreach($students as $student)
            <tr>
                <td>{{$student->id}}</td>
                <td>{{$student->name}}</td>
                <td>{{$student['subject']['name']}}</td>
                <td>{{$student['plan']['plan']}}</td>
                <td><a href="edit-student/{{$student->id}}">Edit</a></td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="5">No Record Found!</td>
        </tr>
    @endif

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

</script>