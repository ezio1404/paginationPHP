<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
</head>
<body>
<?php
include 'db.php';
if(isset($_GET['page_no'])){
    $page_no = $_GET['page_no'];
}else{
    $page_no = 1;
}
$pagesToShow = 6;
$itemsPerPage = 5;
$offset = ($page_no-1) * $itemsPerPage;
$totalSize = totalSize();
$totalPage = ceil($totalSize /  $itemsPerPage);

$tableData = tableData($offset,$itemsPerPage);
$head = array('ID','First Name','Last Name','Email');
?>
<table>
<tr>
<?php
foreach($head as $header){
    echo '<th>'.$header.'</th>';
}
?>
</tr>
<?php
foreach($tableData as $data){
    echo '<tr>';
        foreach($data as $d){
            echo '<td>'.$d.'</td>';
        }
    echo '</tr>';
}
?>
</table>

<?php 
    $halfPages = floor($pagesToShow / 2);
    $range = array('start' => 1, 'end' => $totalPage);
    $isEven = ($pagesToShow % 2 == 0);
    $atRangeEnd = $totalPage - $halfPages;
    if($isEven) { $atRangeEnd++; }
    if($totalPage > $halfPages){
        if($page_no <= $halfPages){
            $range['end'] = $pagesToShow;
        }
        elseif($page_no >= $atRangeEnd){
            $range['start'] = $totalPage - $pagesToShow + 1;
        }
        else{
            $range['start'] = $page_no - $halfPages;
            $range['end'] = $page_no + $halfPages;
            if($isEven) { $range['end']--; }
        }
    }
  
    
?>
<ul class="pagination">
<li class="<?php echo ($page_no <= 1) ?  'disabled': '' ?>">
    <a href="?page_no=1">First</a>
</li>
 <li class="<?php echo ($page_no <= 1) ? 'disabled' : ''; ?>">
    <a href="<?php echo ($page_no <= 1) ?  '#' : '?page_no='.($page_no - 1); ?>">Prev</a>
</li>

<?php for($i = $range['start']; $i <= $range['end']; $i++){
    ?>
    <li class="<?php echo ($page_no == $i) ? 'active': ' '; ?>">
        <a href="?page_no=<?php echo $i; ?>"><?php echo $i ?></a>
    </li>
    <?php
}
?>
<li class="<?php echo ($page_no >= $totalPage) ? 'disabled' : '' ?>">
    <a href="<?php echo ($page_no >= $totalPage) ? '#' : '?page_no='.($page_no + 1); ?>">Next</a>
</li> 
<li class="<?php echo ($page_no == $totalPage) ? 'disabled': ''; ?>">
    <a href="?page_no=<?php echo $totalPage ?>">Last</a>
</li>
</ul>
</body>
</html>