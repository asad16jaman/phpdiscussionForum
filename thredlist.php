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
        .jumbotron{
            background: #80808045;
            padding: 67px 26px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .media{
            display:flex;
        }
        .media-body{
            flex-grow: 1;
            flex-shrink: 10;
            padding-left:10px;
        }
    </style>
</head>

<body>
    
<?php
        require 'partial/header.php';
        include "partial/connection.php";

        $getid = $_GET['catid'];
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            
            $problameTitle = $_POST['title'];
            $problameDiscription = $_POST['discription'];
            if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==true){
                $createthreedId = $_SESSION['userId'];
                $insertSql = "INSERT INTO threads(thread_title,thread_discription,thread_user_id,thread_cat_id) VALUES('$problameTitle','$problameDiscription','$createthreedId','$getid')";
                $insertQuery = mysqli_query($cnct,$insertSql);
            }else{
                $isFial = 'ha';
               $Messages = "first login then ...!";
            }
            
            
        }
        
        $sql = "SELECT *FROM catagories where catagori_id='$getid'";
        $result = mysqli_query($cnct,$sql);
        $ob = mysqli_fetch_assoc($result);


        $sql2 = "SELECT * FROM threads where thread_cat_id='$getid'";
        $qResult = mysqli_query($cnct,$sql2); 
    ?>

    <div class="container">
        <div class="row mt-1 mb-3">
            <div class="col-md-8">
                <div class="jumbotron">
                    <h1 class="">Wellcome to <?php echo $ob["catagori_name"] ?> forum</h1>
                    <p class="lead"><?php echo $ob["catagori_discription"] ?></p>
                    <hr>
                    <p class="lead">
                        Ask Your Question below form 
                    </p>
                </div>

                <?php
                    if(isset($_SESSION['isLogin']) && $_SESSION['isLogin']==true){
                       include "partial/askquestion.php";
                    }else{
                        echo '<div class="img-thumbnail p-4">
                            <h1>Problame ask form</h1>
                            <p>please login first to ask question</p>
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
            while($row=mysqli_fetch_assoc($qResult)){
                $threadid = $row['thread_id'];
                $catitle = $row['thread_title'];
                $catdis = $row['thread_discription'];
                $threadsettime = $row['settime'];
                $threadq = $row['thread_user_id'];
                $getthreadusersql = mysqli_query($cnct,"SELECT * FROM userprofile where user_id = '$threadq'");
                $userRow = mysqli_fetch_assoc($getthreadusersql) ;
                echo '<div class="row mt-1 bg-light p-5">
                    <div class="media">
                        <div><img class="mr-3" src="./img/userimg.png" width="50px" alt="Generic placeholder image"> </div>
                        <div class="media-body">
                            <p>'.$userRow['user_email'].'  <span class="mx-5">time: '.$threadsettime.'</span></p>
                            <a href="thread.php?threadid='.$threadid.'">'.$catitle.'</a>
                            <p>'.$catdis.'</p>
                        </div>
                    </div>
                    </div>';
            }

            if(mysqli_num_rows($qResult)==0){
                echo "no result found";
            }
        ?>

    </div>
   


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>