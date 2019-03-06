<?php

include('config.php');
//print_r($_GET);die;
$where = '';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="blogs.csv"');
$output = fopen("php://output", "w");
fputcsv($output, array('Id', 'Category', 'Title', 'Credits', 'Date', 'Blog Status'));

if (isset($_GET['title']) && $_GET['title'] != '') {
    $title1 = $_GET['title'];
    $where .= ' and b.title LIKE "%' . "$title1" . '%"';
}
if (isset($_GET['name']) && $_GET['name'] != '') {
    $fname = $_GET['name'];
    $where .= ' and i.firstname LIKE "%' . "$fname" . '%"';
}
if (isset($_GET['from']) && isset($_GET['to']) && !empty($_GET['from']) && !empty($_GET['to'])) {
    $from_date = $_GET['from'];
    $to_date = $_GET['to'];

    $where.="and b.created_date BETWEEN '$from_date' AND '$to_date'";
}
if (isset($_GET['from']) && !empty($_GET['from']) && empty($_GET['to'])) {

    $from_date = $_GET['from'];
    $to_date = $_GET['to'];
    $where.="and b.created_date  >=  '$from_date'";
}

if (isset($_GET['to']) && !empty($_GET['to']) && empty($_GET['from'])) {
    $from_date = $_GET['from'];
    $to_date = $_GET['to'];
    $where.="and b.created_date <= '$to_date' ";
}
if (isset($_GET['blogstatus']) && $_GET['blogstatus'] != '') {
    $blogStatus = $_GET['blogstatus'];

    if ($blogStatus == 1 && $blogStatus != "") {
        $where.=" and b.blog_status=1";
    }

    if ($blogStatus == 2 && $blogStatus != "") {
        $where.=" and b.blog_status=2";
    }
    if ($blogStatus == 3 && $blogStatus != "") {
        $where.=" and b.blog_status=3";
    }
}

$query = "Select b.bid, b.category, b.title,i.firstname,  b.created_date, b.blog_status  FROM blogger as b INNER JOIN info as i ON i.id=b.id  where 1=1 " . $where . " ORDER BY b.created_date DESC";
$result = mysqli_query($conn, $query);
//  print_r($result);die;
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

fclose($output);
?>