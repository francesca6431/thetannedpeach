<?php include('assets/snippets/check_session.php') ?>


<!DOCTYPE html>
<html  lang="en" dir="ltr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cantata+One|Roboto|Material+Icons" />
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/product-detail.css">
    <title>Verde - Product Details</title>

  </head>

  <body>

    <header class="header">
     <?php include('assets/snippets/navbar.php'); ?>
      <br>
      <div class="d-flex align-items-center">

        <div class="ml-10 text-left">
          <!-- Breadcrumbs -->
            <ol class="breadcrumb breadcrumb_ mb-0 pl-8" style=" padding:24px">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="products.php">Products</a></li>
              <li class="breadcrumb-item active">Product details</li>
            </ol>
        </div>
        <div class="pr-0  ml-auto">
          <!-- sorting -->

        </div>
      </div>
    </header>

    <!-- main -->
    <main class="col-sm-10">
      <?php
      //id of the item to display
      require_once('assets/snippets/db.php');
      $it_id = $_GET['var'];
      //retriving cards info
      $sql_detail="SELECT item.name, item.price, item.description, GROUP_CONCAT(DISTINCT image.url SEPARATOR '|') as url, category.name AS cat_name FROM item INNER JOIN image ON image.item_id = item.item_id INNER JOIN category ON category.cat_id = item.cat_id WHERE item.item_id = $it_id AND url LIKE '%.%'";
      $result_detail = $connect->query($sql_detail);
       if ($result_detail->num_rows > 0) {
          $row = $result_detail->fetch_assoc();
       }else{ echo "no result"; }
      ?>

      <div class="row">
        <!-- image -->
        <div class="col-sm-6 mx-auto" >
          <div id="carousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
                <?php
                $images = explode("|", $row['url']);
                for ( $x = 0; $x < count($images); $x++) {
                  if($x == 0){
                    echo '<li data-target="#carousel" data-slide-to="0" class="active"></li>';
                  }
                  else{
                    echo '<li data-target="#carousel" data-slide-to="'.$x.'"></li>';
                  }
                }
                ?>
              </ol>

              <!-- Wrapper for slides -->
              <div class="carousel-inner">
                <?php
                  $k=0;
                  foreach ($images as $image) {
                    if ( $k==0 ){
                      echo '<div class="carousel-item active">';
                      $k++;
                    }else{
                      echo '<div class="carousel-item">';
                    }
                    echo '<img class=" img-fluid" src="'.$image.'">';
                    echo '</div>';

                  }
                ?>
              </div>
          </div>


        </div>
        <!-- information -->
        <div class="col-sm-6 d-flex ml-auto p-0">
            <div class="text-left col-sm-12">
              <?php
              echo '<h3 class="">'.$row["name"].'</h3>'.
                   '<p class="" >AUD$ '.$row["price"].'</p>';
              ?>
              <br>
              <div class="accordion" id="accordionExample">
                <div class="card border-0  m-0 p-0 w-100 col-sm-12">
                  <div class="card-header p-0 border-1 bg-transparent" id="headingOne">
                    <h5 class="mb-0">
                      <button id="btn-sld" class="d-flex btn btn-link p-0 text-dark btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style=" text-decoration: none;" >
                        <h5 class="ml-0">Description</h5>
                        <span class="ml-auto">
                        <i id="sym2" class="ml-auto material-icons">keyboard_arrow_up</i>
                        <i id="sym1" class="ml-auto material-icons">keyboard_arrow_down</i>
                        </span>
                      </button>
                    </h5>
                  </div>
                  <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <?php
                      echo '<p class="" >'.$row["description"].'</p>';
                      ?>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="accordion" id="accordionExample">
                <div class="card border-0  m-0 p-0 w-100 col-sm-12">
                  <div class="card-header p-0 border-1 bg-transparent" id="headingOne">
                    <h5 class="mb-0">
                      <button id="btn-sld" class="d-flex btn btn-link p-0 text-dark btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style=" text-decoration: none;" >
                        <h5 class="ml-0">Size</h5>
                        <span class="ml-auto">
                        <i id="sym3" class="ml-auto material-icons">keyboard_arrow_down</i>
                        <i id="sym4" class="ml-auto material-icons">keyboard_arrow_up</i>
                        </span>
                      </button>
                    </h5>
                  </div>
                  <div id="collapseOne" class="collapse card-body" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="row">
                      <?php //echo'<Form name ="formToCart" Method ="Post" ACTION ="cart.php?id='.$it_id.'&size='.$size.'">' ?>
                      <div class="size_ col-sm-2"> 6 <input type="radio" name="size" value="6" checked></div>
                      <div class="size_ col-sm-2"> 8 <input type="radio" name="size" value="8"></div>
                      <div class="size_ col-sm-2"> 10 <input type="radio" name="size" value="10"></div>
                      <div class="size_ col-sm-2"> 12 <input type="radio" name="size" value="12"></div>
                      <div class="size_ col-sm-2"> 14 <input type="radio" name="size" value="14"></div>
                      <div class="size_ col-sm-2"> 16 <input type="radio" name="size" value="16"></div>
                    </div>
                  </div>
                </div>
              </div>

              <br>
              <div class="accordion" id="accordionExample">
                <div class="card border-0 m-0 p-0 w-100 col-sm-12">
                  <div class="card-header p-0 border-1 bg-transparent" id="headingOne">
                    <h5 class="mb-0">
                      <button id="btn-sld" class="d-flex btn btn-link p-0 text-dark btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style=" text-decoration: none;" >
                        <h5 class="ml-0">Estimated arrival</h5>
                        <span class="ml-auto">
                        <i id="sym5" class="ml-auto material-icons">keyboard_arrow_down</i>
                        <i id="sym6" class="ml-auto material-icons">keyboard_arrow_up</i>
                        </span>
                      </button>
                    </h5>
                  </div>
                  <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      Express Delivery within 3-4 business days
                    </div>
                  </div>
                </div>
              </div>
              <br>
                <button type = "button" onClick="AddToBag()"  class="btn-add-bag btn btn-dark col-sm-7">
                  <i class="fa fa-shopping-bag mr-3"></i> ADD TO BAG</button>
              <p id="demo"></p>
            </div>

        </div>
      </div>

    </main>

<!-- Footer -->

    <!-- Newsletter content over -->
    <?php include('assets/snippets/footer.php'); ?>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Custom Js -->
    <script src="assets/js/scrollbar.js" type="text/javascript"></script>
    <script src="assets/js/validation.js" type="text/javascript"></script>
    <script src="assets/js/account.js" type="text/javascript"></script>
    <script src="assets/js/product-detail.js" type="text/javascript"></script>

     <script>
        function AddToBag(){
          var radioButtons = document.getElementsByName("size");
          for (var i = 0; i < radioButtons.length; i++) {
              if (radioButtons[i].checked) {
                var sz_it = radioButtons[i].value;
                var id_it = <?php echo $it_id ?>;
                window.location.href = "cart.php?id=" + id_it + "&size=" + sz_it;
                break;
              }
          }
        }
      </script>




</body>
</html>
