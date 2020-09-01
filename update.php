<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  
   <link rel="stylesheet" type="text/css" href="form.css">  
    <title>Update the record</title>
  </head>
  <body class="container">
            <h1 class="page-header">Update product record</h1>

            <!-----php code to select  the desired record-->
            <?php

              //check if id value was sent to this page via the get method (?=) from a link

              $id=isset($_GET['id'])? $_GET['id']:die('Error:Record Id not found.');

            // connect to the database

              include 'config/database.php';

            // get the current records from the db based on the ID value
            try
            {
                 //select data form the db

            $query="SELECT * from scp where id =:id";

             //bind our ? to  id

              $read=$conn->prepare($query);
              $read->bindParam(":id",$id);
              $read->execute();

               //store record into an associative array
              $row=$read->fetch(PDO::FETCH_ASSOC);

              //retrieve individual field data from the array
              $item =$row['item'];
              $class =$row['class'];
              $image =$row['image'];
              $process =$row['process'];
              $description=$row['description'];
              $additional_note =$row['additional_note'];
              $reference =$row['reference'];
            }
            catch(PDOException $exception)
            {
                die('Error: '.$exception->getmessage());
            }

            if($_POST)
            {
             try
             {
              //update sql query
              $query="update scp set item=:item,class=:class,image=:image,process=:process,description=:description,additional_note=:additional_note,reference=:reference where id=:id";

              //prepare the query 
              $update=$conn->prepare($query);

              //save post values from the form
                 $id=htmlspecialchars(strip_tags($_POST['id']));
                  $item=htmlspecialchars(strip_tags($_POST['item']));
                   $class=htmlspecialchars(strip_tags($_POST['class']));
                   $image=htmlspecialchars(strip_tags($_POST['image']));
                   $process=htmlspecialchars(strip_tags($_POST['process']));
                  $description=htmlspecialchars(strip_tags($_POST['description']));
                  $additional_note=htmlspecialchars(strip_tags($_POST['additional_note']));
                  $reference=htmlspecialchars(strip_tags($_POST['reference']));

                    //bind our parameter to our query
                   $update->bindParam(':id',$id);
                  $update->bindParam(':item',$item);
                  $update->bindParam(':class',$class);
                   $update->bindParam(':image',$image);
                  $update->bindParam(':process',$process);
                  $update->bindParam(':description',$description);
                  $update->bindParam(':additional_note',$additional_note);
                    $update->bindParam(':reference',$reference);

                  //execute the update query
                  if($update->execute())
                  {
                    echo"<div class='alert alert-success'>Record {$id} was updated.</div>";
                  }
                  else
                  {
                      echo"<div class='alert alert-danger'>Unable to update recorder.Please try again.</div>";
                  }


             }
             catch(PDOException $exception)
             {
               die('Error: '. $exception->getmessage());
             }
            }
            else
            {
              echo "<div class='alert alert-danger'>Record is ready to be updated</div>";
            }
?>
 <p><a href="index.php" class="btn btn-info">Back to Index page</a></p>

   <h2>Use a form to enter a new SCP page record. </h2>
   
      <form class="form-group" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] .'?id='. $id);?>" method="POST" >
     
     
     <br>
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id, ENT_QUOTES); ?>" >
    <br><br>

     <p></p>Item
     <br>
    <input type="text" class="form-control" name="item" value="<?php echo htmlspecialchars($item, ENT_QUOTES); ?>" >
    <br><br>

      <p></p>Object class
     <br>
    <input type="text" class="form-control" name="class" value="<?php echo htmlspecialchars($class, ENT_QUOTES); ?>" >
    <br><br>

      <p></p>Image
     <br>
    <input type="text" class="form-control" name="image" value="<?php echo htmlspecialchars($image, ENT_QUOTES); ?>">
    <br><br>

     <p></p>Description
    <br>
    <input type="text" class="form-control" name="description"  value="<?php echo htmlspecialchars($description, ENT_QUOTES); ?>" >
    <br><br>

    <p></p>Special Containment Procedure
    <br>
    <input type="text" class="form-control" name="process"  value="<?php echo htmlspecialchars($process, ENT_QUOTES); ?>" >
    <br><br>

    <p></p>Additional Exercise
    <br>
    <input type="text" class="form-control" name="additional_note" value="<?php echo htmlspecialchars($additional_note, ENT_QUOTES); ?>">
    <br>

      <p></p>Reference
     <br>
    <input type="text" class="form-control" name="reference" value="<?php echo htmlspecialchars($reference, ENT_QUOTES); ?>">
    <br><br>
    
    <hr width="75%">
    <input type="submit" class="btn btn-primary" name="update" value="Save Changes">
</form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>