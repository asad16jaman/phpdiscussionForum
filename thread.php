<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
    <style>
    .jumbotron {
        background: #80808045;
        padding: 67px 26px;
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .media {
        display: flex;
    }

    .media-body {
        flex-grow: 1;
        flex-shrink: 10;
        padding-left: 10px;
    }
    </style>
</head>

<body>
    <?php
    
    require 'partial/header.php';
    include "partial/connection.php";
    $getid = $_GET['threadid'];

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $problameDiscription = $_POST['discription'];
        if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==true){
            $createcommentId = $_SESSION['userId'];
            $insertSql = "INSERT INTO comments(comment_content,comment_thread,comment_user) VALUES('$problameDiscription','$getid','$createcommentId')";
            $insertQuery = mysqli_query($cnct,$insertSql);
        }else{
            $isFial = 'ha';
           $Messages = "first login then ...!";
        }
    }

    $sql = "SELECT *FROM threads where thread_id='$getid'";
    $result = mysqli_query($cnct,$sql);
    $ob = mysqli_fetch_assoc($result);
    $sqlforcomment = "SELECT * FROM comments where comment_thread='$getid'";
    $commentResult = mysqli_query($cnct,$sqlforcomment);


?>

    <div class="container">
        <div class="row mt-1 mb-3">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h1 class="display-5"><?php echo $ob["thread_title"] ?></h1>
                    <p class="lead"><?php echo $ob["thread_discription"] ?></p>
                    <hr>
                    <p class="lead">
                        created by : Asad
                    </p>
                </div>
                <?php  
                if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==true){
                    include "partial/sol.php";
                }else{
                    echo '<div class="img-thumbnail p-4">
                            <h1>Contribute form</h1>
                            <p>please login first to contribute or give sollution</p>
                        </div>';
                }
            ?>
            </div>
            <div class="col-md-4">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action active">
                        <h1>Forums Rules</h1>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                        Be civil. Don't post anything that a reasonable person would consider offensive, abusive, or
                        hate speech.
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">Keep it clean. Don't post anything
                        obscene or sexually explicit.</a>
                    <a href="#" class="list-group-item list-group-item-action">Respect each other. Don't harass or grief
                        anyone, impersonate people, or expose their private information.</a>
                    <a href="#" class="list-group-item list-group-item-action">Respect our forum.</a>

                </div>
            </div>

        </div>

        <?php
        if(mysqli_num_rows($commentResult)==0){
            echo "there is no comment be the first person of comment";
        }
    
        while($row=mysqli_fetch_assoc($commentResult)){

            $commentContent = $row['comment_content'];
            $commentTime = $row['comment_time'];
            $commentUser = $row['comment_user'];
            $getthreadusersql = mysqli_query($cnct,"SELECT * FROM userprofile where user_id = '$commentUser'");
            $userRow = mysqli_fetch_assoc($getthreadusersql) ;

            echo '<div class="row mt-1 bg-light px-5 py-3">
            <div class="media">
                <img class="mr-3" src="./img/userimg.png" width="50px" alt="Generic placeholder image">
                <div class="media-body">
                <p>'.$userRow['user_email'].'  <span class="mx-5">time: '.$commentTime.'</span></p>
                    '.$commentContent.'
                </div>
            </div>
            </div>';
        }
    ?>
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>