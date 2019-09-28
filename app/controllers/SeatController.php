<?php

class SeatController extends Controller
{   
    public function __construct()
    {
        parent::__construct('seat');
    }

    public function index($id=1)
    {
        // TODO: Change to parse id
        $id = 1;
        $data['judul'] = 'Seat/index';
        $data['css'] = $this->cssPath . "/style.css";
        
        // $data['film'] = $this->model('Film')->getFilmById($id);
        // $dateTime = date_create_from_format('Y-m-d', $data['film']['release_date']);
        // $data['film']['release_date'] = $dateTime->format('F d, Y');
        
        // $data['schedules'] = $this->model('Schedule')->getAllScheduleByFilmId($id);
        // $data['reviews'] = $this->model('Review')->getAllReviewAndUserByFilmId($id);

        $this->view('templates/header', $data);
        $this->view('templates/nav');
        $this->view('templates/layout');
        $this->view('seat/index', $data);
        $this->view('templates/layout-end');
        $this->view('templates/footer');
    }
}