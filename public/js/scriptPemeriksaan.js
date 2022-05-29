
document.addEventListener('click', async function (e) {
    if (e.target.classList.contains('btn-view')) {
        const id_pendaftaran = e.target.dataset.id;
        const pasienDetail = await getPasienDetail(id_pendaftaran)
        updateUiDetail(pasienDetail);
    }
});

function getPasienDetail(id) {
    return fetch('http://localhost:8081/php/pemeriksaanJson.php?id=' + id)
        .then(response => response.json())
        .then(m => m);
}

function updateUiDetail(m) {
    const pasien_detail = showDetail(m);

    const modalBody = document.querySelector('.modal-body');
    modalBody.innerHTML = pasien_detail;
}


function showDetail(m) {
    return `<div class="row">
    <div class="col-3">
        <div class="card text-end" style="width: 13rem;">
            <ul class="list-group list-group-flush">
                <div class="col">
                    <li class="list-group-item"><strong>Tanggal Daftar:</strong></li>
                    <li class="list-group-item"><strong>Nama:</strong></li>
                    <li class="list-group-item"><strong>BPJS:</strong></li>
                    <li class="list-group-item"><strong>Tanggal Lahir:</strong></li>
                    <li class="list-group-item"><strong>Jenis Kelamin:</strong></li>
                </div>
            </ul>
        </div>
    </div>
    <div class="col">
        <li class="list-group-item"><strong>${m.tanggal_daftar}</strong></li>
        <li class="list-group-item"><strong>${m.nama}</strong></li>
        <li class="list-group-item"><strong>${m.no_bpjs}</strong></li>
        <li class="list-group-item"><strong>${m.tanggal_lahir}</strong></li>
        <li class="list-group-item"><strong>${m.jenis_kelamin}</strong></li>
    </div>
</div>`;
}

































// document.addEventListener('onload', async function () {
//     try {
//         const pasien = await getPasien();
//         updateUI(pasien);
//     } catch (err) {
//         alert(err);
//     }
// })


// function getPasien() {
//     return fetch('pemeriksaanJson.php')
//         .then(response => response.json())
//         .then(response => {
//             if (response.status === 0) {
//                 throw new Error(response.message);
//             }
//             return response.Data
//         })
// }

// function updateUI(pasien) {
//     pasien.forEach(m => {
//         let cards = '';
//         cards += showCard(m);
//         const pasienContainer = document.querySelector('.view-pasien');
//         pasienContainer.innerHTML = cards;
//     });
// }

// function showCard(m) {
//     let i = 1;
//     return `<tr class="data"
//     style="color: black; font-family:  'Roboto Mono', monospace; font-weight:400;">
//     <th scope="row">${i++}</th>
//     <td scope="row">${m.no_rm}</td>
//     <td scope="row">${m.nama}</td>
//     <td scope="row">${m.jenis_kelamin}</td>
//     <td scope="row" style="color: red;">${m.tanggal_daftar}</td>
//     <td scope="row">
//         <a><button type="button" class="tombol btn-warning mb-1 btn-view" data-bs-toggle="modal"
//                 data-bs-target="#viewModal" data-id-pendaftaran="${m.id_pendaftaran}">Detail</button></a>
//     </td>
//     </tr>`
// }