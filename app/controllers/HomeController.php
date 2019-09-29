<?php



class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct('home');
    }

    public function index($username = "")
    {

        if (!$this->model("User")->isRedirectedToHome()) {
            $this->redirect(BASE_URL . "/login");
        }

        $data['judul'] = 'Home/index';
        $data['css'] = $this->cssPath . "/style.css";
        // TODO: get username from abda
        $data['user_name'] = $this->model('User')->getCurrentUser();
        $data['films'] = $this->model('Film')->getAllCurrentFilm();
        $this->view('templates/header', $data);
        $this->view('templates/nav');
        $this->view('templates/layout');
        $this->view('home/index', $data);
        $this->view('templates/layout-end');
        $this->view('templates/footer');
    }
}