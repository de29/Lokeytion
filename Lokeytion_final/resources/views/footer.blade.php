<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>footer</title>
</head>
<body>
@yield('index')
    <!-- Footer Bottom Start -->
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
     
             <span class="copy">&copy;</span> <a href="#" class="mr-2">Lokeytion</a>
             <div class="Reseaux">
             <a href="#" class="mr-2"><i class="fab fa-facebook"></i></a>
             <a href="#" class="mr-2"><i class="fab fa-twitter"></i></a>
             <a href="#"><i class="fab fa-instagram"></i></a>
</div>
       
        </div>
      </div>
    </div>
  </div>
  <!-- Footer Bottom End -->
</body>
</html>

<style>

.footer-bottom div{
    display: flex;
   
    margin-bottom:0;
  }
  .Reseaux{
    /*padding-left: 400%;*/
    padding-left:300%;
  }

.footer-bottom {
  /*position: relative;*/
  position:inherit;
  bottom: 0;
  padding: 25px 0;
  background: #353535;
  font-size: large;
}

.footer-bottom .copy {
  color: #ffffff;
  font-weight: 400;
  margin-left: 20%;
}

.footer-bottom a {
  font-weight: 600;
  color: rgb(255, 222, 89);
  text-decoration: none;
}

.footer-bottom a:hover {
  color: #ffffff;
}

.footer-bottom .fab {
  color: #ffffff;
  margin-right: 20px;
}

.footer-bottom .fab:hover {
  color: rgb(255, 222, 89);
}

@media (max-width: 768.98px) {
  .footer-bottom .copy {
    display: block;
  }

  .footer-bottom .fab {
    margin-top: 10px;
    margin-right: 5px;
  }
}
</style>
