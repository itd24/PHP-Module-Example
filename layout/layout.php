<html lang="en"><head>
    <meta charset="utf-8">
    <title>A Simple PHP Module Example</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="/layout/assets/vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="/layout/assets/vendor/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">A Simple PHP Module Example</a>
          <div class="nav-collapse collapse">
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Sidebar</li>
              <?php
foreach ($modules as $module) {
    $classes = array();
    if ($module['name'] == $activeModule) $classes[] = "active";
    echo '<li class="' . implode(" ", $classes) . '"><a href="' . $module['url'] . '">' . $module['name'] . '</a></li>';
}
?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <?php
echo $content; ?>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
      
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/layout/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/layout/assets/vendor/bootstrap/js/bootstrap.min.js"></script>  

</body></html>