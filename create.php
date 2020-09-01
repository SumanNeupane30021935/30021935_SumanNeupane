<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

           <link rel="stylesheet" type="text/css" href="form.css">  
    <title>form created </title>
  </head>
  <body class="container">
      <?php
        
        if($_POST)
        {
            //connect to the database

            include 'config/database.php';

            try
            {
                  //insert query

                  $query="insert into scp set item=:item,class=:class,image=:image,process=:process,description=:description,additional_note=:additional_note,reference=:reference";

                  //prepare query for execution
                  $statement=$conn->prepare($query);

                   $item=htmlspecialchars(strip_tags($_POST['item']));
                   $class=htmlspecialchars(strip_tags($_POST['class']));
                   $image=htmlspecialchars(strip_tags($_POST['image']));
                   $process=htmlspecialchars(strip_tags($_POST['process']));
                  $description=htmlspecialchars(strip_tags($_POST['description']));
                  $additional_note=htmlspecialchars(strip_tags($_POST['additional_note']));
                  $reference=htmlspecialchars(strip_tags($_POST['reference']));


                  //bind our parameter to our query
                   //bind our parameter to our query
                 $statement->bindParam(':item',$item);
                  $statement->bindParam(':class',$class);
                  $statement->bindParam(':image',$image);
                  $statement->bindParam(':process',$process);
                 $statement->bindParam(':description',$description);
                  $statement->bindParam(':additional_note',$additional_note);
                    $statement->bindParam(':reference',$reference);



                  //execute the query
                  if($statement->execute())
                  {
                    echo"<div class='alert alert-success'>Record was created</div>";
                  }
                  else
                  {
                    echo"<div class='alert alert-danger'>Unable to save record.</div>";
                  }

            }
            catch(PDOException $exception)
            {
                 die('ERROR: ' . $exception->getMessage());
            }
        }

    ?>
       
    <h1>Web application</h1>
    <h2>Use a form to enter a new SCP page record </h2><hr>
    <p><a href="index.php" class="btn btn-warning">Back to index page</a></p>
    <form class="form-group " method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    <p></p>Item
    <br>
    <input type="text" class="form-control" name="item" >
    <br><br>
    <p></p>Object class
    <br>
    <input type="text" class="form-control" name="class">
    <br><br>
    <p></p>Image
    <br>
    <input type="text" class="form-control" name="image">
    <br>
    <p></p>Special Containment Procedure
   <br>
   <input type="text" class="form-control" name="process">
   <br><br>
   <p></p>Description
   <br>
    <input type="text" class="form-control" name="description">
    <br>
   <p></p>Reference
    <br>
    <input type="text" class="form-control" name="reference" >
    <br>
    <p></p>Additional exercise
    <br>
    <input type="text" class="form-control" name="additional_note" >
      <hr width="75%">
    <input type="submit" class="btn btn-primary" name="submit" value="Submit SCP page data">
</form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>