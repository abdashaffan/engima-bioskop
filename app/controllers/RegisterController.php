<?php



class RegisterController extends Controller
{

    public function __construct()
    {
        parent::__construct('register');
    }

    public function index()
    {

        $data['judul'] = 'Register/index';
        $data['css'] = $this->cssPath;
        $this->view('templates/header', $data);
        $this->view('register/index', $data);
        $this->view('templates/footer');
    }
}