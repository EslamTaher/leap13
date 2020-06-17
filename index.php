
<?php
    ob_start();
    session_start();
    $jsonData=file_get_contents("https://api.jsonbin.io/b/5eafd4ca47a2266b1472794c");
    $json=json_decode($jsonData,true);

    echo "<h2>Tracks</h2>";
    $output="";
    
    foreach($json['tracks'] as $track){
        $output.="name :".$track["name"]."<br />";
    }
    #echo "<button class='btn btn-primary'>{$output}</button>";
    $msg = '';
            
    if (isset($_POST['login']) && !empty($_POST['username']) 
        && !empty($_POST['password'])) {

        if ($_POST['username'] == 'leap13' && $_POST['password'] == 'leap13pass') {
          $_SESSION['valid'] = true;
          $_SESSION['timeout'] = time();
          $_SESSION['username'] = 'leap13';
          
          
          echo 'You have entered valid username and password';
        }else {
          $msg = 'Wrong username or password';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" >
</head>
<body>

    <?php
    // session_start();
    if(isset($_SESSION['username'])){ 
      $file_name = basename($url); 
      file_put_contents( $file_name,file_get_contents($url))
      ?>
      <p class="text-center">Welcome <span class="alert alert-success"><?php echo $_SESSION['username']; ?></span></p>
      <button class="btn btn-dark">
        <a class="text-right" href = "logout.php" tite = "Logout">Logout</a>
      </button>

    <?php } ?>
    <div class="container">
        <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Name</th>
            <th scope="col">Artist</th>
            <th scope="col">Length</th>
            <th scope="col">Download</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($json['tracks'] as $track){
                    $name   =$track["name"];
                    $artist =$track["artist"];
                    $length =$track["length"];
                    $url    =$track["url"];
                 

                    echo "<tr>
                            <td>$name</td>
                            <td>$artist</td>
                            <td>$length</td>
                            <td>
                            <button type='button' class='btn btn-secondary' data-toggle='modal' data-target='#exampleModal'>
                                <i class='fa fa-download' aria-hidden='true'></i>
                            </button>
                            </td>
                        </tr>";
                }
            ?>
            
            
        </tbody>
        </table>
    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
      <p class = "form-signin-heading alert alert-danger"><?php echo $msg; ?></p>
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" name = "username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name = "password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" name = "login" class="btn btn-primary">Submit</button>
      </form>
      			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
         <!-- Click here to clean <a href = "logout.php" tite = "Logout">Session. -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>
</html>