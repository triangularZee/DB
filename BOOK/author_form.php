<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "author_register.php";

if (array_key_exists("author_id", $_GET)) {
    $author_id = $_GET["author_id"];
    $query =  "select * from Author where author_id = $author_id";
    $res = mysqli_query($conn, $query);
    $Author = mysqli_fetch_array($res);
    if(!$Author) {
        msg("저자가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "author_revision.php";
}

$Country = array();

$query = "select * from country";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
	echo $Country[$row['country_name']];
    $Country[$row['country_id']] = $row['country_name'];
}

?>
    <div class="container">
        <form name="author_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="author_id" value="<?=$Author['author_id']?>"/>
            <h3>저자 정보 <?=$mode?></h3>
            <p>
            	<label for="country_id">국적</label>
            	<select name="country_id" id = "country_id">
            		<option value="-1">선택해 주십시오.</option>
                    <option value="1">한국</option>
                    <option value="2">일본</option>
                    <option value="3">유럽</option>
                    <option value="4">미국</option>
                    <option value="5">러시아</option>
                    <option value="6">기타</option>
            	</select>
            </p>
            
            <p>
                <label for="author_name">저자명</label>
                <input type="text" placeholder="저자명 입력" id="author_name" name="author_name" value="<?=$Author['author_name']?>"/>
            </p>
            <p>
                <label for="work">대표작</label>
                <input type="text" placeholder="대표작 입력" id="work" name="work" value"<?=$Author['work']?>"/>
            </p>
			<p>
                <label for="author_desc">저자 소개</label>
                <textarea placeholder="저자 소개 입력" id="author_desc" name="author_desc" rows="10"><?=$Author['author_desc']?></textarea>
            
            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("author_name").value == "-1") {
                        alert ("저자 이름을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("country_id").value == "") {
                        alert ("국적을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("work").value == "") {
                        alert ("대표작을 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("author_desc").value == "") {
                        alert ("저자 소개를 입력해 주십시오"); return false;
                    }
                    
                    return true;
                }
            </script>
        </form>
    </div>
<? include("footer.php") ?>