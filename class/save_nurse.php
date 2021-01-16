<?php


class SaveNurse extends DataBase
{

    private $conn;
    private $uploadPathCertificate = 'assets/images/certificate/';
    private $uploadPathPassport = 'assets/images/profile_image/';

    /**
     * SaveNurse constructor.
     */
    public function __construct()
    {
        $this->conn = $this->getInstance();
    }

    public function personalInfo($data){
        $id = $data['id'];
        $firstName = $data['firstName'];
        $lastName = $data['lastName'];
        $email = $data['email'];
        $phoneNumber = $data['phoneNumber'];
        $dob = date_format(date_create($data['dob']), 'Y-m-d');
        $gender = $data['gender'];
        $address = $data['address'];

        $sql = "SELECT * FROM nurse_account WHERE email = '$email'";
        $result = $this->conn->query($sql);
        $account = $result->fetch_assoc();
        if ($account !== NULL){
            $sql = "UPDATE nurse_account SET first_name = '$firstName', last_name = '$lastName', phone_number = '$phoneNumber', gender = '$gender' WHERE id = $id";
            $accountUpdate = $this->conn->query($sql);
            $sql = "UPDATE nurse_details SET dob = '$dob', address = '$address' WHERE nurse_id = $id";
            $detailsUpdate = $this->conn->query($sql);
            if ($accountUpdate && $detailsUpdate){
                echo json_encode(array(
                    'responseCode' => 0,
                    'responseMessage' => 'Record saved successfully.'
                ));
            }else{
                echo json_encode(array(
                    'responseCode' => 80,
                    'responseMessage' => 'Failed to save record.'
                ));
            }
        }else{
            echo json_encode(array(
                'responseCode' => 80,
                'responseMessage' => 'Email does not exist.'
            ));
        }
    }

    public function academicQualification($data){
//        var_dump($data);
        $id = $data['id'];
        $higherInstitution = $data['higherInstitution'];
        $rangeOfStudy = $data['rangeOfStudy'];
        $fieldOfStudy = $data['fieldOfStudy'];
        $degree = $data['degree'];
        $license = $data['license'];
        $certificate = $data['_files']['certificate'];
        $rangeOfStudy = explode('-', $rangeOfStudy);
        $startDate = date_format(date_create(trim($rangeOfStudy[0])), "Y-m-d h:i:s");
        $endDate = date_format(date_create(trim($rangeOfStudy[1])), "Y-m-d h:i:s");

        $sql = "SELECT * FROM nurse_account WHERE id = $id";
        $result = $this->conn->query($sql);
        $account = $result->fetch_assoc();

        if ($account !== NULL){
            $response = $this->uploadCertificate($certificate, $this->uploadPathCertificate, $id);
            if ($response['responseCode'] === 0){
                $sql = "UPDATE nurse_details SET higher_institution = '$higherInstitution', start_date = '$startDate',
                end_date = '$endDate', degree_obtained = '$degree', major_field = '$fieldOfStudy', license_letter = '$license' WHERE nurse_id = $id";
//        echo $sql.'\n';
                $this->conn->query($sql);
                if ($this->conn->affected_rows > 0 || $response['responseCode'] === 0){
                    echo json_encode(array(
                        'responseCode' => 0,
                        'responseMessage' => 'Updated record successfully.'
                    ));
                }else{
                    echo json_encode(array(
                        'responseCode' => 80,
                        'responseMessage' => 'Failed to update record.'
                    ));
                }
            }else{
                echo json_encode(array(
                    'responseCode' => 80,
                    'responseMessage' => 'Failed to upload certificate.'
                ));
            }
        }else{
            echo json_encode(array(
                'responseCode' => 80,
                'responseMessage' => 'Account does not exist'
            ));
        }
    }

    public function jobInfo($data){
//        var_dump($data);
        $id = $data['id'];
        $position = $data['position'];
        $salary = $data['salary'];
        $ward = $data['ward'];
        $passport = $data['_files']['passport'];

        $sql = "SELECT * FROM nurse_account WHERE id = $id";
        $result = $this->conn->query($sql);
        $account = $result->fetch_assoc();

        if ($account !== NULL){
            $salary = str_replace(",", "", $salary);
            $response = $this->uploadPassport($passport, $this->uploadPathPassport, $id);
            if ($response['responseCode'] === 0){
                $sql = "UPDATE nurse_details SET position = '$position', ward = '$ward', income = '$salary' WHERE nurse_id = $id";
//        echo $sql.'\n';
                $this->conn->query($sql);
                if ($this->conn->affected_rows > 0 || $response['responseCode'] === 0){
                    echo json_encode(array(
                        'responseCode' => 0,
                        'responseMessage' => 'Updated record successfully.'
                    ));
                }else{
                    echo json_encode(array(
                        'responseCode' => 80,
                        'responseMessage' => 'Failed to update record.'
                    ));
                }
            }else{
                echo json_encode(array(
                    'responseCode' => 80,
                    'responseMessage' => 'Failed to upload passport.'
                ));
            }
        }else{
            echo json_encode(array(
                'responseCode' => 80,
                'responseMessage' => 'Account does not exist'
            ));
        }
    }

