<?php
function getResQuery($filterType, $start = 0, $num = 0)
{
    include 'login.php';
    $con = new mysqli($srv, $usr, $pwd, $db);
    if ($con->connect_error) die($con->connect_error);
    $offset = ($num == 0) ? '' :  "LIMIT $start, $num";

    switch ($filterType) {
        case 1:
            $sql = "SELECT `first_name`,`last_name`,`data_of_birth` FROM user WHERE DATEDIFF(CURRENT_DATE(), `created_at`) < 90 ORDER BY `last_name`" . $offset;
            return $con->query($sql);
            break;
        case 2:
            $sql =  "SELECT `first_name`, `middle_name`, `last_name`, `description` FROM `user_dismission`\n"

                . "LEFT JOIN user on user_dismission.user_id = user.id\n"

                . "LEFT JOIN dismission_reason on user_dismission.reason_id = dismission_reason.id " . $offset;
            return $con->query($sql);
            break;
        case 3:
            $sql =  "SELECT department.description as 'Отдел', (SELECT CONCAT (user.first_name, ' ', user.last_name) FROM user_position LEFT JOIN user on user_position.user_id = user.id WHERE user_position.department_id = department.id and user_position.user_id = department.leader_id ORDER BY user_position.created_at DESC LIMIT 1 ) as 'Начальник отдела', (SELECT CONCAT (user.first_name, ' ', user.last_name) FROM user_position LEFT JOIN user on user_position.user_id = user.id WHERE user_position.department_id = department.id and user_position.user_id <> department.leader_id ORDER BY user_position.created_at DESC LIMIT 1 ) as 'Последний нанятый сотрудник' FROM department " . $offset;
            return $con->query($sql);
            break;

        default:

            break;
    }
}
