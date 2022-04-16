<nav class=" navbar navbar-expand-lg ps-4 pe-4"
    style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
            <?php if ($detail == 'pasien') { ?>
            <li class="nav-item me-5 btn"
                style="background-color: #61529A; border-radius: 3px; width: 150px; text-align: center;">
                <a href="/<?= $detail; ?>" class="nav-link " aria-current="page"
                    style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">BACK</a>
            </li>
            <?php } else if ($detail == 'obat') {  ?>
            <li class="nav-item me-5 btn"
                style="background-color: #61529A; border-radius: 3px; width: 150px; text-align: center;">
                <a href="/<?= $detail; ?>" class="nav-link " aria-current="page"
                    style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">BACK</a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <a href="#" class=""><img src="/img/Logo Klinik.png" width="100" height="100" style="margin-right: 20px" /></a>
</nav>