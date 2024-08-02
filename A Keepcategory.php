<div style="display: flex; ">

    <?php
    include_once('functions.php');
    $fetchdatacategory = new DB_con();
    $sqlcategory = $fetchdatacategory->fetchdatacategory();
    $areacategory = [];
    while ($row = mysqli_fetch_array($sqlcategory)) {
        $areacategory[] = $row['name_category'];
    }
    ?>

    <div class="mb-3" style="margin-right: 50px; width: 300px;">
        <label for="name_category_1" class="form-label required-label">หมวดหมู่ของสถานที่ท่องเที่ยว เเบบที่ 1 </label>
        <select class="form-select" id="name_category_1" name="name_category_1" aria-describedby="หมวดหมู่1" required>
            <option value="" disabled selected>โปรดเลือกหมวดหมู่ของสถานที่ท่องเที่ยว</option>
            <?php foreach ($areacategory as $category) { ?>
                <option value='<?php echo $category; ?>'><?php echo $category; ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3" style="width: 300px;">
        <label for="name_category_2" class="form-label required-label">หมวดหมู่ของสถานที่ท่องเที่ยว เเบบที่ 2</label>
        <select class="form-select" id="name_category_2" name="name_category_2" aria-describedby="หมวดหมู่2" required>
            <option value="" disabled selected>โปรดเลือกหมวดหมู่ของสถานที่ท่องเที่ยว</option>
            <?php foreach ($areacategory as $category) { ?>
                <option value='<?php echo $category; ?>'><?php echo $category; ?></option>
            <?php } ?>
        </select>
    </div>



    <button id="addareacategoryButton" class="btnaddtt rounded" style=" margin-right: 30px;"><i class="fa fa-plus"></i></button>

    <script>
        $(document).ready(function() {
            $('#addareacategoryButton').click(function() {
                Swal.fire({
                    title: 'คุณต้องการเพิ่มกลุ่มของสถานที่ท่องเที่ยวหรือไม่?',
                    text: "กำลังจะเข้าสู่หน้าเพิ่มกลุ่มของสถานที่ท่องเที่ยว ข้อมูลที่กรอกไว้จะต้องเริ่มต้นกรอกใหม่",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่ฉันต้องการเพิ่ม!',
                    cancelButtonText: 'ยังก่อน'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'กำลังเข้าสู่หน้าเพิ่มกลุ่มของสถานที่ท่องเที่ยว',

                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = 'areacategoryMG.php';
                        });

                    }
                });
            });
        });
    </script>




    <script>
        document.getElementById('name_category_1').addEventListener('change', function() {
            var selectedValue = this.value;
            var category2 = document.getElementById('name_category_2');
            var options = category2.querySelectorAll('option');

            options.forEach(function(option) {
                if (option.value === selectedValue) {
                    option.style.display = 'none';
                } else {
                    option.style.display = 'block';
                }
            });
        });

        document.getElementById('name_category_2').addEventListener('change', function() {
            var selectedValue = this.value;
            var category1 = document.getElementById('name_category_1');
            var options = category1.querySelectorAll('option');

            options.forEach(function(option) {
                if (option.value === selectedValue) {
                    option.style.display = 'none';
                } else {
                    option.style.display = 'block';
                }
            });
        });
    </script>


</div>
<hr>


//=========================================