<?php



class FilmController extends Controller
{   
    public function __construct()
    {
        parent::__construct('film');
    }

    public function index($id=1)
    {
        // TODO: Change to parse id
        $id = 1;
        $data['judul'] = 'Film/index';
        $data['css'] = $this->cssPath . "/style.css";
        $data['film'] = $this->model('Film')->getFilmById($id);
        $dateTime = date_create_from_format('Y-m-d', $data['film']['release_date']);
        $data['film']['release_date'] = $dateTime->format('F d, Y');
        $this->view('templates/header', $data);
        $this->view('templates/nav');
        $this->view('templates/layout');
        $this->view('film/index', $data);
        $this->view('templates/layout-end');
        $this->view('templates/footer');
    }
}