<?php

define("UNAME_VALID_CODE", 1);
define("UNAME_EXIST_CODE", 0);
define("UNAME_INVALID_CODE", -1);
define("UNAME_EXIST_MSG", "Username sudah digunakan");
define("UNAME_INVALID_MSG", "Hanya boleh kombinasi angka, huruf atau underscore");
define("EMAIL_VALID_CODE", 1);
define("EMAIL_EXIST_CODE", 0);
define("EMAIL_EXIST_MSG", "Email sudah digunakan");
define("PHONENUM_VALID_CODE", 1);
define("PHONENUM_EXIST_CODE", 0);
define("PHONENUM_EXIST_MSG", "Nomor sudah digunakan");
define("PHONENUM_INVALID_CODE", -1);
define("PHONENUM_INVALID_MSG", "Nomor tidak valid: 9-12 nomor");


class RegisterController extends Controller
{

    public function __construct()
    {
        parent::__construct('register');
    }



    public function index()
    {

        if ($this->model("User")->isRedirectedToHome()) {
            $this->redirect(BASE_URL . "/home/index/{$_COOKIE['engima_user']}");
        } else {
            $this->model("User")->resetCookie();
        }

        $data['judul'] = 'Engima - Register';
        $data['css'] = $this->cssPath . "/style.css";
        $data['js'] = $this->jsPath . "/index.js";
        $this->view('templates/header', $data);
        $this->view('register/index', $data);
        $this->view('templates/footer', $data);
    }


    public function validate()
    {
        header('Content-Type: application/json, charset=UTF-8');
        $content = json_decode(file_get_contents('php://input'));
        $key = $content->key;
        $value = $content->value;
        if ($key == 'username') {
            if ($this->model("User")->isInputExist($key, $value) > 0) {
                $validStatus = UNAME_EXIST_CODE;
                $responseMsg = UNAME_EXIST_MSG;
            } else {
                if ($this->model("User")->isUsernameValid($value)) {
                    $validStatus = UNAME_VALID_CODE;
                    $responseMsg = "";
                } else {
                    $validStatus = UNAME_INVALID_CODE;
                    $responseMsg = UNAME_INVALID_MSG;
                }
            }
        } else if ($key == 'phone_num') {
            if ($this->model("User")->isInputExist($key, $value) > 0) {
                $validStatus = PHONENUM_EXIST_CODE;
                $responseMsg = PHONENUM_EXIST_MSG;
            } else {
                if ($this->model("User")->isPhoneNumValid($value)) {
                    $validStatus = PHONENUM_VALID_CODE;
                    $responseMsg = "";
                } else {
                    $validStatus = PHONENUM_INVALID_CODE;
                    $responseMsg = PHONENUM_INVALID_MSG;
                }
            }
        } else { //email
            if ($this->model("User")->isInputExist($key, $value) > 0) {

                $validStatus = EMAIL_EXIST_CODE;
                $responseMsg = EMAIL_EXIST_MSG;
            } else {

                $validStatus = EMAIL_VALID_CODE;
                $responseMsg = "";
            }
        }

        echo json_encode(
            array(
                "validStatus" => $validStatus,
                "responseMsg" => $responseMsg
            )
        );
    }

    public function add()
    {

        // Asumsi data input udah valid
        $storedPassword =  password_hash($_POST['password'], PASSWORD_DEFAULT);

        $data = [];
        $data['username'] = $_POST["username"];
        $data['password'] = $storedPassword;
        $data['email'] = $_POST['email'];
        $data['profile_picture'] = $_FILES['profile']['tmp_name'];
        $data['mime'] = $_FILES['profile']['type'];
        $data['phone_num'] = $_POST['phone-number'];

        if ($this->model('User')->addNewUser($data) > 0) {
            $this->redirect(BASE_URL . "/home/index/{$data['username']}");
        }
    }
}