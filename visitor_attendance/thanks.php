<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            -webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
            -moz-animation: fadein 2s; /* Firefox < 16 */
                -ms-animation: fadein 2s; /* Internet Explorer */
                -o-animation: fadein 2s; /* Opera < 12.1 */
                    animation: fadein 2s;
        }

        @keyframes fadein {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* Firefox < 16 */
        @-moz-keyframes fadein {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* Safari, Chrome and Opera > 12.1 */
        @-webkit-keyframes fadein {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* Internet Explorer */
        @-ms-keyframes fadein {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
    </style>
</head>
<body class="d-flex flex-column text-center align-items-center mt-5 justify-content-center ">
    <h1>Terima Kasih Sudah Mengisiiiiii >_<</h1>
    <h1 id="countdown"></h1>
<script>
    let time = 10;
    document.querySelector('#countdown').innerHTML = time;
    setInterval(_ => {
        document.querySelector('#countdown').innerHTML = --time;
        if (time === 0) {
            window.location.replace('index.php');
        }
    }, 1000)
</script>
</body>
</html>