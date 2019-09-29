<div class="navbar white-background">
    <div class="left-navbar">
        <div>
            <a href="<?= BASE_URL; ?>/home/index">
                <b class="blue-color">Engi</b>ma
            </a>
        </div>
        <div class="input-box">
            <!-- TODO: rapihin search icon -->
            <form action="<?= BASE_URL; ?>/search" method="POST" class="form-navbar">
                <input type="text" placeholder="Search movie" name="keyword" onkeyup="getSearchResult(this.value)">
                <img class="svg-big" src="<?= BASE_URL; ?>/assets/icon/search-solid.svg" autocomplete=off>
                <button type="submit" name="submit" hidden></button>
            </form>
        </div>
    </div>
    <div class="right-navbar">
        <a href="<?= BASE_URL; ?>/transhistory">Transactions</a>
        <a href="<?= BASE_URL; ?>/login/logout">Logout</a>
    </div>
</div>