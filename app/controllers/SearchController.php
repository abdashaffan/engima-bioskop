<?php


class SearchController extends Controller
{
    public function __construct()
    {
        parent::__construct('search');
    }

    public function index()
    {
        $data['judul'] = 'Engima - search';
        $data['css'] = $this->cssPath . "/style.css";
        $data['js'] = $this->jsPath . "/index.js";
        $this->view('templates/header', $data);
        $this->view('templates/nav');
        $this->view('templates/layout');
        $this->view('search/index', $data);
        $this->view('templates/layout-end');
        $this->view('templates/footer', $data);
    }


    public function result()
    {
        $responseArray = [];
        $responseArray['keyword'] = $_GET['keyword'];
        $responseArray['result'] = $this->model("film")->getResult($_GET['keyword']);
        echo json_encode($responseArray);
    }
}