<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("author_id", $_GET)) {
    $author_id = $_GET["author_id"];
    $query = "select * from Author natural join country where author_id = $author_id";
    $res = mysqli_query($conn, $query);
    $author = mysqli_fetch_assoc($res);
    if (!$author) {
        msg("저자가 존재하지 않습니다. $author_id");
    }
}
?>

   <div class="container fullwidth">

        <h3>상품 정보 상세 보기</h3>

        <p>
            <label for="author_id">저자 코드</label>
            <input readonly type="text" id="author_id" name="author_id" value="<?= $author['author_id'] ?>"/>
        </p>
		
		<p>
            <label for="country_name">국적</label>
            <input readonly type="text" id="country_name" name="country_name" value="<?= $author['country_name'] ?>"/>
        </p>
        
        <p>
            <label for="author_name">저자 명</label>
            <input readonly type="text" id="author_name" name="author_name" value="<?= $author['author_name'] ?>"/>
        </p>
        
         <p>
            <label for="work">대표작</label>
            <input readonly type="text" id="work" name="work" value="<?= $author['work'] ?>"/>
        </p>
        
        <p>
            <label for="author_desc">저자소개</label>
            <textarea readonly id="author_desc" name="author_desc" rows="10"><?= $author['author_desc'] ?></textarea>
		</p>

        <!--<p>-->
        <!--    <label for="foreign">외서여부</label>-->
        <!--    <input readonly type="number" id="price" name="price" value="<?= $product['price'] ?>"/>-->
        <!--</p>-->
    </div>
<? include("footer.php") ?>
