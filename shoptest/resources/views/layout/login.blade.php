<!DOCTYPE html>
<html>
<title>Trang đăng nhập</title>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #eee;
            font-size: 15px;
        }

        form {
            
            border: 3px solid #f1f1f1;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .cancelbtn {
            width: auto;
            padding: 10px 18px;
            background-color: #f44336;
        }

        .imgcontainer {
            text-align: center;
            margin-bottom: 12px;
            /* Khoảng cách dưới hình ảnh */
        }

        img.avatar {
            width: 13%;
            border-radius: 50%;
        }

        .container {
            max-width: 300px;
            /* Kích thước tối đa của form */
            margin: 0 auto;
            /* Căn giữa form trên màn hình */
            padding: 16px;
        }

        span.psw {
            float: right;
            padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }

            .cancelbtn {
                width: 100%;
            }
        }
    </style>
</head>

<body>


    <form action="{{ route('layout.postlogin') }}" method="POST" id="loginForm">
        @csrf
        <div class="imgcontainer">
        <img  src="{{asset('img\product\logo.jpg')}}" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="uname"><b>Email</b></label>
            <input type="text" placeholder="Enter Username" name="email" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" id="password" required>

            <button type="submit">Đăng nhập</button>
            <label>
                <input type="checkbox" name="remember" id="remember"> Lưu thông tin đăng nhập
            </label>
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <!-- <button type="button" class="cancelbtn">Cancel</button> -->
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>

</body>

</html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    // Lấy thông tin email và password từ localStorage (nếu có) và điền vào form
    document.addEventListener('DOMContentLoaded', function() {
        var email = localStorage.getItem('email');
        var password = localStorage.getItem('password');
        var rememberCheckbox = document.getElementById('remember');
        var emailInput = document.getElementById('email');
        var passwordInput = document.getElementById('password');

        if (email && password) {
            emailInput.value = email;
            passwordInput.value = password;
            rememberCheckbox.checked = true;
        }
    });

    // Xử lý sự kiện submit form
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        var rememberCheckbox = document.getElementById('remember');
        var emailInput = document.getElementById('email');
        var passwordInput = document.getElementById('password');

        // Nếu người dùng chọn "Lưu thông tin đăng nhập", lưu email và password vào localStorage
        if (rememberCheckbox.checked) {
            localStorage.setItem('email', emailInput.value);
            localStorage.setItem('password', passwordInput.value);
        } else {
            // Ngược lại, xóa email và password từ localStorage
            localStorage.removeItem('email');
            localStorage.removeItem('password');
        }
    });
</script>

@if(Session::has('successMsg'))
<script>
    swal("Thông báo", "{{Session::get('successMsg')}}", "success");
</script>
@endif

@if(Session::has('errorMsg'))
<script>
    swal("Thất bại", "{{Session::get('errorMsg')}}", "warning");
</script>
@endif