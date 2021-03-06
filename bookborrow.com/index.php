<?php
$connection = mysqli_connect("127.0.0.1","root","");
$checkDb = mysqli_select_db($connection,"00167690_sureshrawal");
if(!$checkDb){
    header('location:setup.php');
}

session_start();
include "class/book.php";
$book = new book();
if(isset($_SESSION['id'])){
    $id=$_SESSION["id"];
    if($id=="admin"){
        header('location: admin.php');
    }else{
        header('location:dashboard.php');
    }
}
?>

<html>
<head>
    <title>BookBorrow.com | Welcome</title>
    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="assets/images/bookborrow.png" type="image/x-icon"/>
</head>
<body>
<div class="container">

<!--    header-->
    <header>
        <a href="index.php"><img src="assets/images/logo.png"></a>
        <div class="navigation-search pull-right">
            <div class="navigation">
                <ul class="pull-right">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                </ul>
            </div>
        </div>
    </header>
<!--    header end-->

<!--    content-->

<!--    carousel-->
    <div class="content carousel-padding">
            <div class="col-lg-8">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">


                        <?php
                        if(!$book->selectGiveaway()){
                            echo '<div class="alert alert-danger" role="alert">';
                            echo '0 book';
                            echo '</div>';
                        }else{
                            $books = $book->selectGiveaway();
                            foreach ($books as $booksRow){
                                if($booksRow["carousel_index"]==1){
                                    echo '<div class="item active">';
                                    echo '<div class="giveaway">';
                                    echo '<h2>Book Giveaway</h2>';
                                    echo '<div class="new-book-image">';
                                    echo '<img src="assets/images/'.$booksRow["book_image"].'">';
                                    echo '</div>';
                                    echo '<div class="carousel-book-description">';
                                    echo '<h4>'.$booksRow["book_name"].'</h4>';
                                    echo '<strong>Author : </strong>'.$booksRow["author"].'<br/>';
                                    echo '<strong>ISBN : </strong>'.$booksRow["ISBN"].'<br/>';
                                    echo '<strong>Publication Date : </strong>'.$booksRow["publication_date"].'<br/>';
                                    echo '<strong>Publisher : </strong>'.$booksRow["publisher"].'<br/>';
                                    echo '<strong>Genre : </strong>'.$booksRow["book_genre"].'<br/>';
                                    echo '<a href="login.php" class="btn theme-success-button">Claim</a><br/>';
                                    echo '<h6><strong>Note : </strong>Those learner whose good points has crossed '.$booksRow["points"].' points can claim this book</h6>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                if($booksRow["carousel_index"]==2){
                                    echo '<div class="item">';
                                    echo '<div class="giveaway">';
                                    echo '<h2>Book Giveaway</h2>';
                                    echo '<div class="new-book-image">';
                                    echo '<img src="assets/images/'.$booksRow["book_image"].'">';
                                    echo '</div>';
                                    echo '<div class="carousel-book-description">';
                                    echo '<h4>'.$booksRow["book_name"].'</h4>';
                                    echo '<strong>Author : </strong>'.$booksRow["author"].'<br/>';
                                    echo '<strong>ISBN : </strong>'.$booksRow["ISBN"].'<br/>';
                                    echo '<strong>Publication Date : </strong>'.$booksRow["publication_date"].'<br/>';
                                    echo '<strong>Publisher : </strong>'.$booksRow["publisher"].'<br/>';
                                    echo '<strong>Genre : </strong>'.$booksRow["book_genre"].'<br/>';
                                    echo '<a href="login.php" class="btn theme-success-button">Claim</a><br/>';
                                    echo '<h6><strong>Note : </strong>Those learner whose good points has crossed '.$booksRow["points"].' points can claim this book</h6>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            }
                        }
                        ?>



                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div>
            </div>
<!--        carousel end-->

<!--        search-->
        <div class="col-lg-4">
            <div class="search-book">
                <div class="search-book-form">
                    <form method="get">
                        <div class="form-inline">
                            <input type="text" placeholder="Search" class="form-control inputLength" name="search" required="required">
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                    </form>
                </div>
                <div class="search-book-category">
                    <div class="panel panel-default panelMargin">
                        <div class="panel-heading">Browse Book</div>
                        <div class="panel-body panelBody">
                            <div class="list-group">
                                <a href="index.php" class="list-group-item">All</a>
                                <a href="index.php?genre=science_fiction" class="list-group-item">Science Fiction</a>
                                <a href="index.php?genre=romance" class="list-group-item">Romance</a>
                                <a href="index.php?genre=action_drama" class="list-group-item">Action Drama</a>
                                <a href="index.php?genre=adventure" class="list-group-item">Adventure</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--search end-->

<!--    content end-->

<!--    another content-->
    <div class="content content-padding">

        <?php
        if(isset($_GET['genre'])){
            if($_GET['genre']=='science_fiction'){
                if(!$book->selectBookLearnerByGenre('Science Fiction')){
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '0 book from this genre';
                    echo '</div>';
                }else{
                    $books = $book->selectBookLearnerByGenre('Science Fiction');
                    foreach ($books as $booksRow){
                        echo '<div class="col-lg-4" style="padding: 10px;">';
                        echo '<img src="assets/images/'.$booksRow["book_image"].'" style="max-height: 200px;max-width: 200px;float: left;">';
                        echo '<div style="float:left;width: 200px;padding: 10px;">';
                        echo '<div style="margin-bottom: 10px;text-align: center;">';
                        echo '<strong><a href="login.php" style="color: black;">'.$booksRow["book_name"].'</a></strong><br/>';
                        echo '</div>';
                        echo '<div style="margin-bottom: 10px;">';
                        echo '<strong>Author : </strong>'.$booksRow["author"].'<br/>';
                        echo '<strong>ISBN : </strong>'.$booksRow["ISBN"].'<br/>';
                        echo '<strong>Genre : </strong>'.$booksRow["book_genre"].'<br/>';
                        echo '<span class="glyphicon glyphicon-user"></span> : '.$booksRow["name"].'<br/>';
                        echo '</div>';
                        echo '<a href="login.php" class="btn theme-success-button" style="margin-left: 50px;">View</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }elseif($_GET['genre']=='romance'){
                if(!$book->selectBookLearnerByGenre('Romance')){
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '0 book from this genre';
                    echo '</div>';
                }else{
                    $books = $book->selectBookLearnerByGenre('Romance');
                    foreach ($books as $booksRow){
                        echo '<div class="col-lg-4" style="padding: 10px;">';
                        echo '<img src="assets/images/'.$booksRow["book_image"].'" style="max-height: 200px;max-width: 200px;float: left;">';
                        echo '<div style="float:left;width: 200px;padding: 10px;">';
                        echo '<div style="margin-bottom: 10px;text-align: center;">';
                        echo '<strong><a href="login.php" style="color: black;">'.$booksRow["book_name"].'</a></strong><br/>';
                        echo '</div>';
                        echo '<div style="margin-bottom: 10px;">';
                        echo '<strong>Author : </strong>'.$booksRow["author"].'<br/>';
                        echo '<strong>ISBN : </strong>'.$booksRow["ISBN"].'<br/>';
                        echo '<strong>Genre : </strong>'.$booksRow["book_genre"].'<br/>';
                        echo '<span class="glyphicon glyphicon-user"></span> : '.$booksRow["name"].'<br/>';
                        echo '</div>';
                        echo '<a href="login.php" class="btn theme-success-button" style="margin-left: 50px;">View</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }

            }elseif($_GET['genre']=='action_drama'){
                if(!$book->selectBookLearnerByGenre('Action Drama')){
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '0 book from this genre';
                    echo '</div>';
                }else{
                    $books = $book->selectBookLearnerByGenre('Action Drama');
                    foreach ($books as $booksRow){
                        echo '<div class="col-lg-4" style="padding: 10px;">';
                        echo '<img src="assets/images/'.$booksRow["book_image"].'" style="max-height: 200px;max-width: 200px;float: left;">';
                        echo '<div style="float:left;width: 200px;padding: 10px;">';
                        echo '<div style="margin-bottom: 10px;text-align: center;">';
                        echo '<strong><a href="login.php" style="color: black;">'.$booksRow["book_name"].'</a></strong><br/>';
                        echo '</div>';
                        echo '<div style="margin-bottom: 10px;">';
                        echo '<strong>Author : </strong>'.$booksRow["author"].'<br/>';
                        echo '<strong>ISBN : </strong>'.$booksRow["ISBN"].'<br/>';
                        echo '<strong>Genre : </strong>'.$booksRow["book_genre"].'<br/>';
                        echo '<span class="glyphicon glyphicon-user"></span> : '.$booksRow["name"].'<br/>';
                        echo '</div>';
                        echo '<a href="login.php" class="btn theme-success-button" style="margin-left: 50px;">View</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }

            }elseif($_GET['genre']=='adventure'){
                if(!$book->selectBookLearnerByGenre('Adventure')){
                    echo '<div class="alert alert-danger" role="alert">';
                    echo '0 book from this genre';
                    echo '</div>';
                }else{
                    $books = $book->selectBookLearnerByGenre('Adventure');
                    foreach ($books as $booksRow){
                        echo '<div class="col-lg-4" style="padding: 10px;">';
                        echo '<img src="assets/images/'.$booksRow["book_image"].'" style="max-height: 200px;max-width: 200px;float: left;">';
                        echo '<div style="float:left;width: 200px;padding: 10px;">';
                        echo '<div style="margin-bottom: 10px;text-align: center;">';
                        echo '<strong><a href="login.php" style="color: black;">'.$booksRow["book_name"].'</a></strong><br/>';
                        echo '</div>';
                        echo '<div style="margin-bottom: 10px;">';
                        echo '<strong>Author : </strong>'.$booksRow["author"].'<br/>';
                        echo '<strong>ISBN : </strong>'.$booksRow["ISBN"].'<br/>';
                        echo '<strong>Genre : </strong>'.$booksRow["book_genre"].'<br/>';
                        echo '<span class="glyphicon glyphicon-user"></span> : '.$booksRow["name"].'<br/>';
                        echo '</div>';
                        echo '<a href="login.php" class="btn theme-success-button" style="margin-left: 50px;">View</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
        }elseif(isset($_GET['search'])){
            $search = $_GET['search'];
            if(!$book->searchBook($search)){
                echo '<div class="alert alert-danger" role="alert">';
                echo '0 book found';
                echo '</div>';
            }else{
                $books = $book->searchBook($search);
                foreach ($books as $booksRow){
                    echo '<div class="col-lg-4" style="padding: 10px;">';
                    echo '<img src="assets/images/'.$booksRow["book_image"].'" style="max-height: 200px;max-width: 200px;float: left;">';
                    echo '<div style="float:left;width: 200px;padding: 10px;">';
                    echo '<div style="margin-bottom: 10px;text-align: center;">';
                    echo '<strong><a href="login.php" style="color: black;">'.$booksRow["book_name"].'</a></strong><br/>';
                    echo '</div>';
                    echo '<div style="margin-bottom: 10px;">';
                    echo '<strong>Author : </strong>'.$booksRow["author"].'<br/>';
                    echo '<strong>ISBN : </strong>'.$booksRow["ISBN"].'<br/>';
                    echo '<strong>Genre : </strong>'.$booksRow["book_genre"].'<br/>';
                    $fetchLearnerName = array(array(
                            "name"=>""
                    ));
                    $fetchLearnerName = $book->selectBookLearnerName($booksRow["learner_id"]);
                    echo '<span class="glyphicon glyphicon-user"></span> : '.$fetchLearnerName[0]["name"].'<br/>';
                    echo '</div>';
                    echo '<a href="login.php" class="btn theme-success-button" style="margin-left: 50px;">View</a>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }else{
            if(!$book->selectBookLearner()){
                echo '<div class="alert alert-danger" role="alert">';
                echo '0 book';
                echo '</div>';
            }else{
                $books = $book->selectBookLearner();
                foreach ($books as $booksRow){
                    echo '<div class="col-lg-4" style="padding: 10px;">';
                    echo '<img src="assets/images/'.$booksRow["book_image"].'" style="max-height: 200px;max-width: 200px;float: left;">';
                    echo '<div style="float:left;width: 200px;padding: 10px;">';
                    echo '<div style="margin-bottom: 10px;text-align: center;">';
                    echo '<strong><a href="login.php" style="color: black;">'.$booksRow["book_name"].'</a></strong><br/>';
                    echo '</div>';
                    echo '<div style="margin-bottom: 10px;">';
                    echo '<strong>Author : </strong>'.$booksRow["author"].'<br/>';
                    echo '<strong>ISBN : </strong>'.$booksRow["ISBN"].'<br/>';
                    echo '<strong>Genre : </strong>'.$booksRow["book_genre"].'<br/>';
                    echo '<span class="glyphicon glyphicon-user"></span> : '.$booksRow["name"].'<br/>';
                    echo '</div>';
                    echo '<a href="login.php" class="btn theme-success-button" style="margin-left: 50px;">View</a>';
                    echo '</div>';
                    echo '</div>';
                }
            }
        }
        ?>
    </div>
<!--    content end-->

    <footer>
        © 2018 BookBorrow.com
    </footer>

</div>
</body>
</html>