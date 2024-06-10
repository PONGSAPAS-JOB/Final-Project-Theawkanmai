<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<?php
session_start();
//  "<script>alert('Logout!');</script>";
//  "<script>window.location.href='signin.php'</script>";
echo  "<script>
    $(document).ready(function() {
        Swal.fire({
            title: 'Logout!',
            text: 'กำลังออกจากระบบ',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            window.location.href = 'signin.php';
        });
    });
</script>";
session_destroy();


?>