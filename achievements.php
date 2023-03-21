<?php

header('Content-type: application/json');

include '../../database.php';

$q = $_GET['ach']; 

$parametr = explode("/", $q);
$type = $parametr[0];
$id = $parametr[1];
$last_id = $parametr[2];

$mehtod = $_SERVER['REQUEST_METHOD'];

if($mehtod === 'GET'){

    if($type === 'achievements'){

        if(isset($id) and !isset($last_id)){

        $query = $link->query("SELECT count(*) AS count FROM Achievements");
    
        $count = $query->fetch_assoc();
        $result = array();
            
        $query = $link->query("SELECT * FROM Achievements where id_Achievements = $id");
    
        while($rowData = $query->fetch_assoc()){
        $result[] = $rowData;
        }

        $endResult = array('count'=>$count['count'], 'data'=>$result[0]);
        echo json_encode($endResult);

        $link->close();
    }
        elseif(isset($id) and isset($last_id)){
            $query = $link->query("SELECT count(*) AS count FROM Achievements");
    
            $count = $query->fetch_assoc();
            $result = array();
            $result[0] = $count;
            
            $query = $link->query("SELECT * FROM Achievements LIMIT $id, $last_id ");
    
            while($rowData = $query->fetch_assoc()){
            $result[] = $rowData;
            }

            echo json_encode($result);

            $link->close();
        }
        else {
            $query = $link->query("SELECT count(*) AS count FROM Achievements");
    
            $count = $query->fetch_assoc();
            $result = array();
            
            $query = $link->query("SELECT * FROM Achievements");
        
            while($rowData = $query->fetch_assoc()){
            $result[] = $rowData;
            }

            $endResult = array('count'=>$count['count'], 'data'=>$result);

            echo json_encode($endResult);
    
            $link->close();
        }

    }

}
elseif($mehtod === 'POST'){
    echo 'Post';
}

?>