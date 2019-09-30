<?php



class ReviewController extends Controller
{
    public function __construct()
    {
        parent::__construct('review');
    }

    public function index()
    {
        $filmid = $_GET['filmid'];
        $transid = $_GET['transid'];
        $data['judul'] = 'Engima -review';
        $data['css'] = $this->cssPath . "/style.css";
        $data['user_id'] = $this->model('User')->getUserID();
        $data['film_name'] = $this->model('Review')->getReviewedFilmName($filmid);
        $data['film_id'] = $filmid;
        $data['trans_id'] = $transid;
        $this->view('templates/header', $data);
        $this->view('templates/nav');
        $this->view('templates/layout');
        $this->view('review/index', $data);
        $this->view('templates/layout-end');
        $this->view('templates/footer');
    }
    public function add()
    {
        $data = [];
        $data['rating'] = $_POST["rating"];
        $data['comment'] = $_POST['comment'];
        $data['user_id'] = $this->model('User')->getUserID();

        $transid = $_POST['transaction_id'];
        $data['film_id'] = $_POST['film_id'];;
        $status = $this->model('Review')->getStatus($transid);
        $status = trim($status[0]['status']);

        if ($this->model('Review')->addNewUserReview($data) > 0) {
            // changetransStatus here
            if ($status == "0") {
                $this->model('Review')->changeTransStatus01($transid);
            } else if ($status == "1") {
                $this->model('Review')->changeTransStatus10($transid);
            } else {
                echo "String failed to compare";
            }
            $this->redirect(BASE_URL .  "/" . "transhistory");
        }
    }
}