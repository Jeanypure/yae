<?php
/**
 * Created by PhpStorm.
 * User: YM-sale
 * Date: 2018/7/21
 * Time: 9:27
 */
?>

<h4>按币种汇总</h4>

<?php
echo '<table class="kv-grid-table table table-hover table-bordered table-striped kv-table-wrap">';
echo '<thead><tr><th>Currency</th><th>Total</th></tr></thead>';
foreach ($total as $k=>$v){
    echo '<tr><td>';
     echo $v['currency'];
     echo '</td><td>';
     echo $v['total'];
     echo '</td></tr>';
}
echo '</table>';

?>

