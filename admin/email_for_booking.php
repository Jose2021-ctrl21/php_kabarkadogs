<?php
require('../php/connect.php'); // Include your database connection script

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$_sql = "SELECT *,
bookings.status_id AS status,
bookings.name AS name,
bookings.email AS email,
bookings.phone_number AS phone_number,
bookings.date_of_appointment AS date_of_appointment,
bookings.message AS message,
bookings.time AS time
FROM bookings 
LEFT JOIN statuses 
ON bookings.status_id = statuses.id
WHERE bookings.status_id = $selectedStatusId AND bookings.id = $bookingId AND bookings.status_id != 1 ";

$_result = mysqli_query($conn, $_sql);
if ($_result) {
    $response = array(); // Initialize response array

    if (mysqli_num_rows($_result) > 0) {
            $row = mysqli_fetch_assoc($_result);

            $status = $row['status'];
            $name = $row['name'];
            $email = $row['email'];
            $phone_number = $row['phone_number'];
            $date_of_appointment = $row['date_of_appointment'];
            $time = $row['time'];
            $message = $row['message'];

            //TEST
            // $test = "
            // Name: $name,
            // Email: $email,
            // Animal name: $phone_number,
            // Breed: $date_of_appointment,
            // Type of Pet: $time,

            // ";
           

            //PREPARE EMAIL CONTENT
            $subject = "Adoption approval";

            $message_2 = "Booking Approved for Visiting The Kabarkadogs! 🐾<br/><br/>

                Dear $name,<br/><br/>
                
                We are thrilled to inform you that your booking to visit our Shelter has been approved! 🎉<br/><br/>
                
                Here are the details of your confirmed visit:<br/><br/>
                
                <b>Date:</b> $date_of_appointment<br/>
                <b>Time:</b> $time<br/>
                <b>Purpose of Visit:</b> <i>$message</i><br/><br/>
                We are excited to welcome you to our center and introduce you to our adorable furry friends <br/>
                awaiting their forever homes. During your visit, you'll have the opportunity to interact with <br/>
                the animals, learn more about our adoption process, and discover how you can make a difference <br/>
                in the lives of these precious creatures.<br/><br/>
                
                If you have any specific questions or requests for your visit, please don't hesitate to let us know. <br/>
                Our team is here to ensure you have a meaningful and enjoyable experience.<br/>
                
                Thank you for choosing to visit The Kabarkdogs. Your support means the world to us and to the animals we care for.<br/><br/>
                
                We can't wait to see you soon!<br/><br/>
                
                <b>Warm Regards,<br/>
                The Kabarkdogs<br/>
                Admin Jhois<br/>
                09300373935</b>";

            $message_3 = "Dear $name,<br/><br/>

                We regret to inform you that your booking application has not been successful at this time.<br/><br/>
                
                We understand that this news may be disappointing, and we want to assure you that our decision <br/>
                was made after careful consideration and in the best interest of our booking process. <br/>
                While we appreciate your interest, there are various factors involved, and unfortunately,<br/>
                we were unable to proceed with your application at this time.<br/><br/>
                
                We encourage you to explore alternative options for your booking needs. <br/>
                Alternatively, you may consider reaching out to us for further assistance or to discuss alternative arrangements.<br/><br/>
                
                Thank you for your understanding, and we wish you the best in your search for suitable accommodations.<br/><br/>
                
                <b>Best Regards</b>,<br/>
                <b>The Kabarkadogs<br/>
                Admin Jhois<br/>
                Dra. Salamanca St. San Antonio, Cavite City<br/>
                09300373935</b>";

            $message="";
            if($status==2){
                $message = $message_2;
            }
            if($status==3){
                $message = $message_3;
            }

            // $response['status'] = "success";
            // $response['message'] = "Status updated successfully. No email sent".$message;


            // Initialize PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jscript2024@gmail.com';
            $mail->Password = 'fmhtrngdxbbmhfuu';
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->isHTML(true);
            $mail->setFrom('jscript2024@gmail.com', 'From The Kabarkadogs');
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Send email
            if (!$mail->send()) {
                $response['status'] = "error";
                $response['message'] = "Error sending email: " . $mail->ErrorInfo;
            } else {
                $response['status'] = "success";
                $response['message'] = "Change successful and email message has been sent to $email";
            }
            
    } else {
        // $result = "No rows found.";
        // $response[] = array("status" => "error", "message"=> $result);
        $response['status'] = "success";
        $response['message'] = "Status updated successfully. No email sent";
    }
} else {
    $response['status'] = "error";
    $response['message'] = "Error executing the query: " . mysqli_error($conn);
}

// Close database connection
// mysqli_close($conn); //don't uncomment this close connection else email will not be sent
?>
