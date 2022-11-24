<?php if (!empty($connection)) {
  if ($mod == "") {
    header('location:./404');
  } else {
    include "./meta-social.php"; ?>
    <!DOCTYPE html>
    <html lang="id">

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <?php require_once './sw-library/meta-social.txt'; ?>
  <?php echo '
      <link rel="stylesheet" href="' . $website_url . '/sw-content/themes/' . $folder . '/assets/css/sw-main.css">
      <link rel="stylesheet" href="' . $website_url . '/sw-content/themes/' . $folder . '/assets/css/sw-responsive.css">
      <link rel="stylesheet" href="' . $website_url . '/sw-content/themes/' . $folder . '/assets/css/rating/starability-all.min.css">
      <link rel="stylesheet" href="' . $website_url . '/sw-content/themes/' . $folder . '/assets/css/custom.css">';
    if ($mod == 'home' or $mod == 'sw-product-details') {
      echo '
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>';
    }
    echo '
  </head>
<body>

<header>
    <div class="header-top">
            <div class="container">
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 top-contact">
                        <div class="list">
                            <i class="fa fa-envelope"></i>
                            <a href="mailto:' . $website_email . '">' . $website_email . '</a>
                        </div>
                        <div class="list">
                            <i class="fa fa-phone"></i>' . $website_phone . '
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 top-contact">
  
                      <div class="item">
                        <ul>
                        <li><a href="' . $social_facebook . '" target="_blank" data-toggle="tooltip"  data-placement="bottom" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="' . $social_twitter . '" target="_blank" data-toggle="tooltip"  data-placement="bottom"  data-placement="bottom" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="https://www.instagram.com/' . $social_instagram . '" target="_blank" data-toggle="tooltip"  data-placement="bottom" title="Instagram"><i class="fa fa-instagram"></i></a></li>

                        </ul>
                      </div>
                    </div>
                </div>
            </div>
        </div>

  <nav class="navbar-me navbar navbar-default" id="mainNav">
      <div class="container">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle Navigation</span>
          <i class="fa fa-bars"></i>
        </button>
          <a class="navbar-brand pull-left" href="' . $website_url . '">
              <img src="' . $website_url . '/sw-content/' . $website_logo . '">
          </a>                
          <div class="collapse navbar-collapse navbar-ex1-collapse pull-right">
            <div class="sw-navbar">
              <ul class="nav navbar-nav main-navbar-nav">';
    function menu_showNested($parentID)
    {
      global $connection;
      $sql_menu = "SELECT id,parent_id,title,url FROM menu WHERE parent_id='$parentID' and group_id='1' ORDER BY position";
      $result_menu = mysqli_query($connection, $sql_menu);
      $numRows = mysqli_num_rows($result_menu);
      if ($numRows > 0) {
        echo '<ul class="dropdown-menu">';
        while ($row_menu = mysqli_fetch_assoc($result_menu)) {
          echo '<li><a href="' . $row_menu['url'] . '">' . $row_menu['title'] . '</a></li>';
          menu_showNested($row_menu['id']);
        }
        echo '</ul>
                </li>';
      }
    }

    # Show the top parent elements from DB
    $sql_menu = "SELECT id,parent_id,title,url,class FROM menu WHERE parent_id='0' and group_id='1' ORDER BY position";
    $result_menu = mysqli_query($connection, $sql_menu);
    $numRows = mysqli_num_rows($result_menu);
    while ($row_menu = mysqli_fetch_assoc($result_menu)) {
      if ($row_menu['class'] !== 'dropdown') {

        if ($row_menu['class'] !== 'home') {
          echo '<li><a href="' . $row_menu['url'] . '">' . $row_menu['title'] . '</a></li>';
        } else {
          echo '<li><a class="nav-link js-scroll-trigger" href="' . $row_menu['url'] . '">' . $row_menu['title'] . '</a></li>';
        }
      } else {
        echo '<li class="dropdown">
                    <a href="' . $row_menu['url'] . '" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $row_menu['title'] . ' <i class="fa fa-angle-down"></i></a>';
        menu_showNested($row_menu['id']);
      }
    }
    // Tombol Keranjang
    if (isset($_SESSION['keranjang']) && count($_SESSION) > 0) {
      $countKeranjang = count($_SESSION['keranjang']);
      echo '<li>
        <span class="badge" title="Ada ' . $countKeranjang . ' Produk di Keranjang">' . $countKeranjang . '</span>
      </li>';
    }

    echo '
              </ul>  
            </div>   
        </div> 
        <!-- /.navbar-collapse -->                
      </div>
    </nav>
</header>
';
  }
} ?>