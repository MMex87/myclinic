<?php  
    require 'fungsi.php';
    header("Content-Type: application/json; charset=UTF-8");

    $search = $_GET['query'];

    $sql = "SELECT * FROM pasien WHERE nik LIKE '%$search%' ORDER BY nik DESC";

    $query = $konek -> query($sql);

    $result = $query -> fetch_all(MYSQLI_ASSOC);

    if(count($result) > 0){
        foreach($result as $data){
            $output['suggestions'][] = [
                'value' => $data['nik'],
                'nik' => $data['nik']
            ];
        }
        echo json_encode($output);
    }else{
        $output['suggestions'][]= [
            'value' => '',
            'nik' => ''
        ];

        echo json_encode($output);
    }
?>