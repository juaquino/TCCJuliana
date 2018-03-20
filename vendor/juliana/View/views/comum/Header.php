<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
 <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <title>Juliana Aquino</title>
</head>
<body>
  <div class="container">
    <div class="right">
      <?php //exibe o botão sair se estiver logado
      if(@$_SESSION['user']){ ?>
      <a href="logout">
        <button class="btn btn-lg btn-default">
          Sair
        </button>
      </a>
      <?php } ?>
    </div>