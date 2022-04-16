<?php  
    require 'fungsi.php';
    header("Content-Type: application/json; charset=UTF-8");

    $search = $_GET['query'];

    $sql = "SELECT * FROM pasien WHERE no_bpjs LIKE '%$search%' ORDER BY nik DESC";

    $query = $konek -> query($sql);

    $result = $query -> fetch_all(MYSQLI_ASSOC);

    if(count($result) > 0){
        foreach($result as $data){
            $output['suggestions'][] = [
                'value' => $data['no_bpjs'],
                'no_bpjs' => $data['no_bpjs'],
            ];
        }
        echo json_encode($output);
    }else{
        $output['suggestions'][]= [
            'value' => '',
            'no_bpjs' => ''
        ];

        echo json_encode($output);
    }
?>