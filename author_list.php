<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from Author natural join country";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where author_name like '%$search_keyword%' ";
    
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
    	echo mysqli_error();
        die('Query Error : ' . mysqli_error());
    }
    ?>
    
	<table class= "table table-hover table-bordered">
		<thead>
			<tr>
			<th>No.</th>
			<th>국적</th>
			<th>저자 명</th>
			<th>대표작</th>
			<th>기능</th>
			</tr>
		</thead>
		 <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['country_name']}</td>";
            echo "<td><a href='author_view.php?author_id={$row['author_id']}'>{$row['author_name']}</a></td>";
            echo "<td>{$row['work']}</td>";
            echo "<td width='17%'>
                <a href='author_form.php?author_id={$row['author_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['author_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
	</table>
	 <script>
        function deleteConfirm(author_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "author_delete.php?author_id=" + author_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>	

	