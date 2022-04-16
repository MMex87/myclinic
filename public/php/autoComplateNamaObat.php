<?php 
    require 'fungsi.php';
    header("Content-Type: application/json; charset=UTF-8");

    $search = $_GET['query'];

    $sql = "SELECT * FROM obat WHERE nama_obat LIKE '%$search%' ORDER BY nama_obat DESC";

    $query = $konek -> query($sql);

    $result = $query -> fetch_all(MYSQLI_ASSOC);

    if(count($result) > 0){
        foreach($result as $data){
            $output['suggestions'][] = [
                'value' => $data['nama_obat'],
                'nama_obat' => $data['nama_obat']
            ];
        }
        echo json_encode($output);
    }else{
        $output['suggestions'][] = [
            'value' => '',
            'nama_obat' => ''
        ];
        echo json_encode($output);
    }