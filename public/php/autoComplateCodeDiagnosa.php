<?php
    require 'fungsi.php';
    header("Content-Type: application/json; charset=UTF-8");

    $search = $_GET['query'];

    $sql = "SELECT * FROM icd_10 WHERE code1 LIKE '%$search%' OR code2 LIKE '%$search%'";

    $query = $konek -> query($sql);

    $result = $query -> fetch_all(MYSQLI_ASSOC);

    if(count($result) > 0){
        foreach($result as $data){
            $output['suggestions'][] = [
                'value' => $data['code1'],
                'code' => $data['code1']
            ];
            $output['suggestions'][] = [
                'value' => $data['code2'],
                'code' => $data['code2']
            ];
        }
        echo json_encode($output);
    }else{
        $output['suggestions'][] = [
            'value' => '',
            'code' => ''
        ];
        echo json_encode($output);
    }
?>