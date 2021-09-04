<?php
	include '../conn.php';
	$id = $_GET['id'];

	// $queryResult=$connect -> query("SELECT * FROM user  ");
	$queryResult=$conn -> query("SELECT * FROM tb_usernew where user_studentID ='$id'");

	$result = array ();

	while ($fetchData = $queryResult->fetch_assoc()) {
        $sql = "SELECT * FROM `tb_timeline` 
    INNER JOIN `tb_usernew` ON tb_usernew.user_studentID = tb_timeline.user_studentID 
WHERE tb_usernew.user_studentID = '$id' ORDER BY tb_timeline.time_checkout DESC";
        $result2 = $conn->query($sql);
        $s = false;
        $res = array();
        if ($result2->num_rows > 0) {
            $record = array();
            $place_item = array();
            $status = "";
            while ($row = $result2->fetch_assoc()) {
                $now = date('Y-m-d');
                $query = "SELECT tb_riskarea.*,tb_epidemic.* 
FROM tb_riskarea INNER JOIN tb_timeline ON tb_riskarea.placeID = tb_timeline.place_id INNER JOIN tb_epidemic ON tb_epidemic.epidemic_id = tb_riskarea.epidemic_id 
WHERE DATEDIFF('$now',tb_riskarea.endDate) <= 14 and tb_timeline.user_studentID = '{$row['user_studentID']}' GROUP BY tb_riskarea.riskarea_id";
                $result_query = $conn->query($query);
                if ($result_query->num_rows > 0) {

                    while ($row_query = $result_query->fetch_assoc()) {
                        $place_item = [...$place_item, $row_query];
                    }
                    $record = $row;
                    $s = true;
                    break;
                }
            }

            if ($s) {
                $origin = new DateTime($record['time_checkout']);
                $target = new DateTime('now');
                $interval = $origin->diff($target);
                $diff = $interval->format('%a');
                $res['places'] = $place_item;
                if ($diff <= 14) {
                    $res['status'] = "มีความเสี่ยงสูง";
                    $res['isAllow'] = false;
                } else if ($diff > 14 && $diff <= 28) {
                    $res['status'] = "เฝ้าระวัง";
                    $res['isAllow'] = false;
                } else {
                    $res['status'] = "ไม่มีความเสี่ยง";
                    $res['isAllow'] = true;
                }
            } else {
                $res['status'] = "ไม่มีความเสี่ยง";
                $res['isAllow'] = true;
                $res['places'] = $place_item;
            }
        }

        $fetchData['allows'] = $res;
		$result[] = $fetchData;
	}

	echo json_encode($result);

?>