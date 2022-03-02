<link rel="stylesheet" href="<?php echo(ROOTFRONT . '/back/css/style.css');?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Amarante&family=Assistant:wght@300;600&display=swap" rel="stylesheet">


<header class="menu-desktop2">
    <div class=menu-desktop>
        
        <nav>
            <ul class="menu">
                <li class="menu-accueil">
                    <a href="index1.html" class=accueil>accueil</a>
                </li>
                <li class="menu-apropos">
                    <a href="apropos.html" class=apropos>a propos</a>
                </li>
                <li class="menu-articles">
                    <a href="articles.html" class=articles>articles</a>
                </li>
                <!-- <li>
                    <a href="construction.html">Nous soutenir</a>
                </li> -->
            </ul>
        </nav>
        
        <a href="index.html">
            <img class="logo" src="<?php echo(ROOTFRONT . '/front/assets/images/logoBrrrdeaux.svg');?>" alt="Logo Brrrdeaux" />
        </a>

        <nav>
            <ul class="bar">
                <li class="bar-compte">
                    <a href="connect.html" class=connect>mon compte</a>
                </li>
                <li>
                    <select>
                        <option value="Français">fr</option>
                        <option value="English">eng</option>
                        <option value="Espanol">es</option>
                    </select>
                </li>
                <li>
                    <form>
                        <div class="icon-search">
                            <img class="logo-menu" src="<?php echo(ROOTFRONT . '/front/assets/images/search.svg');?>" alt="Loupe" />
                            <input type="search" id="Research" name="q" placeholder="Rechercher" size="50">
                        </div>
                    </form>
                </li>
                <!-- <li>
                    <a href="construction.html">Nous soutenir</a>
                </li> -->
            </ul>
        </nav>
    </div>
</header>

<!-- header mobile -->
<!-- <header class="menu-mobile">
    <nav class="navbar navbar-light" style="background-color: #1C1C1F">
        <div class="container">
   

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="index.html">
                <img src="/assets/images/logo_capc-large.svg" alt="logo-mobile" width="82px" height="42px">
            </a>

            <a href="construction.html" class=billetterie>
                <img class="logo-menu" src="assets/images/index_icon-ticket.svg" alt="Logo ticket" /> billetterie

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Le musée
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="construction.html">À propos</a></li>
                    <li><a class="dropdown-item" href="construction.html">Bibliothèque</a></li>
                    <li><a class="dropdown-item" href="construction.html">Boutique</a></li>
                    </ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Expositions et Évènements
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="construction.html">La collection permanante</a></li>
                    <li><a class="dropdown-item" href="expos.html">Expositions</a></li>
                    <li><a class="dropdown-item" href="construction.html">Évènements</a></li>
                    </ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Infos pratiques
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="construction.html">Contact</a></li>
                    <li><a class="dropdown-item" href="construction.html">Plan d'accès</a></li>
                    <li><a class="dropdown-item" href="construction.html">Actualités</a></li>
                    <li><a class="dropdown-item" href="construction.html">Accessibilité</a></li>
                    </ul>    
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="construction.html">Nous soutenir</a>
                </li>

                </ul>


                <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="rechercher" aria-label="rechercher">
                <button class="btn btn-outline-success" type="submit"></button>
                </form>
          </div>
        </div>
    </nav>


    </nav>
</header> -->