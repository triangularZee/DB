<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from Book natural join Publisher";
    if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_POST["search_keyword"];
        $query =  $query . " where book_name like '%$search_keyword%' or publisher_name like '%$search_keyword%' or author_name like '%$search_keyword%'"; 
    
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
			<th>도서 명</th>
			<th>ISBN</th>
			<th>출판사</th>
			<th>가격</th>
			<th>출간일</th>
			<th>저자</th>
			<th>기능</th>
			</tr>
		</thead>
		 <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td><a href='book_view.php?book_id={$row['book_id']}'>{$row['book_name']}</a></td>";
            echo "<td>{$row['ISBN']}</td>";
            echo "<td>{$row['publisher_name']}</td>";
            echo "<td>{$row['price']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['author_name']}</td>";
            echo "<td width='17%'>
                <a href='book_form.php?book_id={$row['book_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['book_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
	</table>
	 <script>
        function deleteConfirm(book_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "book_delete.php?book_id=" + book_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>	

	