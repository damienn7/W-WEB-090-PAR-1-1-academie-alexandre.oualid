<header class="header-container-home blur col blocks">
                    <div class="container">


                        <div class="row">
                            <a href="#" id="home"><img src="../public/img/twitter_logo.png" alt="logo de twitter"
                            id="oiseaulogo" class="logos img-icon"></a>
                        </div>

                        <div class="light">
                            <h4>Choississez votre thème :</h4>
                            <select id="theme-select">
                                <option value="light" data-icon="img/sun-svgrepo-com.svg">Clair</option>
                                <option value="dark" data-icon="/img/moon-svgrepo-com.svg">Sombre</option>
                            </select>
                            <button id="apply-theme-btn">Appliquer</button>
                        </div>
                        
                        <div class="row">
                            <a href="#" class="row" id="home"><img src="../public/img/logo_maison.png" alt="logo de l'Accueil"
                            class="logos img-icon"><span>Accueil</span></a>
                        </div>
                        <div class="row">
                            <a href="#" class="row" id="explore"><img src="../public/img/hashtag.png" alt="logo hashtag"
                            class="logos img-icon"><span>Explorer</span></a>
                        </div>
                        <?php if (isset($_SESSION["logged_in"])): ?>
                            <div class="row">
                                <a href="#" class="row" id="notification"><img src="../public/img/logo_cloche.png" alt="logo notification"
                                        class="logos img-icon"><span>Notifications</span></a>
                            </div>
                            <div class="row">
                                <a href="#" class="row" id="message"><img src="../public/img/logo_message.png" alt="logo messages"
                                        class="logos img-icon"><span>Messages</span></a>
                            </div>
                            <div class="row">
                                <a href="#" class="row" id="account"><img src="../public/img/logo_profil.png" alt="logo profil"
                                        class="logos img-icon"><span>Profil</span></a>
                            </div>
                            <div class="row">
                                <a href="#" class="row" id="more"><img src="../public/img/logo_plus.png" alt="logo plus"
                                        class="logos img-icon"><span>Plus</span></a>
                            </div>

 
                            


                        <?php endif; ?>

                    </div>
                </header>