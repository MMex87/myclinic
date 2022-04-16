<?php 
    require 'fungsi.php';
    header("Content-Type: application/json; charset=UTF-8");

    $search = $_GET['query'];

    $sql = "SELECT * FROM pasien WHERE nama LIKE '%$search%' ORDER BY nama DESC";

    $query = $konek -> query($sql);

    $result = $query -> fetch_all(MYSQLI_ASSOC);

    if(count($result) > 0){
        foreach($result as $data){
            $output['suggestions'][] = [
                'value' => $data['nama'],
                'nama' => $data['nama']
            ];
        }
        echo json_encode($output);
    }else{
        $output['suggestions'][] = [
            'value' => '',
            'nama' => ''
        ];
        echo json_encode($output);
    }