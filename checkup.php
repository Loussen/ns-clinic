<?php
include "admin_gt7751/pages/__includes/config.php";

$response = json_encode(array("code"=>0, "content" => "Error system", "err_param" => ''));

if($_POST)
{
    $_POST = array_map("strip_tags", $_POST);
    extract($_POST);

    if($appointment_type == 0)
        $response = json_encode(array("code"=>0));
    else
    {
        $appointment_type = intval($appointment_type);

        if($appointment_type == 1) {
            $data=mysqli_query($db,"select id,name_".$lang_name." as name from doctors where active=1");
        } elseif($appointment_type == 2) {
            $data=mysqli_query($db,"select id,name_".$lang_name." as name from services where active=1");
        } else {
            $response = json_encode(array("code"=>0));
        }

        if($data) {
            $result = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($data)) {
                $result[$i]['id'] = $row['id'];
                $result[$i]['name'] = $row['name'];

                $i++;
            }

            $response = json_encode(array("code"=>1, "content" => $result));
        } else {
            $response = json_encode(array("code"=>0));
        }
    }
}

echo $response;
?>
