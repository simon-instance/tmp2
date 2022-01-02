<header>
    <ul id="navList">
        <li>
            <img id="hamburger" src="/views/img/hamburger.png" width="40" alt="menu" tabindex="-1">
            <div id="menu" tabindex="-1">
                <nav>
                    <ul>
                        <li>
                            <a href="index.html" tabindex="-1">Home</a>
                        </li>
                        <li>
                            <a href="register.html" tabindex="-1">Register</a>
                        </li>
                        <li>
                            <a href="about.html" tabindex="-1">About</a>
                        </li>
                        <li>
                            <a href="privacy.html" tabindex="-1">Privacy</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div id="cancelMenu" tabindex="-1"></div>
        </li>
        <li>
            <img src="/views/img/logo.png" width="170" alt="flatnix">
        </li>
        <li>

            <div id="search">
                <img src="/views/img/search.png" width="32" alt="search" tabindex="-1">
                <div id="searchBox" tabindex="-1">
                    <input type="text" id="searchBar" placeholder="Search" tabindex="1">

                    <label for="genre" id="genreTitle">Filter genres</label>
                    <input style="display:none" id="genre">
                    <div class="searchBox-group">
                        <input id="romance" type="checkbox" name="Romance" tabindex="1">
                        <label for="romance" class="searchBox-group-label">Romance</label>
                    </div>

                    <div class="searchBox-group">
                        <input type="checkbox" name="police" id="police" tabindex="1">
                        <label for="police" class="searchBox-group-label">Police</label>
                    </div>

                    <div class="searchBox-group">
                        <input type="checkbox" name="war" id="war" tabindex="1">
                        <label for="war" class="searchBox-group-label">War</label>
                    </div>

                    <div class="searchBox-group">
                        <input type="checkbox" name="zombie" id="zombie" tabindex="1">
                        <label for="zombie" class="searchBox-group-label">Zombie</label>
                    </div>

                </div>
            </div>
        </li>
    </ul>
</header>