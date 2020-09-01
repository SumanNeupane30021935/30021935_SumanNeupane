                <?php
                //connection to the database
                include 'config/database.php';
                ?>


<!DOCTYPE HTML>
<html>
  <head>
    <title>index page for scp file</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
  
  </head>
  <body class="is-preload">
    <!-- Page Wrapper -->
      <div id="page-wrapper">

        <!-- Header -->
        <header id="header" class="alt">
            <h1><a href="index.php">SCP-File</a></h1>
        <nav>
              <a href="#menu">Menu</a>
        </nav>
        </header>

            <!-- Menu -->
              <nav id="menu">
                <div class="inner">
                  <h2>Menu</h2>
                  <ul class="links">
                    <li><a href="index.php">Home</a></li>
                  
                

                <?php 
                        //selecting id and item from database table:scp
                try
                {

                    $query_menu = "SELECT id, item from scp";//sql query for getting all scp pages
                    $statement_menu= $conn->prepare($query_menu);
                     $statement_menu->execute();


                         //using while loop to print the database id-item in menu 
                    while($record_menu=$statement_menu->fetch(PDO::FETCH_ASSOC))
                    {
                      
                    extract($record_menu);

                    echo "<li class='nav-item active'><a href='index.php?page={$id}' class='nav-link'>{$item}</a>
                        </li>";
                      
                     }
                     echo "<li><a href='create.php'class='btn btn-primary text-light p-5'>Enter a new SCP file </a></li>";
                     
                    
                }
                catch(PDOException $exception)
                {
                     die('ERROR: ' . $exception->getMessage());
                }

                  ?>
               <a href="#" class="close">Close</a>
             </ul>
        </div>
      </nav>

        <?php 
                    //checking whether id record were connecting or not if yes then goes to try to extract record
                    //if no then die 
                    if (isset($_GET['page'])){
                    $id=isset($_GET['page'])? $_GET['page']:die('Error:Record Id not found.'); 
            try
            {
              $query = "SELECT * from scp WHERE id=:id";  //sql query for getting all scp pages
              $statement= $conn->prepare($query);
              $statement->bindParam(':id',$id);
              $statement->execute();
              $record=$statement->fetch(PDO::FETCH_ASSOC);
                extract($record);   
                ?>
                <!-- Banner -->
                <section id="banner">
                  <div class="inner">
                    <div class="logo"><img src="images/splogo.png"></div>
                    <h2 style="text-align:center""font-family:Sans-serif"><?php echo $record["item"]; ?></h2>
                </div>
                </section>

    <!-- Wrapper -->
      <section id="wrapper">
              <header>
                 <div class="inner">
                <p><?php echo "Object class: {$class}";?></p>
                <div class="image">
                      <?php
                        if ($image != null) 
                        {
                          echo "<img src='images/{$image}' />";
                        }
                       
                      ?>
                      </div>   
                
                  <p>
                      <?php echo "Special Containment Procedure:<hr> {$process}";?></p>
                                
                  </div>
                  </header>

  <!-- Content -->
    <div class="wrapper">
                   <div class="inner">
                    <h1 class="major">Description</h1>
                    <p><?php echo "{$description}";?></p>
                     </div>



  <div class="wrapper">
                  <div class="inner">
                      <?php
                      if ($additional_note!=null)
                      {
                         echo" <h1 class='major'>Additional</h1>
                             <p> {$additional_note} </p>";
                      }
                      ?>
                    
                    
                 </div>
                </div>

  <div class="wrapper">
                  <div class="inner">
                      <?php
                      if ($reference!=null)
                      {
                         echo" <h1 class='major'>Reference</h1>
                             <p> {$reference} </p>";
                      }
                        ?>
                                        
                 </div>
                    </div>
                    </div>
                     </section>
              
        <?php
        

      }
      catch(PDOException $exception)
      {
           die('ERROR: ' . $exception->getMessage());
      }
             

             }
        if (!isset($_GET['page']))
          { 
            ?>
        <!-- Banner -->
          <section id="banner">
            <div class="inner">
              <div class="logo"><img src="images/splogo.png"></div>
              <h2 style="text-align:center">Special containment procedure</h2>
            </div>
          </section>

        <!-- Wrapper -->
          <section id="wrapper">
            <?php 
            try
            {
              $query = "SELECT id, item, description from scp";//sql query for getting all scp pages
              $statement= $conn->prepare($query);
               $statement->execute();
               $i = 1;
              while($record=$statement->fetch(PDO::FETCH_ASSOC))
              {
                extract($record);
                if ($i%4 == 1) {
                  echo "<section id='one' class='wrapper spotlight style1'>
                <div class='inner'>
                  <a href='#' class='image'><img src='images/pic01.jpg' alt='' /></a>
                  ";
                }
                elseif ($i%4 == 2) {
                   echo "<section id='two' class='wrapper alt spotlight style2'>
                <div class='inner'>
                  <a href='#' class='image'><img src='images/pic02.jpg' alt='' /></a>
                   ";
                }
                elseif ($i%4 == 3) {
                   echo "<section id='three' class='wrapper spotlight style3'>
                <div class='inner'>
                  <a href='#' class='image'><img src='images/pic03.jpg' alt='' /></a>
                   ";
                }
                elseif ($i%4 == 0) {
                   echo "<section id='four' class='wrapper alt style1'>
                <div class='inner'>";

                }
                echo
                 "<div class='content'>
                    <h2 class='major'>{$item}</h2>
                    <p>{$description}</p>
                        <a href='index.php?page={$id}'  class='special'>Learn more</a>

                  </div>
                </div>
                </div>
                </div>
                </div>
              </section>";
              $i++;
              }

            }
            catch(PDOException $exception)
            {
                 die('ERROR: ' . $exception->getMessage());
            }
             
             ?>

          </section>
        <?php } ?>
        <!-- Footer -->
          <section id="footer">

            <div class="inner">
              <?php 
          //addition two more button in menu  i.e update and delete
                   
 
                     if (isset($_GET['page'])) {
                      echo "<p class='mg-ng'><a href='update.php?id={$id}' class='btn btn-primary text-light p-5'><input type='submit'value='Edit' ></a>
                         <a href='#' onclick='delete_record({$id})' class='btn btn-danger text-light p-5'><input type='submit'value='Delete' ></a>
                         </p> ";
                     }
                     ?>

                 <ul class="copyright">
                    <li> & Suman Neupane</li><li>ID: <a href="https://toiohomai.ac.nz/">30021935</a></li>
                </ul>
              </div>
          </section>
         

         <?php
        
        $delete=isset($_GET['action']) ? $_GET['action'] :"";

        //if directed from delete.php
        if($delete =='deleted')
        {
            echo "<div clas='alert alert-success'>Records was deleted</div>";
        }
 
 
 ?>
 <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Check</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="form" autocomplete="off">
         <div class="modal-body">
          <div class="row">
            <input type="hidden" name="id" class="id"/>
            <label>Username</label>
            <input type="text" name="username" class="username"/>
          </div>
          <div class="row">
            <label>Password</label>
            <input type="password" name="password" class="password"/>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Sign In</button>
        </div>
      </form>
     
    </div>
  </div>
</div>

 
    <!-- Scripts -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.scrollex.min.js"></script>
      <script src="assets/js/browser.min.js"></script>
      <script src="assets/js/breakpoints.min.js"></script>
      <script src="assets/js/util.js"></script>
      <script src="assets/js/main.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
      <script>
function delete_record(id)
{
    var answer=confirm('ok to delete this recpord');
    if(answer)
    {
      $('#myModal').modal('show');
      $(".id").val(id);
    }
}
$(".form").submit(function(e){
    e.preventDefault(e);
    var id = $(".id").val();
    var username = $(".username").val();
    var password = $(".password").val();
    if (username == "a30021935" && password == "toiohomai1234") {
      window.location.href = "delete.php?id="+id;
    }
    
  });

 </script>

  </body>
</html>