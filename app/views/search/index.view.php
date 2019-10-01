 <div class="search-container">

     <h1>Showing search result from keyword:
         <span class="result-key">
             <?php if (isset($initialResult)) : ?>
             <?= $keyword; ?>
             <?php endif; ?>
         </span>
     </h1>
     <h2 class="result-number-text">
         <span class="result-number">
             <?php if (isset($initialResult)) : ?>
             <?= count($initialResult); ?>
             <?php endif; ?>
         </span> result available</h2><br>
     <div class="container">
         <?php if (isset($initialResult)) : ?>

         <?php foreach ($initialResult as $movie) : ?>
         <div class="film-wrapper">

             <div class="main-content">

                 <img src="<?= BASE_URL; ?>/assets/img/film/<?= $movie['thumbnail']; ?>" class="film-thumbnail">

                 <div class="film-detail-wrapper">
                     <span class="title"> <?= $movie['title']; ?></span><br>
                     <span class="rating">
                         <img src="<?= BASE_URL; ?>/assets/icon/star-solid.svg" alt="rating-star" class="svg-big">
                         <?= $movie['rating']; ?>
                     </span><br>
                     <span class="sinopis">
                         <?= $movie['sinopsis']; ?>
                     </span><br>
                 </div>
             </div>


             <span class="film-details-link">
                 <a class="link detail-button" href="<?= BASE_URL; ?>/film/index/<?= $movie['film_id']; ?>">view details
                     <img src="<?= BASE_URL; ?>/assets/icon/right-arrow.svg" alt="view-details" class="svg-med">
                 </a>
             </span>
         </div>
         <hr>
         <?php endforeach; ?>
         <?php endif; ?>
     </div>
     <!-- <div class="container"></div> -->


 </div>