<nav class="navbar navbar-expand-lg ps-4 pe-4"
    style="background-color: #7d64c5; border-radius: 0 0 10px 10px; max-height: 90px;">
    <div class="container-fluid">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center fw-bold">
            <li class="nav-item me-5 btn"
                <?= ($appbar == 'pendaftaran') ? 'style="background-color: #61529A;"' : 'style="background-color: #7d64c5;"' ?>>
                <a href="/" class="nav-link" aria-current="page"
                    style="color: #ffffff; font-family:  'Roboto Mono', monospace; font-weight:650; font-size: 17px; text-align: center;">PENDAFTARAN</a>
            </li>
            <li class="nav-item me-5 btn"
                <?= ($appbar == 'obat') ? 'style="background-color: #61529A;"' : 'style="background-color: #7d64c5;"' ?>>
                <a href="/obat" class="nav-link"
                    style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">OBAT</a>
            </li>
            <li class="nav-item me-5 btn"
                <?= ($appbar == 'pasien') ? 'style="background-color: #61529A;"' : 'style="background-color: #7d64c5;"' ?>>
                <a href="/pasien" class="nav-link"
                    style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">PASIEN</a>
            </li>
            <li class=" nav-item btn"
                <?= ($appbar == 'laporan') ? 'style="background-color: #61529A;"' : 'style="background-color: #7d64c5;"' ?>>
                <a href="/laporan" class="nav-link"
                    style="color: #ffffff; font-family: 'Roboto Mono', monospace; font-weight:650;">LAPORAN</a>
            </li>
        </ul>
    </div>
    <a href="#" class=""><img src="/img/Logo Klinik.png" width="100" height="100" style="margin-right: 20px" /></a>
</nav>