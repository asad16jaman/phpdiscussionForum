<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <?php
        require 'partial/header.php';
        include "partial/connection.php";
        $getid = $_GET['catid'];
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $problameTitle = $_POST['title'];
            $problameDiscription = $_POST['discription'];
            $insertSql = "INSERT INTO threads(thread_title,thread_discription,thread_user_id,thread_cat_id) VALUES('$problameTitle','$problameDiscription','1','$getid')";
            $insertQuery = mysqli_query($cnct,$insertSql);
            
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
                    <h1 class="display-5">Wellcome to <?php echo $ob["catagori_name"] ?> forum</h1>
                    <p class="lead"><?php echo $ob["catagori_discription"] ?></p>
                    <hr>
                    <p class="lead">
                        Ask Your Question below form 
                    </p>
                </div>


                <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="img-thumbnail p-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Problame Title</label>
                        <input type="text" name="title" placeholder="Ask question or your problame" class="form-control" id="exampleInputTitle" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Problame Discription</label>
                        <textarea name="discription" placeholder="discribe your problame" id="" cols="10" rows="5" class="form-control"></textarea>
                        <small id="emailHelp" class="form-text text-muted"></small>
                    </div>
                    <div class="d-flex justify-content-end">
                     <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>



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

                echo '<div class="row mt-1 bg-light p-5">
                    <div class="media">
                        <img class="mr-3" src="./img/userimg.png" width="50px" alt="Generic placeholder image">
                        <div class="media-body">
                            <h5 class="mt-0"><a href="thread.php?threadid='.$threadid.'">'.$catitle.'</a></h5>
                            '.$catdis.'
                        </div>
                    </div>
                    </div>';
            }

            if(mysqli_num_rows($qResult)==0){
                echo "no result found";
            }
        ?>

















    </div>

























    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>