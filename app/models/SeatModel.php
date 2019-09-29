<?php

class SeatModel
{
    private $table = 'seats';
    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllSeatByScheduleId($id)
    {   
        $this->db->query(
            "SELECT * FROM {$this->table} WHERE schedule_id={$id}"
        );
        return $this->db->resultSet();
    }
    public function getOccupiedBySeatNumberandFilmId($seat_number, $film_id)
    {
        $this->db->query(
            "SELECT occupied FROM {$this->table} WHERE seat_number={$seat_number} and schedule_id={$film_id}"
        );
        return $this->db->resultSet();
    }

}
