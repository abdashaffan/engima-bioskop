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
     <div class="container"></div>


 </div>