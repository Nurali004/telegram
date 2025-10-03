<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $this->title; ?></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/site/index">Mvc</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/site/index">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/post/list">Post</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" href="/category/list">Category</a>
        </li>
       <li class="nav-item">
          <a class="nav-link" href="/comment/list">Comment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/user/list">User</a>
        </li>
        
      </ul>
     
      <form class="d-flex">
        <input  class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <?php if (isset($_SESSION['user'])): ?>
          <a href="/user/about"  style="border-radius: 40%; margin-right: 7px"><img src="/<?= $_SESSION['user']->image; ?>" alt="Profil" style="width:40px;height:40px; border-radius: 100%"></a>
          <?php endif; ?>
          <?php if(isset($_SESSION["user"])) : ?>
        <a href="/site/logout" class="btn btn-danger" >logout(<?= $_SESSION['user']->username; ?>)</a>
             <?php endif; ?>
      </form>

    </div>
  </div>
</nav>