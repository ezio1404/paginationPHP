<?php
function conn(){
    return new PDO("mysql:host=localhost;dbname=final","root","");
}

function totalSize(){
    $conn = conn();
    $sql = "SELECT COUNT(*) FROM tbl_student";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $total = $stmt->fetchColumn();
    $conn = null;
    return $total;
}

function tableData($offset, $itemSize){
    $conn = conn();
    $sql = "SELECT * FROM tbl_student LIMIT $offset, $itemSize";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    return $row;
}