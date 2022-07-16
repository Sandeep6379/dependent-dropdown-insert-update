

<?php $__env->startSection('main-section'); ?>

    <div class="container">
        <a href="/logout">Logout</a>
        <form action="<?php echo e(route('addMeeting')); ?>" method="POST">
            
            <div class="row">
                <div class="col-sm-3">
                    <label for="">Location</label><br>
                    <input type="text" name="location" id="location" required class="form-control">
                </div>
                <div class="col-sm-3">
                    <label>Client Name</label><br>
                    <input type="text" name="name" placeholder="Client Name" required class="form-control">
                </div>
                <?php echo csrf_field(); ?>
                <div class="col-sm-3">
                    <label>Meeting Time Duration</label><br>
                    <input type="number" name="time" placeholder="Meeting Time (minutes)" required class="form-control">
                    <span>Available (09:00 am to 06:00 pm)</span>
                </div>
                <div class="col-sm-3">
                    <label>Date Add/View</label><br>
                    <input type="date" name="date" id="date" required class="form-control">
                </div>
            </div>

            <input type="text" id="latitude" name="latitude">
            <input type="text" id="longitude" name="longitude">
            <input type="text" id="ip" name="ip">
            <input type="text" id="city" name="city">
            <input type="text" id="dtime" name="dtime">

            <div class="row">
                <div class="col">
                    <input type="submit" class="btn btn-primary">
                </div>
            </div>
            
        </form>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Meeting Time</th>
                            <th>Distance Time</th>
                            <th>Distance KM</th>
                            <th>Current KM</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <?php if(count($meetingsData) > 0): ?>
                            <?php $__currentLoopData = $meetingsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr onclick="showMap(<?php echo e($meeting->latitude); ?>,<?php echo e($meeting->longitude); ?>)">
                                    <td><?php echo e($meeting->id); ?></td>
                                    <td><?php echo e($meeting->name); ?></td>
                                    <td><?php echo e($meeting->location); ?></td>
                                    <td><?php echo e($meeting->latitude); ?></td>
                                    <td><?php echo e($meeting->longitude); ?></td>
                                    <td><?php echo e($meeting->meeting_time); ?></td>
                                    <td><?php echo e($meeting->distance_time); ?></td>
                                    <td><?php echo e($meeting->distance_km); ?> KM</td>
                                    <td><?php echo e($meeting->current_km); ?> KM</td>
                                    <td><?php echo e($meeting->date); ?></td>
                                    <td>
                                        <select name="status" class="status_change" data-id="<?php echo e($meeting->id); ?>">
                                            <option value="0" <?php if($meeting->status == 0): ?> selected <?php endif; ?>>Pending</option>
                                            <option value="1" <?php if($meeting->status == 1): ?> selected <?php endif; ?>>Completed</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No meeting Data found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- show map -->
    <div class="container mb-5">
    <div id="map" style="width:100%;height:300px;"></div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            var autocomplete;
            var to = 'location';
            autocomplete = new google.maps.places.Autocomplete((document.getElementById(to)),{
                types:['geocode'],
            });
                google.maps.event.addListener(autocomplete,'place_changed',function(){
                var near_place = autocomplete.getPlace();
                
                jQuery("#latitude").val(near_place.geometry.location.lat());
                jQuery("#longitude").val(near_place.geometry.location.lng());
                
                $.getJSON("https://api.ipify.org?format=json",function(data) {
                    ip = data.ip;
                    jQuery("#ip").val(ip);
                    getCity();
                });

            });

            $("#date").change(function(){
                $(".tbody").html('');
                var date = $(this).val();
                $.ajax({
                    url:"<?php echo e(route('getDateMeetings')); ?>",
                    type:"GET",
                    data:{'date':date},
                    success:function(data){
                        var html ='';
                        var meetings = data.data;
                        if(meetings.length > 0){
                            for(let i=0;i<meetings.length;i++){
                                html+=`
                                    <tr onclick="showMap(`+meetings[i]['latitude']+`,`+meetings[i]['longitude']+`)">
                                        <td>`+meetings[i]['id']+`</td>
                                        <td>`+meetings[i]['name']+`</td>
                                        <td>`+meetings[i]['location']+`</td>
                                        <td>`+meetings[i]['latitude']+`</td>
                                        <td>`+meetings[i]['longitude']+`</td>
                                        <td>`+meetings[i]['meeting_time']+`</td>
                                        <td>`+meetings[i]['distance_time']+`</td>
                                        <td>`+meetings[i]['distance_km']+`</td>
                                        <td>`+meetings[i]['current_km']+`</td>
                                        <td>`+meetings[i]['date']+`</td>
                                        <td>
                                            <select name="status" class="status_change" data-id="`+meetings[i]['id']+`">
                                `;

                                if(meetings[i]['status'] == 0){
                                        html +=`<option value="0" selected>Pending</option>
                                                <option value="1">Completed</option>
                                            </select>
                                        </td>
                                    </tr>`;
                                }
                                else{
                                    html +=`<option value="0">Pending</option>
                                                <option value="1" selected>Completed</option>
                                            </select>
                                        </td>
                                    </tr>`;
                                }
                            }
                        }
                        else{
                            html +=`
                                <tr>
                                    <td colspan="9">No Meeting Found!</td>
                                </tr>
                            `;
                        }
                        $(".tbody").html(html);
                    }
                });
            });


            $(document).on("change",".status_change",function(){
                
                var id = $(this).attr('data-id');
                var status = $(this).val();

                $.ajax({
                    url:"<?php echo e(route('updateStatus')); ?>",
                    type:"GET",
                    data:{'id':id,'status':status},
                    success:function(data){
                        console.log(data.msg);
                    }
                });
            });

        });

        function getCity(){
            var req = new XMLHttpRequest();
            req.open("GET","http://ip-api.com/json/"+ip,true);
            req.send();
            
            req.onreadystatechange = function(){
                if(req.readyState == 4 && req.status == 200){
                    var obj = JSON.parse(req.responseText);
                    jQuery("#city").val(obj.city);
                    calculateDistance();
                }
            };
        }

        //for calculating travelling distance
    function calculateDistance(){

        var to = jQuery("#city").val();
        console.log(to);
        var from = jQuery("#location").val();
        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix({
            origins: [to],
            destinations:[from],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.metric, //kilometers and meters
            avoidHighways:false,
            avoidTolls: false
        }, callback);
    }

    //get distance results

  function callback(response, status){
        if(status != google.maps.DistanceMatrixStatus.OK){
            // $('#result').html(err);
        }   
        else{
          var to = response.originAddresses[0];
          console.log(to);
          var from = response.destinationAddresses[0];
          if(response.rows[0].elements[0].status == "ZERO_RESULTS"){
                // $("#result").html("Better get on a Plane. There are no roads between "+to+" and "+from);
          }
          else{
            var distance = response.rows[0].elements[0].distance;
            var duration = response.rows[0].elements[0].duration;
            var distance_in_kilo = distance.value / 1000;  //the kilometers
            var time_in_minutes = duration.value/60;
            jQuery("#dtime").val(parseInt(time_in_minutes));
          }
        }
  }
    </script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBS7f6LxaUI4rKrBnmJ7arsoLbtiPHW5Gc&libraries=places"></script>

<script>
    // map coding

    function showMap(lati,long){
        var coord = { lat: parseInt(lati), lng: parseInt(long) };
        // The map, centered at Uluru
        var map = new google.maps.Map(
            document.getElementById("map"),
            {
            zoom: 10,
            center: coord
            }
        );
          // The marker, positioned at Uluru
          var marker = new google.maps.Marker({
            position: coord,
            map: map,
          });
    }
    showMap(0,0);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\NewXamp\htdocs\LARAVEL TUTORIALS\laravel-8\tester\resources\views/home.blade.php ENDPATH**/ ?>