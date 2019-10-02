const  scrollWin = () => {
    window.scrollTo(500, 0);
  }
const loadData = (page=1) => {
    let keyword = document.querySelector('.keyword').value;
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let searchResult = JSON.parse(this.responseText);
            document.querySelector('.container').innerHTML =  searchResult.output;
        }
    };
    xmlhttp.open("POST", BASE_URL + "/search/result", true);
    xmlhttp.setRequestHeader('Content-Type', 'application/json');
    xmlhttp.send(JSON.stringify({page,keyword}));
}

loadData();