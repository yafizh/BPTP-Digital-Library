<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- CONFIG -->
  <script src="<?= '../../../CONFIGURATION.js' ?>"></script>
  <?php require_once "../../../CONFIGURATION.php"; ?>
</head>
<style>
  html,
  body {
    height: 100%;
  }

  body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
  }

  .form-signin {
    width: 100%;
    max-width: 430px;
    padding: 15px;
    margin: auto;
  }

  .form-signin .checkbox {
    font-weight: 400;
  }

  .form-signin .form-floating:focus-within {
    z-index: 2;
  }

  .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
  }

  .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
</style>

<body class="text-center bg-success">
  <main class="form-signin">
    <form>
      <div class="bg-white border p-5">
        <img class="mb-4" src="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>web_service/assets/img/logo.png" alt="" width="100">
        <h1 class="h3 mb-3 fw-normal">Silakan Login</h1>
        <div class="form-floating">
          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
          <label for="username">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
          <label for="password">Password</label>
        </div>
        <a href="<?= (IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/home_page.php" class="link-dark">Masuk Sebagai Tamu</a>
        <button id="btn-login" class="mt-2 w-100 btn btn-lg btn-success" type="submit">Masuk</button>
      </div>
      <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p> -->
    </form>
  </main>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script>
    sessionStorage.clear();
    $('.form-signin form').on('submit', e => {
      e.preventDefault();

      if (typeof(Storage) !== "undefined") {

        $.ajax({
          url: `${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}web_service/?request=postAuth`,
          type: 'POST',
          data: {
            'username': $('#username').val(),
            'password': $('#password').val()
          },
          dataType: 'json',
          success: function(response) {
            console.log(response)
            if (response.isSuccess) {
              sessionStorage.setItem(cacheKey, JSON.stringify(response.data));
              location.replace(`${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL: PRODUCTION_BASE_URL}information_system/app/admin_page/beranda.php`);
            } else {
              alert('Username atau Password salah')
            }
          }
        })
      } else {
        alert("Browser tidak mendukung Web Storage")
      }
    });
  </script>
</body>

</html>