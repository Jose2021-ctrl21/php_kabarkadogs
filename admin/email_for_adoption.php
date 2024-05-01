<?php
require('../php/connect.php'); // Include your database connection script

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$_sql = "SELECT *,
adoptions.status_id AS status,
animals.name AS animal_name,
animals.breed AS breed,
animals.mammal AS type_of_pet,
animals.age AS age,
adoptions.created_date AS adoption_date,
adoptions.email AS email,
CONCAT(adoptions.city, ' ', adoptions.barangay) AS pickup_address
FROM adoptions 
LEFT JOIN statuses 
ON adoptions.status_id = statuses.id
LEFT JOIN animals 
ON adoptions.animal_id = animals.id
WHERE adoptions.status_id = $selectedStatusId AND adoptions.id = $adoptionId AND adoptions.status_id != 1 ";

$_result = mysqli_query($conn, $_sql);

if ($_result) {
    $response = array(); // Initialize response array

    if (mysqli_num_rows($_result) > 0) {
            $row = mysqli_fetch_assoc($_result);
            $name = $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];
            $email = $row['email'];
            $animal_name = $row['animal_name'];
            $breed = $row['breed'];
            $type_of_pet = $row['type_of_pet'];
            $age = $row['age'];
            $adoption_date = $row['adoption_date'];
            $pickup_address = $row['pickup_address'];
            
            $status = $row['status'];


            //TEST
            // $test = "
            // Name: $name,
            // Email: $email,
            // Animal name: $animal_name,
            // Breed: $breed,
            // Type of Pet: $type_of_pet,
            // Age: $age,
            // Date of adoption: $adoption_date,
            // Pickup address: $pickup_address,
            // ";
            // $response['status'] = "success";
            // $response['message'] = "Status updated successfully. No email sent".$test;


            //PREPARE EMAIL CONTENT
            $subject = "Adoption approval";

            $message_2 = "<b>Dear</b> $name,<br/><br/>
                We are thrilled to inform you that your application for animal adoption has been approved! 🐾<br/>
                Congratulations on taking this important step towards providing a loving home for a furry friend.<br/>
                Your commitment to animal welfare is truly commendable, and we're excited for the positive impact<br/> 
                you'll make in the life of your new companion.<br/><br/>
                
                Here are the details of your approved booking:<br/><br/>
                
                <b>Type of pet:</b> $type_of_pet<br/>
                <b>Breed:</b> $breed<br/>
                <b>Animal Name:</b> $animal_name <br/>
                <b>Age:</b> $age<br/>
                <b>Adoption Date:</b> $adoption_date<br/>
                <b>Pickup Address:</b> $pickup_address<br/>
                Before finalizing the adoption process, please ensure you have completed the necessary paperwork <br/>
                and familiarized yourself with our adoption guidelines. If you have any questions or require further <br/>
                assistance, feel free to reach out to our team.<br/><br/>
                
                Thank you for choosing to adopt and for opening your heart and home to an animal in need. <br/>
                We look forward to seeing the joy and companionship your new furry friend will bring into your life!<br/><br/>
                
                <b>Best Regards,<br/>
                The Kabarkadogs<br/>
                Admin Jhois<br/>
                Dra. Salamanca St. San Antonio, Cavite City<br/>
                09300373935</b>";

            $message_3 = "<b>Dear</b> $name,<br/><br/>

                We regret to inform you that your application for animal adoption has been unsuccessful at this time.<br/><br/>

                We understand that this news may be disappointing, and we want to assure you that our decision was made<br/>
                after careful consideration and in the best interest of the animals in our care. While we appreciate your<br/>
                interest in providing a loving home for a furry friend, there are various factors involved in the adoption <br/>
                process, and unfortunately, we were unable to proceed with your application at this time.<br/><br/>

                We encourage you to continue exploring other avenues for animal adoption, as there are many wonderful animals <br/>
                in need of forever homes. Alternatively, you may consider volunteering with our organization or supporting <br/> 
                us through donations and advocacy efforts.<br/><br/>

                Thank you for your understanding, and we wish you the best in your search for a suitable companion.<br/><br/>

                <b>Best Regards,<br/>
                The Kabarkadogs<br/>
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
