<style>

.app-header .navbar {

    margin-left: 260px; w
    width: calc(100vw - 260px);

    width: calc(100vw - 260px);
    max-width: calc(100vw - 260px);

    padding-left: 2px;
    transform: translateX(-2px);

    position: relative;
    left: -25px; /* TAMBAHAN biar bener-bener mentok */
}
.app-header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}

/* kunci scroll tanpa bikin layout geser */
html, body {
    overflow: hidden;
    margin: 0;
}
</style>

 <header class="app-header" style="position:relative; z-index:1; margin-top:-15px;">
    <nav class="navbar navbar-expand-lg navbar-light" style="height:20px; border-bottom:1px solid #ddd; padding-right:20px; background:#83c2e1 !important;">
            <div class="navbar-collapse justify-content-end px-3" style="display:flex; align-items:center;">
            <ul class="navbar-nav align-items-center">
                    <li class="nav-item" style="display:flex; align-items:center;">
                </li>
            </ul>
        </div>
    </nav>
</header>
