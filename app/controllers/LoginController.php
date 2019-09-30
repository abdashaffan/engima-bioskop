<?php



class LoginController extends Controller
{

    public function __construct()
    {
        parent::__construct('login');
    }

    public function index($valid = '1')
    {

        if ($this->model("User")->isRedirectedToHome()) {
            $this->redirect(BASE_URL . "/home/index/{$_COOKIE['engima_user']}");
        } else {
            $this->model("User")->resetCookie();
        }

        if ($valid == "0") {
            $data['invalidLoginMsg'] = "
                <span class='invalid' style='color:red;font-weight:bold;'>Invalid credentials</span>
            ";
        }
        $data['judul'] = 'Engima - Login';
        $data['css'] = $this->cssPath . "/style.css";
        $this->view('templates/header', $data);
        $this->view('login/index', $data);
        $this->view('templates/footer');
    }

    public function invalid()
    {
        $this->redirect(BASE_URL . '/login/index/0');
    }

    public function validate()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $userDataSearchResult = $this->model("User")->getUserByEmail($email);
        if (!$userDataSearchResult) { //User email not found 
            $this->redirect(BASE_URL . '/login/invalid');
            exit;
        }
        if (password_verify($password, $userDataSearchResult['password'])) { //valid passwd


            // set cookie
            $this->model("User")->setLoginCookie($userDataSearchResult['username']);
            // redirect
            $this->redirect(BASE_URL . "/home/index/{$userDataSearchResult['username']}");
            exit;
        } else { //invalid passwd
            $this->redirect(BASE_URL . '/login/invalid');
            exit;
        }
    }

    public function logout()
    {
        $this->model("User")->resetCookie();
        $this->redirect(BASE_URL . '/login');
    }
}