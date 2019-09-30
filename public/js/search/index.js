

const getSearchResult = (keyword="") => {

        document.querySelector(".container").innerHTML = "";
        if (keyword === ""){
            document.querySelector('.result-key').innerHTML = "";
            document.querySelector('.result-number').innerText = "0";
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let searchResult = JSON.parse(this.responseText);
                let keyword = searchResult.keyword;
                document.querySelector('.result-key').innerHTML = keyword;
                document.querySelector('.result-number').innerHTML = searchResult.result.length;
                console.log(searchResult.result);
                generateResultList(searchResult.result);
            }
        };

        if (keyword !== "") {
            xmlhttp.open("GET", BASE_URL + "/search/result?keyword=" + keyword, true);
            xmlhttp.send();
        }
}

const generateResultList = (resultList) => {
    resultList.forEach(film => {

        document.querySelector('.container').innerHTML += (
        `    
        <div class="film-wrapper">

            <div class="main-content">

                <img src="` +BASE_URL+ `/assets/img/film/`+ film.thumbnail +`" 
                    class="film-thumbnail">

                <div class="film-detail-wrapper">
                    <span class="title"> `+ film.title +`</span><br>
                    <span class="rating">
                        <img src="` +BASE_URL+ `/assets/icon/star-solid.svg" alt="rating-star" class="svg-big">
                        `+film.rating+`
                    </span><br>
                    <span class="sinopis">
                        `+film.sinopsis +`
                    </span><br>
                </div>
            </div>


            <span class="film-details-link">
                <a class="link detail-button" href="` +BASE_URL+ `/film/index/`+film.film_id+`">view details
                    <img src="` +BASE_URL+ `/assets/icon/right-arrow.svg" alt="view-details" class="svg-med">
                </a>
            </span>
        </div>
        <hr>
        
        
        `);


    });
}