    private function uploadCertificate($file, $uploadDir, $id){
        if (!empty($file['name'])){
            $targetFilePath = $uploadDir.basename($file['name']);
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowedFileTypes = array('pdf', 'doc', 'docx');

            if (in_array($fileType, $allowedFileTypes)){
                if (!is_dir($uploadDir)){
                    mkdir($uploadDir, 0777, true);
                }
                $sql = "SELECT email, certificate FROM nurse_account na INNER JOIN nurse_details nd ON na.id = nd.nurse_id WHERE na.id = $id";
                $result = $this->conn->query($sql);
                $nurse = $result->fetch_assoc();

                if (unlink($this->uploadPathCertificate.$nurse['certificate'])){
                    if (move_uploaded_file($file['tmp_name'], $uploadDir.$file['name'])){
                        rename($uploadDir.$file['name'], $uploadDir.$nurse['email'].'.'.$fileType);
                        $fileName = $nurse['email'].'.'.$fileType;
                        $uploadedFile = $fileName;
                        return array(
                            'responseCode' => 0,
                            'responseMessage' => 'Successfully moved certificate.',
                            'file' => $uploadedFile
                        );
                    }else {
                        return array(
                            'responseCode' => 80,
                            'responseMessage' => 'Failed to upload certificate.'
                        );
                    }
                }else{
                    return array(
                        'responseCode' => 80,
                        'responseMessage' => 'Failed to delete old certificate.'
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
                'responseCode' => 0,
                'responseMessage' => 'Please upload a certificate.'
            );
        }
    }

    private function uploadPassport($file, $uploadDir, $id)
    {
        if (!empty($file['name'])){
            $targetFilePath = $uploadDir.basename($file['name']);
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowedFileTypes = array('png', 'jpg', 'jpeg');

            if (in_array($fileType, $allowedFileTypes)){
                if (!is_dir($uploadDir)){
                    mkdir($uploadDir, 0777, true);
                }
                $sql = "SELECT email, image FROM nurse_account na INNER JOIN nurse_details nd ON na.id = nd.nurse_id WHERE na.id = $id";
                $result = $this->conn->query($sql);
                $nurse = $result->fetch_assoc();

                if (unlink($this->uploadPathCertificate.$nurse['image'])){
                    if (move_uploaded_file($file['tmp_name'], $uploadDir.$file['name'])){
                        rename($uploadDir.$file['name'], $uploadDir.$nurse['email'].'.'.$fileType);
                        $fileName = $nurse['email'].'.'.$fileType;
                        $uploadedFile = $fileName;
                        return array(
                            'responseCode' => 0,
                            'responseMessage' => 'Successfully moved passport.',
                            'file' => $uploadedFile
                        );
                    }else {
                        return array(
                            'responseCode' => 80,
                            'responseMessage' => 'Failed to upload passport.'
                        );
                    }
                }else{
                    return array(
                        'responseCode' => 80,
                        'responseMessage' => 'Failed to delete old passport.'
                    );
                }
            }else{
                return array(
                    'responseCode' => 80,
                    'responseMessage' => 'Passport is not a supported file format. Allowed formats are .pdf, .doc, .docx'
                );
            }
        }else{
            return array(
                'responseCode' => 0,
                'responseMessage' => 'Please upload a passport.'
            );
        }
    }

    public function saveBankDetails($data){
        $bank = $data['bank'];
        $id = $data['id'];
        $accountNumber = $data['accountNumber'];
        $sortCode = $data['sortCode'];

        $sql = "SELECT * FROM nurse_account WHERE id = $id";
        $result = $this->conn->query($sql);
        $account = $result->fetch_assoc();
        if ($account !== NULL){
            $sql = "UPDATE nurse_details SET bank = '$bank', sort_code = '$sortCode', account_number = '$accountNumber' WHERE nurse_id = $id";
            $this->conn->query($sql);
            if ($this->conn->affected_rows >= 0){
                echo json_encode(array(
                    'responseCode' => 0,
                    'responseMessage' => 'Updated record successfully.'
                ));
            }else{
                echo json_encode(array(
                    'responseCode' => 80,
                    'responseMessage' => 'Failed to update record'
                ));
            }
        }else{
            echo json_encode(array(
                'responseCode' => 80,
                'responseMessage' => 'Account does not exist'
            ));
        }
    }
}