<?php

include("connectdata.php");
include_once("header.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $selectuser = "SELECT * FROM users WHERE id = '$id'";

  $result = $conn->prepare($selectuser);
  $arr_user = $result->execute();

  $row =  $result->fetch();



  $name = $row['name'];

  $address = $row['address'];

  $phone = $row['phone'];
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../build/css/bootstrap.min.css" />
  <!-- style css -->
  <link rel="stylesheet" type="text/css" href="/css/index.css" />
  <!-- Responsive-->
  <link rel="stylesheet" href="../build/css/responsive.css" />
  <link rel="stylesheet" href="../build/css/profile.css" />
  <title>Document</title>
</head>

<body>
  <?php

 



  ?>
  <!--  -->
  <section class="row-12 col-sm-12 ">
    <div class="col-sm-12 bg-c-lite-green user-profile">
      <div class="card-block text-center text-white">
        <div class="m-b-25">
          <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
        </div>
        <h6 class="f-w-1000"><?php print_r($row['name']) ?></h6>
        
        <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
      </div>
    </div>
    <div class="form col-8  m-auto">
      <form action="profile.php" method="post">
        <div class="form-group w-100">
          <label for="price">name:</label>
          <input type="text" class="form-control  " id="name" placeholder="name" name="name" value="<?php echo htmlspecialchars($name) ?>">
        </div>
        <div class="form-group w-full">
          <label for="phone">phone:</label>
          <input type="phone" class="form-control" id="phone" value="<?php echo htmlspecialchars($phone) ?>" placeholder="phone number" name="phone" size="10" required>
        </div>

        <div class="form-group w-full">
          <label for="status">address:</label>
          <input type="text" class="form-control" id="address" value="<?php echo htmlspecialchars($address) ?>" placeholder="address" name="address">
        </div>

        <input type="submit" class="btn btn-primary col-4" value="Save">

      </form>
    </div>
    </div>
    </div>
  </section>
  <!--  -->

  
  </div>
  </div>
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script src="../build/js/profile.js"></script>
</body>

</html>