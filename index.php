<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?php 
    include_once('functions.php');
    $userdata = new DB_con();

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $useremail = $_POST['email'];
        $phone = $_POST['phone'];
        $password = md5($_POST['password']);

        $sql = $userdata->registration($username,$useremail,$phone,$password);

        if ($sql) {
            echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Register Success!',
                        text: 'กำลังบันทึกข้อมูล',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = 'signin.php';
                    });
                });
            </script>";
        } else {
            echo "<script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Register Failed!',
                    text: 'ลงทะเบียนผิดพลาด โปรดลองอีกครั้ง!',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'index.php';
                });
            });
        </script>";

        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียนผู้ใช้งาน</title>
    <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<style>
body {
    margin-top: 60px;
  background-image: url('img/img1.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}
</style>
<style>

      
@font-face {
    font-family: 'Lily Script One';
    src: url('path_to_font_files/linly-script.woff2') format('woff2'), 
        url('path_to_font_files/linly-script.woff') format('woff');

    }
    
h1{
    opacity: 1;
    font-size: 34px;
    
}
h2{
    font-size: 40px;
    font-family: 'Lily Script One', cursive; 
}
h6{
    font-size: 20px;
    font-family: 'Lily Script One', cursive; 
}
button{
    
    font-family: 'Lily Script One', cursive; 
}
hr{
    margin-left: -60%;
     
}

input{
    background-color:#FFFFFF;
}

span{
    margin-left: 5%;
}

    @import url('https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap');
  
    .containerbg{
        
          width: 100%; /* Set the initial width */
        max-width: 700px; /* Set the maximum width */
        height: 90vh; /* Allow the height to adjust proportionally */
        margin: 0 auto; /* Center the container */
        transition: transform 0.3s ease; /* Smooth transition when scaling */
        overflow: hidden; 
        margin-top: -2%;
        opacity: 0.9;
        border-radius: 20px;
  background-color: #f0f0f0;
  padding: 20px;

}
    .logo{    
        width: 20%;
        opacity: 0.7;
        
    }
   
    .title{
        margin-top: 1%;
        margin-left: 37%;
    }
    .detail{
        margin-left: 7%;
        font-size: 15px;
    }
    .subtitile{
        margin-left: 8%;
        margin-top: 5%;
       

    }
    #login{  /*css แบบId*/ 
        font-size: 20px;
    }
    .username{
        margin-top:2rem;
         margin-left: auto;
         margin-right: auto;
         
        
    }
    .form-control{
        width: 80%;
        margin-left: auto;
         margin-right: auto;
         margin-top: 1rem;
         background-color:#FFFFFF;
         padding: 10px;
    }
    .btn{
        
        width: 80%;
        margin-left: 10%;
         margin-right: auto;
         margin-top: 3rem;
    }
    #createaccount{
        margin-left: 34%;
       
    }
    .signin{
        margin-top: 5%;
        margin-left: 30%;
    }
    .foget{
        margin-top: 3%;
        margin-left: 65%;
    }
    
</style>
<body >


    <div class = "containerbg" >
        <div class = "title">
        <h1>
            “ REGISTER ”
        </h1>
        <div class ="detail">
        ลงทะเบียนเพื่อเข้าสู่ระบบ
        </div>
        <hr>
    
        
        </div>
        <form method="post">
        <div class ="username" >
        <input type="text" class="form-control" id="username" name="username"   placeholder="Username"  onblur="checkusername(this.value)" required>
        <span id="usernameavailable"></span>

        <input type="email" class="form-control" id="email" name="email"   placeholder="Email"  onblur="checkuseremail(this.value)" required>
        <span id="emailavailable"></span>

        <input type="phone" class="form-control" id="phone" name="phone"   placeholder="Phone number" required>

        <input type="password" class="form-control" id="password" name="password"  placeholder="Password">
    
        

        <button type="submit" name="submit" id="submit" class="btn btn-warning" >Register</button>
        </form>

        <div class="signin">
        <A>Do you already have an account? <A id="signin" href="signin.php"><h7>Sign in</h7> </A></A>
        </div>
        
        
        
        
        </div>
        
    </div>
 
</body>
</html>



<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function checkusername(val){
        $.ajax({
            type: 'POST',
            url: 'checkuser_available.php',
            data: 'username='+val,
            success: function(data) {
                $('#usernameavailable').html(data);
            }
        });
    }

    function checkuseremail(val){
        $.ajax({
            type: 'POST',
            url: 'checkemail_available.php',
            data: 'email='+val,
            success: function(data) {
                $('#emailavailable').html(data);
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
</body>
</html>