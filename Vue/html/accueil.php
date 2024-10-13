<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/accueil.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <title>Accueil</title>
</head>

<body>
    <div class="container">
        <header>
            <div class="header">
                <img src="../../images/logo.png" alt="logo" width="120px">

                <!-- La Barre de navigation -->
                <nav class="navbar">
                    <ul>
                        <li><a class="navbar-item-first" href="">Vente</a></li>
                        <li><a class="navbar-item" href="">Exposition</a></li>
                        <li><a class="navbar-item" href="">News</a></li>
                        <li class="deroulant"><a class="navbar-item" href="">Plus</a>
                            <ul class="dropdown">
                                <li><a href="#">Tableaux</a></li>
                                <li><a href="#">Statut</a></li>
                                <li><a href="#">Peinture</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                
                <div class="end-container">
                    <div class="searchBar">
                        <form>
                            <input type="search" placeholder="Rechercher...">
                            <button type="submit">Rechercher</button>
                        </form>
                    </div>

                    <!-- les différents icon utilisateur (pour se diriger vers la page favoris, se connecter ...) -->
                    
                    <div class="user">
                        <div class="icon">
                            <a class="icon-user" href="#"><svg width="18" height="18" viewBox="0 0 27 32" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M23.1821 3.59965C22.602 2.78133 21.9132 2.13218 21.1551 1.68929C20.397 1.24639 19.5844 1.01843 18.7639 1.01843C17.9433 1.01843 17.1307 1.24639 16.3726 1.68929C15.6145 2.13218 14.9257 2.78133 14.3456 3.59965L13.1417 5.29717L11.9377 3.59965C10.7659 1.94747 9.17665 1.01929 7.51949 1.01929C5.86233 1.01929 4.27304 1.94747 3.10125 3.59965C1.92946 5.25183 1.27116 7.49267 1.27116 9.8292C1.27116 12.1657 1.92946 14.4066 3.10125 16.0588L13.1417 30.2154L23.1821 16.0588C23.7625 15.2408 24.2229 14.2697 24.537 13.2008C24.8511 12.1319 25.0128 10.9862 25.0128 9.8292C25.0128 8.67219 24.8511 7.52652 24.537 6.45763C24.2229 5.38874 23.7625 4.41759 23.1821 3.59965Z"
                                        stroke="#1E1E1E" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                        <div class="icon">
                            <a class="icon-user" href="#">
                                <svg width="18" height="18" viewBox="0 0 28 31" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M26.75 14.7291C26.7549 16.7639 26.318 18.7712 25.475 20.5875C24.4754 22.7639 22.9388 24.5945 21.0372 25.8743C19.1356 27.154 16.9442 27.8324 14.7083 27.8333C12.8385 27.8386 10.994 27.3632 9.325 26.4458L1.25 29.375L3.94167 20.5875C3.09865 18.7712 2.66179 16.7639 2.66667 14.7291C2.66753 12.296 3.29087 9.91121 4.46685 7.84183C5.64284 5.77245 7.32503 4.10023 9.325 3.01248C10.994 2.09509 12.8385 1.61968 14.7083 1.62498H15.4167C18.3695 1.80226 21.1585 3.15857 23.2496 5.43422C25.3408 7.70987 26.5871 10.7449 26.75 13.9583V14.7291Z"
                                        stroke="#1E1E1E" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </div>
                        <div class="icon">
                            <a class="icon-user" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18" viewBox="0 -960 960 960" width="18"
                                    fill="#87ceeb">
                                    <path
                                        d="M200-80q-33 0-56.5-23.5T120-160v-480q0-33 23.5-56.5T200-720h80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720h80q33 0 56.5 23.5T840-640v480q0 33-23.5 56.5T760-80H200Zm0-80h560v-480H200v480Zm280-240q83 0 141.5-58.5T680-600h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85h-80q0 83 58.5 141.5T480-400ZM360-720h240q0-50-35-85t-85-35q-50 0-85 35t-35 85ZM200-160v-480 480Z" />
                                </svg>
                            </a>
                        </div>
                        <div class="icon">
                            <a class="icon-user" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960"
                                    width="18px" fill="#5f6368">
                                    <path
                                        d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                                </svg>
                            </a>
                        </div>
                        <div class="icon-trad">
                            <a href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#5f6368">
                                    <path
                                        d="M480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-155.5t86-127Q252-817 325-848.5T480-880q83 0 155.5 31.5t127 86q54.5 54.5 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-82q26-36 45-75t31-83H404q12 44 31 83t45 75Zm-104-16q-18-33-31.5-68.5T322-320H204q29 50 72.5 87t99.5 55Zm208 0q56-18 99.5-55t72.5-87H638q-9 38-22.5 73.5T584-178ZM170-400h136q-3-20-4.5-39.5T300-480q0-21 1.5-40.5T306-560H170q-5 20-7.5 39.5T160-480q0 21 2.5 40.5T170-400Zm216 0h188q3-20 4.5-39.5T580-480q0-21-1.5-40.5T574-560H386q-3 20-4.5 39.5T380-480q0 21 1.5 40.5T386-400Zm268 0h136q5-20 7.5-39.5T800-480q0-21-2.5-40.5T790-560H654q3 20 4.5 39.5T660-480q0 21-1.5 40.5T654-400Zm-16-240h118q-29-50-72.5-87T584-782q18 33 31.5 68.5T638-640Zm-234 0h152q-12-44-31-83t-45-75q-26 36-45 75t-31 83Zm-200 0h118q9-38 22.5-73.5T376-782q-56 18-99.5 55T204-640Z" />
                                </svg>
                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </header>

        <!-- Contenu de la page d'accueil -->
        <div class="page-content">
            <div class="contentbase">
                <button type="button" class="sellproduct">Vendre une oeuvre</button>
                <div class="content-description">
                    <p class="description">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                        occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                    </p>
                </div>
            </div>
        </div>

        <footer>

            <!-- icones réseaux sociaux -->
            <div class="social-network">
                <a href="#"><svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M14.2737 10.1635L23.2023 0H21.0872L13.3313 8.82305L7.14125 0H0L9.3626 13.3433L0 24H2.11504L10.3002 14.6806L16.8388 24H23.98M2.8784 1.5619H6.12769L21.0856 22.5148H17.8355"
                            fill="#1E1E1E" />
                    </svg></a>
                <a href="#"><svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.98 2.163C16.184 2.163 16.564 2.175 17.83 2.233C21.082 2.381 22.601 3.924 22.749 7.152C22.807 8.417 22.818 8.797 22.818 12.001C22.818 15.206 22.806 15.585 22.749 16.85C22.6 20.075 21.085 21.621 17.83 21.769C16.564 21.827 16.186 21.839 12.98 21.839C9.77598 21.839 9.39598 21.827 8.13098 21.769C4.87098 21.62 3.35998 20.07 3.21198 16.849C3.15398 15.584 3.14198 15.205 3.14198 12C3.14198 8.796 3.15498 8.417 3.21198 7.151C3.36098 3.924 4.87598 2.38 8.13098 2.232C9.39698 2.175 9.77598 2.163 12.98 2.163ZM12.98 0C9.72098 0 9.31298 0.014 8.03298 0.072C3.67498 0.272 1.25298 2.69 1.05298 7.052C0.99398 8.333 0.97998 8.741 0.97998 12C0.97998 15.259 0.99398 15.668 1.05198 16.948C1.25198 21.306 3.66998 23.728 8.03198 23.928C9.31298 23.986 9.72098 24 12.98 24C16.239 24 16.648 23.986 17.928 23.928C22.282 23.728 24.71 21.31 24.907 16.948C24.966 15.668 24.98 15.259 24.98 12C24.98 8.741 24.966 8.333 24.908 7.053C24.712 2.699 22.291 0.273 17.929 0.073C16.648 0.014 16.239 0 12.98 0ZM12.98 5.838C9.57698 5.838 6.81798 8.597 6.81798 12C6.81798 15.403 9.57698 18.163 12.98 18.163C16.383 18.163 19.142 15.404 19.142 12C19.142 8.597 16.383 5.838 12.98 5.838ZM12.98 16C10.771 16 8.97998 14.21 8.97998 12C8.97998 9.791 10.771 8 12.98 8C15.189 8 16.98 9.791 16.98 12C16.98 14.21 15.189 16 12.98 16ZM19.386 4.155C18.59 4.155 17.945 4.8 17.945 5.595C17.945 6.39 18.59 7.035 19.386 7.035C20.181 7.035 20.825 6.39 20.825 5.595C20.825 4.8 20.181 4.155 19.386 4.155Z"
                            fill="#1E1E1E" />
                    </svg>
                </a>
                <a href="#"><svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.595 3.184C16.991 2.938 8.96398 2.939 5.36498 3.184C1.46798 3.45 1.00898 5.804 0.97998 12C1.00898 18.185 1.46398 20.549 5.36498 20.816C8.96498 21.061 16.991 21.062 20.595 20.816C24.492 20.55 24.951 18.196 24.98 12C24.951 5.815 24.496 3.451 20.595 3.184ZM9.97998 16V8L17.98 11.993L9.97998 16Z"
                            fill="#1E1E1E" />
                    </svg>
                </a>
                <a href="#"><svg width="20" height="20" viewBox="0 0 25 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19.98 0H5.97998C3.21898 0 0.97998 2.239 0.97998 5V19C0.97998 21.761 3.21898 24 5.97998 24H19.98C22.742 24 24.98 21.761 24.98 19V5C24.98 2.239 22.742 0 19.98 0ZM8.97998 19H5.97998V8H8.97998V19ZM7.47998 6.732C6.51398 6.732 5.72998 5.942 5.72998 4.968C5.72998 3.994 6.51398 3.204 7.47998 3.204C8.44598 3.204 9.22998 3.994 9.22998 4.968C9.22998 5.942 8.44698 6.732 7.47998 6.732ZM20.98 19H17.98V13.396C17.98 10.028 13.98 10.283 13.98 13.396V19H10.98V8H13.98V9.765C15.376 7.179 20.98 6.988 20.98 12.241V19Z"
                            fill="#1E1E1E" />
                    </svg>
                </a>
            </div>

            <!-- infos footer (aide, contact ...) -->
            <div class="container-footer">
                <a class="title-footer">Qui sommes nous</a>
                <a class="item-footer" href="#">NovArt</a>
                <a class="item-footer" href="#">Galeris</a>
            </div>
            <div class="container-footer">
                <a class="title-footer">Aide</a>
                <a class="item-footer" href="#">Foire aux questions</a>
                <a class="item-footer" href="#">Contacts</a>
            </div>
            <div class="container-footer">
                <a class="title-footer">Informations légales</a>
                <a class="item-footer" href="#">Conditions d'utilisations</a>
                <a class="item-footer" href="#">Mentions légales</a>
            </div>

        </footer>
    </div>
</body>


</html>