<?php
$page = $patients->PaginationPatients();

if (!empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $page){
    $_GET['page'] = intval($_GET['page']);
    $pageCourante = $_GET['page'];
} else {
    $pageCourante = 1;
}
$start = ($pageCourante-1) * $patientsByPage;
?>