<?php

define('RECORD_PER_PAGE', 2);

class FilmModel
{
    private $table = 'film';
    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    //TO DO chane to get all
    public function getAllCurrentFilm()
    {
        date_default_timezone_set(date_default_timezone_get());
        $currentDate = date('Y-m-d', time());
        $this->db->query(
            "SELECT * FROM {$this->table} WHERE release_date = :date"
        );
        $this->db->bind('date', $currentDate);
        return $this->db->resultSet();
    }

    public function getFilmById($id)
    {
        $this->db->query(
            "SELECT * FROM {$this->table} WHERE film_id={$id} "
        );
        return $this->db->resultSet()[0];
    }

    public function getResult($keyword)
    {
        $query = "
            SELECT * from {$this->table} WHERE title LIKE :keyword
        ";
        $this->db->query($query);
        $this->db->bind('keyword', "%" . $keyword . "%");
        return $this->db->resultset();
    }

    public function paginateResult($data)
    {
        $recordPerPage = RECORD_PER_PAGE;
        $page = 1;
        if (isset($data['page'])) {
            $page = $data['page'];
        }
        $output = '';
        // $output = $this->renderPaginationElement($data['keyword'], $page);
        $startFrom = ($page - 1) * $recordPerPage;
        $this->db->query(
            "SELECT * FROM {$this->table} WHERE title LIKE :title ORDER BY film_id DESC LIMIT :startFrom, :recordPerPage"
        );
        $this->db->bind('title', '%' . $data['keyword'] . '%');
        $this->db->bind('startFrom', $startFrom);
        $this->db->bind('recordPerPage', $recordPerPage);
        $result = $this->db->resultset();
        if ($result > 0) {
            foreach ($result as $movie) {
                $output .= "
            <div class=\"film-wrapper\">
                <div class=\"main-content\">
                    <img src=\"" . BASE_URL . "/assets/img/film/" . $movie['thumbnail'] . "\" class=\"film-thumbnail\">
                    <div class=\"film-detail-wrapper\">
                        <span class=\"title\"> " . $movie['title'] . "</span><br>
                            <span class=\"rating\">
                                <img src=\"" . BASE_URL . "/assets/icon/star-solid.svg\" alt=\"rating-star\" class=\"svg-big\">
                                " . $movie['rating'] . "
                            </span><br>
                        <span class=\"sinopis\">
                            " . $movie['sinopsis'] . "
                        </span><br>
                    </div>
                </div>
                <span class=\"film-details-link\">
                    <a class=\"link detail-button\" href=\"" . BASE_URL . "/film/index/" . $movie['film_id'] . "\">view details
                        <img src=\"" . BASE_URL . "/assets/icon/right-arrow.svg\" alt=\"view-details\" class=\"svg-med\">
                    </a>
                </span>
            </div>
            <hr>";
            }
        }

        $output .= $this->renderPaginationElement($data['keyword'], $page);

        return $output;
    }


    public function renderPaginationElement($keyword, $pageNum)
    {
        $output = '';
        $this->db->query(
            "SELECT * FROM {$this->table}  WHERE title LIKE :title ORDER BY film_id DESC"
        );
        $this->db->bind('title', '%' . $keyword . '%');
        $totalRecords = sizeof($this->db->resultset());
        $totalPages = ceil($totalRecords / RECORD_PER_PAGE);
        if ($totalPages <= 1) {
            return $output;
        }
        $output .= '<span class="pagination_wrapper">';
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $pageNum) {
                $output .= "<span class='pagination_link disabled' id='" . $i . "' disabled >" . $i . "</span>";
            } else {
                $output .= "<span class='pagination_link' id='" . $i . "' onClick='loadData(" . $i . ");scrollWin()'>" . $i . "</span>";
            }
        }
        $output .= '</span>';

        return $output;
    }
}