<table border="1">
    <?php
    include 'getResQuery.php';

    $res = getResQuery($_POST['filter_type']);
    $rows = $res->num_rows;

    $num = 5;
    $page = $_POST['page'];

    $total = intval(($rows - 1) / $num) + 1;
    $page = intval($page);
    if (empty($page) or $page < 0) $page = 1;
    if ($page > $total) $page = $total;
    $start = $page * $num - $num;

    $res = getResQuery($_POST['filter_type'], $start, $num);
    $rows = $res->num_rows;

    for ($i = 0; $i < $rows; $i++) {
        $res->data_seek($i);
        $value = $res->fetch_row();
    ?>
        <tr>
            <?php
            for ($j = 0; $j < count($value); $j++) { ?>
                <td><?= $value[$j] ?></td>
            <?php } ?>
        </tr>
    <?php
    }
    $res->close();
    ?>
</table>

<?php

if ($page != 1) $pervpage = '<a href="" onclick=" filter(1); return false;"><<</a>
                               <a href="" onclick=" filter(' . ($page - 1) . '); return false;"><</a> ';
if ($page != $total) $nextpage = ' <a href="" onclick=" filter(' . ($page + 1) . '); return false;">></a>
                                   <a href="" onclick=" filter(' . ($total) . '); return false;">>></a>';

if ($page - 2 > 0) $page2left = ' <a href="" onclick=" filter(' . ($page - 2) . '); return false;">' . ($page - 2) . '</a> | ';
if ($page - 1 > 0) $page1left = '<a href="" onclick=" filter(' . ($page - 1) . '); return false;">' . ($page - 1) . '</a> | ';
if ($page + 2 <= $total) $page2right = ' | <a href="" onclick=" filter(' . ($page + 2) . '); return false;">' . ($page + 2) . '</a>';
if ($page + 1 <= $total) $page1right = ' | <a href="" onclick=" filter(' . ($page + 1) . '); return false;">' . ($page + 1) . '</a>';

echo $pervpage . $page2left . $page1left . '<b>' . $page . '</b>' . $page1right . $page2right . $nextpage;
