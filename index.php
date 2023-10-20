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
</head>

<body>
    <?php include "./partial/header.php";
        include "./partial/carousel.php";
        include "./partial/connection.php";
    
    ?>
    <div class="container">
        <h2 class="text-center my-3">iDiscuss - Catagories</h2>

        <div class="row">

        <?php
            $sql = "SELECT * FROM catagories";
            $result = mysqli_query($cnct,$sql);
            while($row = mysqli_fetch_assoc($result)){
                echo '<div class="col-md-4 my-2">
                <div class="card mx-5">
                    <img src="https://picsum.photos/id/2/500/500" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">'.$row["catagori_name"].'</h5>
                        <p class="card-text">'.substr($row["catagori_discription"],0,90).'...</p>
                        <a href="thredlist.php?catid='.$row['catagori_id'].'" class="btn btn-primary">view threed</a>
                    </div>
                </div>
            </div>';

            }
        
        ?>


        </div>

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