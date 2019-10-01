

// const getSearchResult = () => {

//         let input = document.querySelector('.keyword').value;
//         console.log(input);

//         document.querySelectorAll(".container").innerHTML = "";
//         if (input === ""){
//             document.querySelector('.result-key').innerHTML = "";
//             document.querySelector('.result-number').innerText = "0";
//         }
//         var xmlhttp = new XMLHttpRequest();
//         xmlhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
//                 let searchResult = JSON.parse(this.responseText);
//                 let keyword = searchResult.keyword;
//                 document.querySelector('.result-key').innerHTML = keyword;
//                 document.querySelector('.result-number').innerHTML = searchResult.result.length;
//                 console.log(searchResult.result);
//                 generateResultList(searchResult.result);
//             }
//         };

//         if (input !== "") {
//             xmlhttp.open("GET", BASE_URL + "/search/result?keyword=" + input, true);
//             xmlhttp.send();
//         }
// }

// const generateResultList = (resultList) => {
//     resultList.forEach(film => {

//         document.querySelector('.container').innerHTML += (
//         `    
//         <div class="film-wrapper">

//             <div class="main-content">

//                 <img src="` +BASE_URL+ `/assets/img/film/`+ film.thumbnail +`" 
//                     class="film-thumbnail">

//                 <div class="film-detail-wrapper">
//                     <span class="title"> `+ film.title +`</span><br>
//                     <span class="rating">
//                         <img src="` +BASE_URL+ `/assets/icon/star-solid.svg" alt="rating-star" class="svg-big">
//                         `+film.rating+`
//                     </span><br>
//                     <span class="sinopis">
//                         `+film.sinopsis +`
//                     </span><br>
//                 </div>
//             </div>


//             <span class="film-details-link">
//                 <a class="link detail-button" href="` +BASE_URL+ `/film/index/`+film.film_id+`">view details
//                     <img src="` +BASE_URL+ `/assets/icon/right-arrow.svg" alt="view-details" class="svg-med">
//                 </a>
//             </span>
//         </div>
//         <hr>
        
        
//         `);


//     });
// }

const loadData = (page=1) => {
    console.log('loadData get called');
    // console.log(document.querySelector('.keyword').value);
    let keyword = document.querySelector('.keyword').value;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let searchResult = JSON.parse(this.responseText);
            console.log(searchResult.output);
            document.querySelector('.container').innerHTML =  searchResult.output;
        }
    };
    xmlhttp.open("POST", BASE_URL + "/search/result", true);
    xmlhttp.setRequestHeader('Content-Type', 'application/json');
    xmlhttp.send(JSON.stringify({page,keyword}));
}

loadData();