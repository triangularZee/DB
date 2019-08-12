<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$author_id = $_GET['author_id'];

mysqli_query($conn, "set autocommit = 0"); // autocommit off
mysqli_query($conn, "set transaction isolation level serializable"); // isolation level set
mysqli_query($conn, "begin"); // begins a transaction

$ret = mysqli_query($conn, "delete from Author where author_id = $author_id");

if(!$ret)
{
	mysqli_query($conn, "rollback");
    msg('Query Error : '.mysqli_error($conn));
}
else
{
	mysqli_query($conn, "commit");
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=author_list.php'>";
}

?>

