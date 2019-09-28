<div class="film">
    <div class="film-detail">
        <?php echo "<img class='film-image-big' src='/public/assets/img/film/".$film['thumbnail']."'>"; ?>
        <div class="film-detail-desc">
            
            <h2><?php echo $film['title']; ?></h2>
            <b>
                <p class="blue-color"><?php echo $film['genre']; ?> | <?php echo $film['length']; ?> mins</p>
                <p>Released date: <?php echo $film['release_date']; ?></p>
            </b>
            <div class='rating'>
                <h3>
                    <img class="svg-big" src="/public/assets/icon/star-solid.svg">
                    <?php echo $film['rating']; ?>
                    <span>/10</span>
                </h3>
            </div>
            <p>
                <?php echo $film['sinopsis']; ?>
            </p>
        </div>  
    </div>
    <div class="film-desc">
        <div class="film-schedule">
            <div class="wrapper">
                <h3>Schedules</h3>
                <table>
                    <tr>
                        <th>
                            Date
                        </th>
                        <th>
                            Time
                        </th>
                        <th>
                            Available Seats
                        </th>
                        <th>
                            
                        </th>
                    </tr>
                    <?php foreach ($schedules as $key => $schedule) : ?>
                        <tr>
                            <td>
                                <!-- TODO: trim zero in front of date -->
                                <?php
                                    $dateTime = date_create_from_format('Y-m-d H:i:s', $schedule['showtime']);
                                    echo $dateTime->Format('F d, Y');
                                ?>
                            </td>
                            <td>
                                <?php
                                    $time = date_create_from_format('Y-m-d H:i:s', $schedule['showtime'])->Format('H:i');
                                    $boundary = date('H:i', strtotime("12:00:00"));
                                    if ($time < $boundary) {
                                        echo $time.' AM';
                                    } else {
                                        $interval = strtotime($time) - strtotime($boundary);
                                        echo date("H:i", $interval).' PM';
                                    }
                                ?>
                            </td>
                            <td class="table-seat">
                                <?php 
                                    if ($schedule['count'] == NULL) {
                                        $schedule['count'] = 0;
                                    } 
                                    echo $schedule['count']; 
                                ?> 
                                seats
                            </td>
                            <?php 
                                if ($schedule['count'] == 30) {
                                    echo '
                                        <td class="table-state not-available">
                                            Not Available 
                                            <img class="svg-med" src="/public/assets/icon/times-circle-solid.svg">
                                        </td>';
                                } else {
                                    echo '
                                        <td class="table-state available">
                                            Book Now 
                                            <img class="svg-med" src="/public/assets/icon/right-arrow.svg">
                                        </td>';
                                } 
                            ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        <div class="film-review">
            <div class="wrapper">
                <h3>Reviews</h3>
                <div class="review-detail">
                    <?php for ($i = 0; $i < count($reviews)-1; $i++) : ?>
                        <div>
                            <?php echo "<img class='review-user' class='review-user' src='/public/assets/img/user/" . $reviews[$i]['profile_picture'] . "'>" ?>
                            <div>
                                <b><p><?php echo $reviews[$i]['username'] ?></p></b>
                                <div class='rating'>
                                    <h3>
                                        <img class="svg-small" src="/public/assets/icon/star-solid.svg">
                                        <?php echo $reviews[$i]['rating'] ?>
                                        <span>/10</span>
                                    </h3>
                                </div>
                                <p>
                                    <?php echo $reviews[$i]['comment'] ?>
                                </p>
                            </div>
                        </div>
                    <?php endfor; ?>
                    
                    <?php
                        $n = count($reviews);
                        if ($n == 0) {
                            echo "<p>Tidak Ada Review </p>";
                        } else {

                        }
                        echo "
                            <div class='review-last'>
                                <img class='review-user' src='/public/assets/img/user/" . $reviews[$n-1]['profile_picture'] ."'>
                                <div>
                                    <b><p>" . $reviews[$n-1]['username'] ."</p></b>
                                    <div class='rating'>
                                        <h3>
                                            <img class='svg-small' src='/public/assets/icon/star-solid.svg'>"
                                            . $reviews[$n-1]['rating'] .
                                            "<span>/10</span>
                                        </h3>
                                    </div>
                                    <p>" . $reviews[$n-1]['comment'] . "</p>
                                </div>
                            </div> ";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>