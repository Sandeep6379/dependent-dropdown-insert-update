<h2>Student Update</h2>

<form action="{{route('updateStudent')}}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$student[0]['id']}}">
    <input type="text" name="name" placeholder="name" value="{{$student[0]['name']}}" required>
    <br><br>
    <select name="subject_id" id="subjects" required>
        <option value="">Select Subject</option>
        @foreach($subjects as $subject)
            @if($student[0]['subject_id'] == $subject->id)
                <option value="{{ $subject->id }}" selected>{{$subject->name}}</option>
            @else
                <option value="{{ $subject->id }}">{{$subject->name}}</option>
            @endif
        @endforeach
    </select>
    <br><br>
    <select name="plan_id" id="plans" required>
        <option value="">Select Plan</option>
        @foreach($plans as $plan)
            @if($student[0]['plan_id'] == $plan->id)
                <option value="{{ $plan->id }}" selected>{{$plan->plan}}</option>
            @else
                <option value="{{ $plan->id }}">{{$plan->plan}}</option>
            @endif
        @endforeach
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

</script>