<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <style>
        .vcode-input {
        width: 40px;
        height: 40px;
        text-align: center;
        font-size: 18px;
        }

    </style>
</head>
<body>
    <br><br><br><br>
    <div class="container text-center my-5 card px-5 py-5 shadow-lg rounded w-50">
        <h1 class="text-danger">Confirmation Subscriber</h1><br><br>
        <label for="vcode1" class="text-danger">Enter 6-digit verification code</label><br><br>
        <form action="{{route('mail.confirmation')}}" id="myForm" method="POST">
        @csrf
            <div class="vcode" id="vcode">
                <input type="phone" name="digit1" class="vcode-input" maxlength="1" id="vcode1">
                <input type="phone" name="digit2" class="vcode-input" maxlength="1">
                <input type="phone" name="digit3" class="vcode-input" maxlength="1">
                <input type="phone" name="digit4" class="vcode-input" maxlength="1">
                <input type="phone" name="digit5" class="vcode-input" maxlength="1">
                <input type="phone" name="digit6" class="vcode-input" maxlength="1"><br><br><br>
                <input type="button" onclick="myFunction()" value="Reset" class="btn btn-warning">
                <input type="submit" class="btn btn-danger mx-auto" value="Submit">
            </div>
        </form>
    </div>
    <script>

        function myFunction() {
        document.getElementById("myForm").reset();
        }

        var vcode = (function () {
        //cache dom
        var $inputs = $("#vcode").find("input");

        //bind events
        $inputs.on('keyup', processInput);

        //define methods
        function processInput(e) {
            var x = e.charCode || e.keyCode;
            if ((x == 8 || x == 46) && this.value.length == 0) {
                var indexNum = $inputs.index(this);
                if (indexNum != 0) {
                    $inputs.eq($inputs.index(this) - 1).focus();
                }
            }

            if (ignoreChar(e))
                return false;
            else if (this.value.length == this.maxLength) {
                $(this).next('input').focus();
            }
        }
        function ignoreChar(e) {
            var x = e.charCode || e.keyCode;
            if (x == 37 || x == 38 || x == 39 || x == 40)
                return true;
            else
                return false
        }

    })();
    </script>
</body>
</html>