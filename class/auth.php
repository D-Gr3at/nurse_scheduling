<?php

class Auth extends DataBase{

    private $conn;

    public function __construct()
    {
        $this->conn = $this->getInstance();
    }


    public function login($data){
        $email = filter_var($data['email']);
        $password = filter_var($data['password']);
        $nurse = $this->conn->query("SELECT * FROM nurse_account WHERE email = '$email'");
        if($nurse->num_rows === 1){
            $nurse = $nurse->fetch_assoc();
            if(password_verify($password, $nurse['password'])){
                if ($nurse['verified'] === '1'){
                    $_SESSION['nurse']['email'] = $nurse['email'];
                    if(isset($_SESSION['nurse']['email'])){
                        echo json_encode(array('responseCode' => 0, 'responseMessage' => 'Login successful.'));
                    }else{
                        echo json_encode(array('responseCode' => 45, 'responseMessage' => 'Failed to set session for this user.'));
                    }
                }else{
                    echo json_encode(array(
                        'responseCode' => 15,
                        'responseMessage' => 'Please click the button below to reset your default password.',
                            'email' => $nurse['email']
                            )
                    );
                }
            }else{
                echo json_encode(array('responseCode' => 45, 'responseMessage' => 'Password is incorrect.'));
            }
        }else{
            echo json_encode(array('responseCode' => 45, 'responseMessage' => 'Email does not exist.'));
        }
    }

    public function resetPassword($data)
    {
        $password = filter_var($data['password']);
        $confirmPassword = filter_var($data['confirmPassword']);
        $email = $data['email'];
        if ($password !== $confirmPassword){
            echo json_encode(array('responseCode' => 45, 'responseMessage' => 'Passwords do not match.'));
        }else{
            $nurse = $this->conn->query("SELECT password FROM nurse_account WHERE email = '$email'");
            $nurse = $nurse->fetch_assoc();
            if (!password_verify($password, $nurse['password'])){
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $this->conn->query("UPDATE nurse_account SET password = '$password_hash', verified = 1 WHERE email = '$email' ");
                if ($this->conn->affected_rows > 0){
                    echo json_encode(array('responseCode' => 0, 'responseMessage' => 'Password reset successful. Proceed to Login'));
                }else{
                    echo json_encode(array('responseCode' => 45, 'responseMessage' => 'Failed to reset password.'));
                }
            }else{
                echo json_encode(array('responseCode' => 45, 'responseMessage' => 'Please use a different password from your default password.'));
            }
        }
    }
}
