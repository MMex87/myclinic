<?= $this->extend('layout/appbar'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Klinik Akiva</title>
    <link rel="icon" href="/img/Logo Klinik.jpeg">

    <!-- JQuery TimeStamp -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous">
    </script>
</head>

<body style="background: #c4b8e7;">

    <!-- Menambahkan Appbar -->
    <?= $this->include('layout/appbar'); ?>
    <div class="container-fluid ps-5 pe-5 link-BC" style="margin-bottom: 150px;">
        <div class="row pt-3 container-fluid ms-1">
            <div class='col-5'>
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-3">
                    <ol class="breadcrumb fw-bold fs-4">
                        <li class="breadcrumb-item"
                            <?= ($scrumb == 'pasien') ? 'style="color: #7d64c5"' : 'style="color: #8471C9"' ?>>
                            <?= ($scrumb == 'pasien') ? 'DATA PASIEN' : '<a href="/">DATA PASIEN</a>' ?>
                        </li>
                        <li class="breadcrumb-item"
                            <?= ($scrumb == 'diagnosa') ? 'style="color: #7d64c5"' : 'style="color: #8471C9"' ?>>
                            <?= ($scrumb == 'diagnosa') ? 'DIAGNOSA' : '<a href="/pendaftaran/diagnosa">DIAGNOSA</a>' ?>
                        </li>
                        <li class="breadcrumb-item"
                            <?= ($scrumb == 'obat') ? 'style="color: #7d64c5"' : 'style="color: #8471C9"' ?>>
                            <?= ($scrumb == 'obat') ? 'OBAT' : '<a href="/pendaftaran/obat">OBAT</a>' ?>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class='col-7 align-top mt-3'>
                <h4 class="ms-5 mt-2" id="timestamp" style="float: right;"></h4>
            </div>
        </div>

        <!-- deklarasi template -->
        <?= $this->renderSection('content'); ?>

    </div>


    <!-- footer -->
    <div class="footer" style=" margin-top: 80px; position: absolute; width: 100%;">
        <footer class="text-center text-white"
            style="font-family: 'Roboto Mono', monospace; font-weight:550; background-color : #5C5081;">
            <div class="text-center p-3">Create With <p style="color: #FFFFFF;">
            </div>
        </footer>
    </div>



    <!-- Script Ajax  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- Memanggil Autocomplete.js -->
    <script src="/js/jquery.autocomplete.min.js"></script>

    <!-- Memanggil Autocomplete.js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js"></script> -->


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>