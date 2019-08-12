<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$book_id = $_POST['book_id'];
$book_name = $_POST['book_name'];
$ISBN = $_POST['ISBN'];
$publisher_id = $_POST['publisher_id'];
$price = $_POST['price'];
$date = $_POST['date'];
$author_name = $_POST['author_name'];

mysqli_query($conn, "set autocommit = 0"); // autocommit off
mysqli_query($conn, "set transaction isolation level serializable"); // isolation level set
mysqli_query($conn, "begin"); // begins a transaction

$ret = mysqli_query($conn, "update Book set book_name = '$book_name', ISBN = '$ISBN', publisher_id = '$publisher_id', price = '$price', date = '$date', author_name = '$author_name' where book_id = '$book_id
'");

if(!$ret)
{	
	mysqli_query($conn, "rollback");
	echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{	
	mysqli_query($conn, "commit");
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=book_list.php'>";
}

?>