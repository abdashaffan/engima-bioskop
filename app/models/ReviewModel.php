<?php


class ReviewModel
{
    private $table = 'review';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addNewUserReview($data)
    {
        $query =
            "INSERT INTO {$this->table} (
                film_id,
                user_id,
                comment,
                rating
            ) VALUES
            (
                :film_id,
                :user_id,
                :comment,
                :rating
            )";

        $this->db->query($query);
        $this->db->bind('film_id', $data["film_id"]);
        $this->db->bind('user_id', $data["user_id"]['user_id']);
        $this->db->bind('comment', $data["comment"]);
        $this->db->bind('rating', $data["rating"]);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getReviewedFilmName($film_id)
    {
        $this->db->query(
            "SELECT title FROM film f WHERE f.film_id = :id"
        );
        $this->db->bind('id', $film_id);
        return $this->db->resultSet();
    }
    public function changeTransStatus01($transid)
    {
        // set Transaction Status by id
        $query2 =
            "UPDATE transaction t
            SET status=1
            WHERE transaction_id=:id And status=0 ;
            ";

        $this->db->query($query2);
        $this->db->bind('id', $transid);
        $this->db->execute();

        return $this->db->rowCount();;
    }
    public function changeTransStatus10($transid)
    {
        // set Transaction Status by id
        $query1 =
            "UPDATE transaction t
            SET status=0
            WHERE transaction_id=:id And status=1 ;
            ";
        $this->db->query($query1);
        $this->db->bind('id', $transid);
        $this->db->execute();

        return $this->db->rowCount();;
    }
    public function getStatus($transid)
    {
        // get Transaction Status by id
        $query =
            "SELECT status FROM transaction t WHERE transaction_id=:id;
            ";
        $this->db->query($query);
        $this->db->bind('id', $transid);
        $this->db->execute();

        return $this->db->resultSet();;
    }
    public function delReviewById($reviewid)
    {
        $query =
            "DELETE FROM review 
            WHERE review_id=:id;
            ";
        $this->db->query($query);
        $this->db->bind('id', $reviewid);
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function getAllReviewAndUserByFilmId($id)
    {
        $this->db->query(
            "SELECT comment, rating, username, profile_picture, mime FROM review NATURAL JOIN user WHERE film_id={$id}"
        );
        return $this->db->resultSet();
    }
}