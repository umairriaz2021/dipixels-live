<div class="container">
    <div class="row">
       <?php if($user_appointments): ?>
       <?php foreach($user_appointments as $key => $appointment){
             $appointment_id = $appointment->ID;
             $student_name = $appointment->stud_name;
             $date_formated = date('F d, Y',$appointment->date);
             $time = date('H',$appointment->slot);
             $instructor = get_post($appointment->service)->post_title;
             $lesson_type = $appointment->lesson_type;
             $appointment_status = wc_get_order($appointment->order_id)->get_status();
             $lesson_price = $appointment->lesson_price;
             ?>

            <div class="col-md-4">
            <div class="panel panel-default">
            <div class="panel-heading">Appointment ID - <?php echo $appointment_id;?></div>
            <div class="panel-body">
                <ul>
                    <li>Student Name: <?php echo $student_name;?> </li>
                    <li>Appointment Date: <?php echo $date_formated;?> </li>
                    <li>Time: <?php echo $time; ?> </li>
                    <li>Instructor: <?php echo $instructor; ?> </li>
                    <li>Lesson Type: <?php echo $lesson_type; ?> </li>
                    <li>Appointment Status: <?php echo $appointment_status; ?> </li>
                    <li>Lesson Price: <?php echo $lesson_price; ?> </li>
                </ul>
                <div class="appointment_buttons">
                    <button class="btn btn-success " id="app_reply" >Message</button>
                    <button class="btn btn-success " id="app_pay" data-attr="<?php echo  $appointment_id; ?>" >Pay Now</button>
                </div>
            </div>
            </div>



            </div>

            <?php


       } 
        
        
        ?>
        <?php endif;?>
    </div>
</div>

