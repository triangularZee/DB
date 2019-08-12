<?php include ("header.php"); ?>
    </script>
    <style>
    	body {background-image:url("Image/book.PNG");}
        .navbar {
            z-index:999;
        }
        h1, p {
            padding: 30px 30px 0px 30px;
            text-align:center;
        }
        h1 {
            font-weight:800;
        }
        .container {
            position: relative;
            background: rgba(255, 255, 255, .9);
        }
        .ref {
            font-weight:200;
            font-size:0.5em;
        }
        #book-search {
        	font-size: 30px;
        }
        
    </style>
    <div class='container'>
        <br><br><br>
        <p>
        </p>
  
		<ul align = "center">
			  <br>
                <h2><a href='book_list.php'>도서 정보</a></h2>
                <h2><a href='author_list.php'>저자 정보</a></h2>
                <h2><a href='site_info.php'>사이트 소개</a></h2>
		</ul>
              
        
        <p>어떤 책이 요즘 끌리십니까? 도서방에서 알아보세요</br></p>
        <p class="ref">본 사이트에서 사용된 리소스는 학술적 용도로만 사용되었으며, 상업적 사용은 제한됩니다.</p>
    </div>
<?php include ("footer.php"); ?>