<?php


class SearchController extends Controller
{
    public function __construct()
    {
        parent::__construct('search');
    }

    public function index()
    {
        if (isset($_GET['keyword'])) {
            $data['keyword'] = $_GET['keyword'];
            unset($_GET['keyword']);
            $data['initialResult'] = $this->model("film")->getResult($data['keyword']);
        }
        $data['judul'] = 'Engima - search';
        $data['css'] = $this->cssPath . "/style.css";
        $data['js'] = $this->jsPath . "/index.js";
        $this->view('templates/header', $data);
        $this->view('templates/nav', $data);
        $this->view('templates/layout');
        $this->view('search/index', $data);
        $this->view('templates/layout-end');
        $this->view('templates/footer', $data);
    }


    public function result()
    {
        $data = json_decode(stripslashes(file_get_contents("php://input")));
        $responseArray = [];
        $responseArray['page'] = $data->page;
        $responseArray['keyword'] = $data->keyword;
        $responseArray['output'] = $this->model('Film')->paginateResult($responseArray);
        echo json_encode($responseArray);
    }
}