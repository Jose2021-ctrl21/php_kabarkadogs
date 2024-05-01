<?php
require('../php/connect.php'); // Include your database connection script

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$_sql = "SELECT *,
         ad.status_id AS status,
         a.name AS animal_name,
         a.breed AS breed,
         a.mammal AS type_of_pet,
         a.age AS age,
         ad.created_date AS adoption_date,
         ad.email AS email,
         CONCAT(ad.city, ' ', ad.barangay) AS pickup_address
         FROM adoptions AS ad
         LEFT JOIN statuses 
         ON ad.status_id = statuses.id
         LEFT JOIN animals AS a
         ON ad.animal_id = a.id
         WHERE ad.status_id = $selectedStatusId 
         AND ad.id = $adoptionId 
         AND ad.status_id != 1 ";

        $_result = mysqli_query($conn, $_sql);

if ($_result) {
    $response = array(); // Initialize response array

    if (mysqli_num_rows($_result) > 0) {
        if($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($_result);
            $name = $row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];
            $email = $row['email'];
            $animal_name = $row['animal_name'];
            $breed = $row['breed'];
            $type_of_pet = $row['type_of_pet'];
            $age = $row['age'];
            $adoption_date  = $row['adoption_date'];
            $pickup_address  = $row['pickup_address'];
            
            $status = $row['status'];

            // Prepare email content
            $subject = "Adoption approval";

            $message_2 = "Dear $name,<br/><br/>

            We are thrilled to inform you that your application for animal adoption has been approved! 🐾<br/>
            Congratulations on taking this important step towards providing a loving home for a furry friend.<br/>
            Your commitment to animal welfare is truly commendable, and we're excited for the positive impact<br/> 
            you'll make in the life of your new companion.<br/><br/>
            
            Here are the details of your approved booking:<br/><br/>
            
            Animal Name: $animal_name <br/>
            Type of pet: $breed <br/>
            Age: $age <br/>
            Adoption Date: $adoption_date <br/>
            Pickup Address: $pickup_address <br/>
            Before finalizing the adoption process, please ensure you have completed the necessary paperwork <br/>
            and familiarized yourself with our adoption guidelines. If you have any questions or require further <br/>
            assistance, feel free to reach out to our team.<br/><br/>
            
            Thank you for choosing to adopt and for opening your heart and home to an animal in need. <br/>
            We look forward to seeing the joy and companionship your new furry friend will bring into your life!<br/><br/>
            
            Best Regards,<br/>
            The Kabarkadogs<br/>
            Admin Jhois<br/>
            Dra. Salamanca St. San Antonio, Cavite City<br/>
            09300373935";

            $message_3 = "Dear $name,<br/><br/>

                We regret to inform you that your application for animal adoption has been unsuccessful at this time.<br/><br/>

                We understand that this news may be disappointing, and we want to assure you that our decision was made after careful <br/>consideration and in the best interest of the animals in our care. While we appreciate your interest in providing a <br/>loving home for a furry friend, there are various factors involved in the adoption process, and unfortunately, we were <br/>unable to proceed with your application at this time.<br/><br/>

                We encourage you to continue exploring other avenues for animal adoption, as there are many wonderful animals in need of <br/>forever homes. Alternatively, you may consider volunteering with our organization or supporting us through donations <br/>and advocacy efforts.<br/><br/>

                Thank you for your understanding, and we wish you the best in your search for a suitable companion.<br/><br/>

                Sincerely,<br/>
                [Your Name]<br/>
                [Your Position/Role]<br/>
                [Adoption Center/Organization Name]<br/>
                [Contact Information]
                ";

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
                $response['message'] = "Change successful and email message has been sent";
            }
        }
    } else {
        // $result = "No rows found.";
        // $response[] = array("status" => "error", "message"=> $result);
        $response['status'] = "success";
        $response['message'] = "Status updated successfully.";
    }
} else {
    $response['status'] = "error";
    $response['message'] = "Error executing the query: " . mysqli_error($conn);
}

// Close database connection
// mysqli_close($conn);

// Send response as JSON
echo json_encode($response);
?>
