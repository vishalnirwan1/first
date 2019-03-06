<?php
session_start();
include('config.php');
?>
<?php
$rejectreason = array(20 => 'Bad Content', 21 => 'Title not Suitable', 22 => 'Irrelevant Content', 23 => 'Other');
if (isset($_POST['blog_id'])) {

    $blogid = $_POST['blog_id'];
    $query = 'SELECT reject_reason FROM blogger where bid="' . $blogid . '"';
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $cbvalue = explode(",", $row['reject_reason']);

    foreach ($rejectreason as $key => $value) {
//        foreach ($cbvalue as $key1 => $value1) {
        if (in_array($key, $cbvalue))
            $checked = 'checked="checked"';
        else {
            $checked = '';
        }
//        }
        ?> 
        <input type="checkbox" name= 'rejection[]' class="rejection1" value="<?= $key ?>" <?php echo $checked; ?>  <?php if ($key == '23') { ?> onclick="test();" <?php } ?> autocomplete="off"> <?= $value ?> <br>
        <?php
    }
}
?>              

