<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
  <link rel="stylesheet" href="../style.css">
  <title><?php echo $title; ?></title>
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark justify-content-between">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">LOGO</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item <?php if($page==='home') {echo 'active';} ?>">
            <a class="nav-link" href="#">HOME <?php if($page==='home') {echo '<span class="sr-only">(current)</span>';} ?></a>
          </li>
          <li class="nav-item <?php if($page==='link') {echo 'active';} ?>">
            <a class="nav-link" href="#">LINK <?php if($page==='link') {echo '<span class="sr-only">(current)</span>';} ?></a>
          </li>
          <li class="nav-item dropdown <?php if($dropdown==='dropdown') {echo 'active';} ?>">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            DROPDOWN <?php if($dropdown==='dropdown') {echo '<span class="sr-only">(current)</span>';} ?>
          </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item <?php if($page==='item1') {echo 'active';} ?>" href="#">Item 1 <?php if($page==='item1') {echo '<span class="sr-only">(current)</span>';} ?></a>
              <a class="dropdown-item <?php if($page==='item2') {echo 'active';} ?>" href="#">Item 2 <?php if($page==='item2') {echo '<span class="sr-only">(current)</span>';} ?></a>
              <a class="dropdown-item <?php if($page==='item3') {echo 'active';} ?>" href="#">Item 3 <?php if($page==='item3') {echo '<span class="sr-only">(current)</span>';} ?></a>
              <a class="dropdown-item <?php if($page==='item4') {echo 'active';} ?>" href="#">Item 4 <?php if($page==='item4') {echo '<span class="sr-only">(current)</span>';} ?></a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="whitespace-navbar"></div>
