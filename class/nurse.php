<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

class Nurse extends DataBase
{
    private $conn;

    /**
     * Nurse constructor.
     */
    public function __construct()
    {
        $this->conn = $this->getInstance();
    }

    public function saveNurseRecord($data){

        $email = $data['email'];

        $sql = $this->conn->query("SELECT email FROM nurse_account WHERE email = '$email' ");
        if ($sql->num_rows > 0){
            echo json_encode(array(
                'responseCode' => 61,
                'responseMessage' => 'Email already exist.'
            ));
        }elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            echo json_encode(array(
                'responseCode' => 61,
                'responseMessage' => 'Please provide a valid email.'
            ));
        }else{
            $accountResponse = $this->createAccount($data);
            if ($accountResponse['responseCode'] === 0){
                $uploadResponse = $this->uploadFile($data['_files'], $accountResponse);
                if ($uploadResponse['responseCode'] === 0){
                    $response = $this->saveOtherDetails($data, $accountResponse);
                    if ($response['responseCode'] === 0){
                        $response = $this->saveNurseForTracking($accountResponse['accountID']);
                        if ($response['responseCode'] === 0){
                            echo json_encode(array(
                                'responseCode' => 0,
                                'responseMessage' => 'Registered successfully! Please visit your email to change your default password'
                            ));
                        }else{
                            echo json_encode(array(
                                'responseCode' => 61,
                                'responseMessage' => 'Failed to register user.'
                            ));
                        }
                    }else{
                        echo json_encode(array(
                            'responseCode' => 61,
                            'responseMessage' => 'Failed to save other details.'
                        ));
                    }
                }else{
                    echo json_encode(array(
                        'responseCode' => 61,
                        'responseMessage' => 'Failed to upload files.'
                    ));
                }
            }else{
                echo json_encode(array(
                    'responseCode' => 61,
                    'responseMessage' => 'Failed to create account.'
                ));
            }
        }
    }

    private function uploadFile($file, $response){

        $passportUploadDir = 'assets/images/profile_image/';
        $uploadPathCertificate = 'assets/images/certificate/';

        $certificate = $file['certificate'];
        $passport = $file['passport'];
        if (!empty($passport['name'])){
            $targetFilePath = $passportUploadDir.basename($passport['name']);
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowedFileTypes = array('png', 'jpg', 'jpeg');
            if (in_array($fileType, $allowedFileTypes)){
                if (!is_dir($passportUploadDir)){
                    mkdir($passportUploadDir, 0777, true);
                }
                if (move_uploaded_file($passport['tmp_name'], $passportUploadDir.$passport['name'])){
                    rename($passportUploadDir.$passport['name'], $passportUploadDir.$response['email'].'.'.$fileType);
                    $fileName = $response['email'].'.'.$fileType;
                    $uploadedPassportFile = $fileName;
                    $uploadedCertificateFile = $this->uploadCertificate($certificate, $uploadPathCertificate, $response);
                    $certificate = $uploadedCertificateFile['file'];
                    if ($certificate){
                        $sql = "INSERT INTO nurse_details(image, certificate, nurse_id) VALUES ('$uploadedPassportFile', '$certificate', ".$response['accountID'].")";
                        $this->conn->query($sql);
                        if ($this->conn->affected_rows > 0){
                            return array(
                                'responseCode' => 0,
                                'responseMessage' => 'Files uploaded successfully.'
                            );
                        }else{
                            return array(
                                'responseCode' => 61,
                                'responseMessage' => 'Failed to save passport image.'
                            );
                        }
                    }else{
                        return array(
                            'responseCode' => 61,
                            'responseMessage' => 'Failed to upload certificate.'
                        );
                    }
                }else{
                    return array(
                        'responseCode' => 61,
                        'responseMessage' => 'Failed to upload passport.'
                    );
                }
            }else{
                return array(
                    'responseCode' => 61,
                    'responseMessage' => 'Passport is not a support file format. Allowed formats are .png, .jpg, .jpeg'
                );
            }
        }else{
            return array(
                'responseCode' => 61,
                'responseMessage' => 'Please upload a passport image.'
            );
        }
    }

    private function uploadCertificate($file, $uploadDir, $response){
        if (!empty($file['name'])){
            $targetFilePath = $uploadDir.basename($file['name']);
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowedFileTypes = array('pdf', 'doc', 'docx');

            if (in_array($fileType, $allowedFileTypes)){
                if (!is_dir($uploadDir)){
                    mkdir($uploadDir, 0777, true);
                }
                if (move_uploaded_file($file['tmp_name'], $uploadDir.$file['name'])){
                    rename($uploadDir.$file['name'], $uploadDir.$response['email'].'.'.$fileType);
                    $fileName = $response['email'].'.'.$fileType;
                    $uploadedFile = $fileName;
                    return array(
                        'responseCode' => 0,
                        'responseMessage' => 'Successfully moved certificate.',
                        'file' => $uploadedFile
                    );
                }else {
                    return array(
                        'responseCode' => 61,
                        'responseMessage' => 'Failed to upload certificate.'
                    );
                }
            }else{
                return array(
                    'responseCode' => 61,
                    'responseMessage' => 'Certificate is not a supported file format. Allowed formats are .pdf, .doc, .docx'
                );
            }
        }else{
            return array(
                'responseCode' => 61,
                'responseMessage' => 'Please upload a certificate.'
            );
        }
    }

    private function saveOtherDetails($data, $response)
    {
        $id = $response['accountID'];
        $dob = date_format(date_create($data['dob']), "Y-m-d");
        $address = $data['address'];
        $higherInstitution = $data['higherInstitution'];
        $rangeOfStudy = $data['rangeOfStudy'];
        $fieldOfStudy = $data['fieldOfStudy'];
        $degree = $data['degree'];
        $license = $data['license'];
        $position = $data['position'];
        $salary = $data['salary'];
        $ward = $data['ward'];
        $bank = $data['bank'];
        $accountNumber = $data['accountNumber'];
        $sortCode = $data['sortCode'];
        $rangeOfStudy = explode('-', $rangeOfStudy);
        $startDate = date_format(date_create(trim($rangeOfStudy[0])), "Y-m-d h:i:s");
        $endDate = date_format(date_create(trim($rangeOfStudy[1])), "Y-m-d h:i:s");

        $sql = "UPDATE nurse_details SET dob = '$dob', address = '$address', higher_institution = '$higherInstitution', start_date = '$startDate',
                end_date = '$endDate', sort_code = '$sortCode', position = '$position', degree_obtained = '$degree', ward = '$ward', bank = '$bank',
                account_number = '$accountNumber', major_field = '$fieldOfStudy', license_letter = '$license', income = $salary WHERE nurse_id = $id";
        $this->conn->query($sql);
        if ($this->conn->affected_rows > 0){
            return array(
                'responseCode' => 0,
                'responseMessage' => 'Updated record successfully.'
            );
        }else{
            return array(
                'responseCode' => 61,
                'responseMessage' => 'Failed to update record.'
            );
        }
    }

    private function createAccount($data){
        $email = $data['email'];
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $phoneNumber = $data['phoneNumber'];
        $gender = $data['gender'];
        $date = date("Y-m-d h:i:s");
        $password = $this->random_strings(8);
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO nurse_account(first_name, last_name, email, password, phone_number, gender, created) 
                VALUES ('$firstName', '$lastName', '$email', '$password_hash', '$phoneNumber', '$gender', '$date')";
        $this->conn->query($sql);
        if ($this->conn->affected_rows > 0){
            $response = $this->sendEmail($email, $password, $firstName);
            if ($response['responseCode'] === 0){
                $sql = $this->conn->query("SELECT id FROM nurse_account WHERE email = '$email'");
                $account = $sql->fetch_assoc();
                if ($account){
                    $id = $account['id'];
                }else{
                    return array(
                        'responseCode' => 61,
                        'responseMessage' => 'Failed to fetch account ID.'
                    );
                }
            }else{
                return array(
                    'responseCode' => 61,
                    'responseMessage' => 'Failed to send email.'
                );
            }
        }else{
            return array(
                'responseCode' => 61,
                'responseMessage' => 'Failed to create account.'
            );
        }
        return array(
            'responseCode' => 0,
            'responseMessage' => 'Email sent successfully.',
            'accountID' => $id,
            'email' => $email
        );
    }

    private function random_strings($length_of_string)
    {

        // String of all alphanumeric character
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

        // Shufle the $str_result and returns substring
        // of specified length
        return substr(str_shuffle($str_result),  0, $length_of_string);
    }

    private function sendEmail($email, $password, $firstName){
        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $subject = 'Account Verification';

        try {
            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'ibinabotontebille@gmail.com';                     // SMTP username
            $mail->Password   = 'epsilon@123';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('no-reply@acumenHospitals.com', 'Acumen Hospitals');
            $mail->addAddress($email);     // Add a recipient
//            $mail->addAddress('ellen@example.com');               // Name is optional
//            $mail->addReplyTo('info@example.com', 'Information');
//            $mail->addCC('cc@example.com');
//            $mail->addBCC('bcc@example.com');

            // Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $body = file_get_contents("email.html");
            $body = str_replace("#subject#", $subject, $body);
            $body = str_replace("#name#", $firstName, $body);
            $body = str_replace("#email#", $email, $body);
            $body = str_replace("#password#", $password, $body);
            $mail->Body    = $body;
//            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return array(
            'responseCode' => 0,
            'responseMessage' => 'Email sent successfully.'
        );
    }

    private function saveNurseForTracking($id){
        $year = date('Y');
        $this->conn->query("INSERT INTO nurse_tracker(nurse_id, status, year, day_count)
                            VALUES($id, 'OFF_DAY', '$year', 0) ");
        if ($this->conn->affected_rows > 0){
            return array(
                'responseCode' => 0
            );
        }else{
            return array(
                'responseCode' => 61
            );
        }
    }

}