<?php
  header("content-type:text/html;charset=gb2312");
    header('Access-Control-Allow-Origin:*');
    $servername = "localhost";
    $username = "���ݿ��û���";
    $password = "���ݿ�����";
    $dbname = "���ݿ���";
    // ��������
    $con =mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($con,"utf8");

    // �������
    $sql = "select `user_name`, `user_url`, `user_donate`, `pay_way`, `donate_confirm`, `donate_out` from donate_info order by `donate_id` asc";
    $result = mysqli_query($con,$sql);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($con));
        exit();
    }

	//������ݿ��е�����
    $jarr = array();
    while ($row = $result->fetch_array(MYSQLI_ASSOC)){
        //��Ϊʹ�õ��ǹ������鷽ʽ��ȡÿһ�����ݣ�����ֻ��ʹ�ù�������ķ�����ȡ���ݣ�����ʹ�������ķ�ʽ��ȡ���ݡ�
      	//`user_name`, `user_url`, `user_donate`, `user_ip`, `donate_time`, `donate_confirm`
       	// $user_name = $row['user_name'];
      	//$user_url = $row['user_url'];
     	//$user_donate = $row['user_donate'];
      	//$donate_confirm = $row['donate_confirm'];
        array_push($jarr,$row);
        //echo "$user_name:$user_url<br />";
    }

    //echo '������json���ݣ�';
    echo $str=json_encode($jarr);//���������json����

    mysqli_close($con);
?>