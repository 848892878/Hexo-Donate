<?php
    header("content-type:text/html;charset=gb2312"); 
        //��ȡ�����ʾ������
        $user_name = $_POST['user_name'];
        $user_url = $_POST['user_url'];
        $user_donate = $_POST['user_donate'];
	$pay_way = $_POST['pay_way'];

        //���ݿ���Ҫ������
        //��ȡip https://blog.csdn.net/benben0729/article/details/87859314
        $ip = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
        $user_ip = ($ip) ? $ip : $_SERVER["REMOTE_ADDR"];

        date_default_timezone_set("Asia/Shanghai"); //��ȡ��дʱ��
        $donate_time=date('Y-m-d H:i:s');

        $donate_confirm='NO'; //ȷ����ϢĬ��Ϊ'NO'

        //�������ݿ�
        $conn = new mysqli(localhost,'���ݿ��û���','���ݿ�����','���ݿ���');
        mysqli_set_charset($conn,"utf8");
        if ($conn->connect_error){ //����ʧ��javascript:;
            //echo '���ݿ�����ʧ�ܣ�����ϵ������';
          	echo '<script>window.parent.errorRes("���ݿ�����ʧ�ܣ�����ϵ������");</script>';
            exit(0);
        }else { //���ӳɹ�
            //��ѯ��ip���ʹ������������ˢȡ����
            $sql = "select count(*) from donate_info where user_ip = '$user_ip'";
            $result = $conn->query($sql);
          	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            	//��Ϊʹ�õ��ǹ������鷽ʽ��ȡÿһ�����ݣ�����ֻ��ʹ�ù�������ķ�����ȡ���ݣ�����ʹ�������ķ�ʽ��ȡ���ݡ�
            	$ip_num=$row['count(*)'];
          	}
            if ($ip_num>=5) {
                //echo '<script>alert("�ϴ�ʧ�ܣ��ܴ��ʹ������ޣ�");history.go(-1);</script>';
              	echo '<script>window.parent.errorRes("�ϴ�ʧ�ܣ��ܴ��ʹ������ޣ�");</script>';
            } else {
                $sql_insert = "insert into ���ݿ���.`donate_info` (`user_name`, `user_url`, `user_donate`,`pay_way`, `user_ip`, `donate_time`, `donate_confirm`) VALUES ('$user_name', '$user_url', '$user_donate', '$pay_way', '$ip', '$donate_time', '$donate_confirm')";
             	$res_insert = $conn->query($sql_insert);
                if ($res_insert) {
                 	//echo "<script>alert($user_name);</script>";
                  	echo '<script>window.parent.successRes("�������ݿ�ɹ���");</script>';
                } else {
                    echo '<script>window.parent.warnRes("�������ݸ�ʽ�Ƿ���ȷ��");</script>';
                }
            }
        }
        mysqli_close($conn);
?>