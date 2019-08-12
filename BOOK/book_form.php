<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "book_register.php";

if (array_key_exists("book_id", $_GET)) {
    $book_id = $_GET["book_id"];
    $query =  "select * from Book where book_id = $book_id";
    $res = mysqli_query($conn, $query);
    $Book = mysqli_fetch_array($res);
    if(!$Book) {
        msg("도서가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "book_revision.php";
}

$Publishers = array();

$query = "select * from Publisher";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
	echo $Publishers[$row['publisher_name']];
    $Publishers[$row['publisher_id']] = $row['publisher_name'];
}

?>
    <div class="container">
        <form name="book_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="book_id" value="<?=$Book['book_id']?>"/>
            <h3>도서 정보 <?=$mode?></h3>
            <p>
                <label for="publisher_id">출판사</label>
                <select name="publisher_id" id="publisher_id">
                    <option value="-1">선택해 주십시오.</option>
                    <option value="1">Pearson</option>
                    <option value="2">Mcgraw-hill</option>
                    <option value="3">Wiley</option>
                    <option value="4">Penguin</option>
                    <option value="5">Oxford</option>
                    <option value="6">Spiegel</option>
                    
                  
                </select>
            </p>
            <p>
            	<label for="field_id">분야</label>
            	<select name="field_id" id = "field_id">
            		<option value="-1">선택해 주십시오.</option>
                    <option value="1">인문과학</option>
                    <option value="2">사회과학</option>
                    <option value="3">자연과학</option>
                    <option value="4">응용과학</option>
                    <option value="5">예술</option>
                    <option value="6">기타</option>
            	</select>
            </p>
            <p>
                <label for="book_name">도서명</label>
                <input type="text" placeholder="도서명 입력" id="book_name" name="book_name" value="<?=$Book['book_name']?>"/>
            </p>
            <p>
                <label for="ISBN">ISBN</label>
                <input type="text" placeholder="ISBN 입력" id="ISBN" name="ISBN" value"<?=$Book['ISBN']?>"/>
            </p>
            <p>
                <label for="date">출간일</label>
                <input type="date" placeholder="출간일 입력" id="date" name="date" value"<?=$Book['date']?>"/>
            </p>
            <p>
                <label for="price">가격</label>
                <input type="number" placeholder="정수로 입력" id="price" name="price" value="<?=$Book['price']?>" />
            </p>
			<p>
                <label for="author_name">저자</label>
                <input type="text" placeholder="저자 입력" id="author_name" name="author_name" value"<?=$Book['author_name']?>"/>
            </p>
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("publisher_id").value == "-1") {
                        alert ("출판사를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("book_name").value == "") {
                        alert ("도서명을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("ISBN").value == "") {
                        alert ("ISBN을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("date").value == "") {
                        alert ("출간일을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("price").value == "") {
                        alert ("가격을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("author_name").value == "") {
                        alert ("저자를 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>
        </form>
    </div>
<? include("footer.php") ?>