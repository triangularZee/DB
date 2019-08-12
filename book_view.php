<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("book_id", $_GET)) {
    $book_id = $_GET["book_id"];
    $query = "select * from Book natural join Publisher natural join Field where book_id = $book_id";
    $res = mysqli_query($conn, $query);
    $book = mysqli_fetch_assoc($res);
    if (!$book) {
        msg("물품이 존재하지 않습니다. $book_id");
    }
}
?>

   <div class="container fullwidth">

        <h3>상품 정보 상세 보기</h3>

        <p>
            <label for="product_id">도서 코드</label>
            <input readonly type="text" id="book_id" name="book_id" value="<?= $book['book_id'] ?>"/>
        </p>

        <p>
            <label for="book_name">도서 명</label>
            <input readonly type="text" id="book_name" name="book_name" value="<?= $book['book_name'] ?>"/>
        </p>
        
         <p>
            <label for="ISBN">ISBN</label>
            <input readonly type="text" id="ISBN" name="ISBN" value="<?= $book['ISBN'] ?>"/>
        </p>
        
         <p>
            <label for="publisher_id">출판사 코드</label>
            <input readonly type="text" id="publisher_id" name="publisher_id" value="<?= $book['publisher_id'] ?>"/>
        </p>

        <p>
            <label for="publisher_name">출판사</label>
            <input readonly type="text" id="publisher_name" name="publisher_name" value="<?= $book['publisher_name'] ?>"/>
        </p>

        <p>
            <label for="price">가격</label>
            <input readonly type="text" id="price" name="price" value="<?= $book['price'] ?>"/>
        </p>

        <p>
            <label for="dateid">출간일</label>
            <br>
            <input readonly type="date" id="date" name="date" value="<?= $book['date'] ?>"/>
        </p>
        
        <p>
            <label for="author_name">저자</label>
            <input readonly type="text" id="author_name" name="author_name" value="<?= $book['author_name'] ?>"/>
        </p>

		<p>
            <label for="field_name">분야</label>
            <input readonly type="text" id="field_name" name="field_name" value="<?= $book['field_name'] ?>"/>
        </p>

		
        <!--<p>-->
        <!--    <label for="foreign">외서여부</label>-->
        <!--    <input readonly type="number" id="price" name="price" value="<?= $product['price'] ?>"/>-->
        <!--</p>-->
    </div>
<? include("footer.php") ?>
