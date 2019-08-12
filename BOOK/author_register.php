<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$country_id = $_POST['country_id'];
$author_name = $_POST['author_name'];
$work = $_POST['work'];
$author_desc = $_POST['author_desc'];

mysqli_query($conn, "set autocommit = 0"); // autocommit off
mysqli_query($conn, "set transaction isolation level serializable"); // isolation level set
mysqli_query($conn, "begin"); // begins a transaction

$query = "insert into Author(author_name, work, author_desc, country_id) values('$author_name', '$work', '$author_desc', '$country_id')";

$ret = mysqli_query($conn, $query);

if(!$ret)
{	
	mysqli_query($conn, "rollback");
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit"); 
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=author_list.php'>";
}

?>