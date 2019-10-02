<?php



class TranshistoryController extends Controller
{
    public function __construct()
    {
        parent::__construct('transhistory');
    }

    public function index()
    {
        $data['judul'] = 'Engima - Transaction History';
        $data['css'] = $this->cssPath . "/style.css";
        $data['js'] = $this->jsPath . "/index.js";
        $data['user_ID'] = $this->model('User')->getUserID();
        $data['transactions'] = $this->model('Transaction')->getAllUserTransaction($data['user_ID']['user_id']);
        // die(var_dump($data['transactions']));
        $this->view('templates/header', $data);
        $this->view('templates/nav');
        $this->view('templates/layout');
        $this->view('transhistory/index', $data);
        $this->view('templates/layout-end');
        $this->view('templates/footer');
    }
    public function toreview()
    {

        $data = [];
        $data['transaction_id'] = $_GET["transaction_id"];
        $data['film_id'] = $_GET['film_id'];
        $this->redirect(BASE_URL . "/" . "review" . "?filmid=" . $data['film_id'] . "&transid=" . $data['transaction_id']);
    }
}