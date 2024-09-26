<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'theawkanmai');


class DB_con
{
    public $dbcon;

    function __construct()
    {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        $this->dbcon = $conn;

        if (mysqli_connect_error()) {
            echo "Failed to connect to MySQL" . mysqli_connect_error();
        }
    }

    public function usernameavailable($username)
    {
        $checkuser = mysqli_query($this->dbcon, "SELECT username FROM manager WHERE username = '$username' ");
        return $checkuser;
    }
    public function emailavailable($useremail)
    {
        $checkemailuser = mysqli_query($this->dbcon, "SELECT email FROM manager WHERE email = '$useremail' ");
        return $checkemailuser;
    }

    public function registration($username, $useremail, $phone, $password)
    {
        $reg = mysqli_query($this->dbcon, "INSERT INTO manager(username,email,phone,password) VALUE('$username','$useremail','$phone','$password')");
        return $reg;
    }

    public function signin($username, $password)
    {
        $signinquery = mysqli_query($this->dbcon, "SELECT Id_manager, username, password FROM manager WHERE username = '$username'AND password ='$password'");
        $adminquery = mysqli_query($this->dbcon, "SELECT id_admin, username, password FROM admin WHERE username = '$username' AND password ='$password'");
        $spequery = mysqli_query($this->dbcon, "SELECT id_spe, username, password FROM spe WHERE username = '$username' AND password ='$password'");

        $userData = null;

        if (mysqli_num_rows($signinquery) > 0) {
            $userData = mysqli_fetch_assoc($signinquery);
        } elseif (mysqli_num_rows($adminquery) > 0) {
            $userData = mysqli_fetch_assoc($adminquery);
        } elseif (mysqli_num_rows($spequery) > 0) {
            $userData = mysqli_fetch_assoc($spequery);
        }

        if ($userData !== null) {
            return $userData;
        }

        return null;
    }

    // Function to fetch admin's profile picture URL
    public function getAdminProfilePicture($id_admin)
    {
        $sql = "SELECT img_admin FROM admin WHERE id_admin = ?";
        $stmt = $this->dbcon->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $this->dbcon->error);
        }
        $stmt->bind_param("i", $id_admin);
        $stmt->execute();
        $stmt->bind_result($img_admin);
        $stmt->fetch();
        $stmt->close();

        // Set a default image if img_admin is empty
        if (empty($img_admin)) {
            $img_admin = "img/pro.jpg"; // Path to default image
        }

        return $img_admin;
    }

    // Function to fetch admin's profile picture URL
    public function getManagerProfilePicture($Id_manager)
    {
        $sql = "SELECT img_manager FROM manager WHERE Id_manager = ?";
        $stmt = $this->dbcon->prepare($sql);
        if ($stmt === false) {
            die('Prepare failed: ' . $this->dbcon->error);
        }
        $stmt->bind_param("i", $Id_manager);
        $stmt->execute();
        $stmt->bind_result($img_manager);
        $stmt->fetch();
        $stmt->close();

        // Set a default image if img_admin is empty
        if (empty($img_manager)) {
            $img_manager = "img/pro.jpg"; // Path to default image
        }

        return $img_manager;
    }


    public function getinfomanager($id_Manager)
    {
        $getinfo = mysqli_query($this->dbcon, "SELECT username FROM manager WHERE Id_manager = '$id_Manager' ");
        return $getinfo;
    }

    public function getinfoadmin($id_Admin)
    {
        $getinfo = mysqli_query($this->dbcon, "SELECT username FROM admin WHERE id_admin = '$id_Admin' ");
        return $getinfo;
    }


    public function updateProfilemanager(
        $filename1,
        $username,
        $email,
        $phone,
        $Id_manager
    ) {

        // คำสั่ง SQL สำหรับอัปเดตข้อมูลในตาราง manager
        $updateQuery = "UPDATE manager SET
                            img_manager = '$filename1',
                            username = '$username',
                            email = '$email',
                            phone = '$phone'
                        WHERE Id_manager = '$Id_manager'";

        // ดำเนินการคำสั่ง SQL
        $result = mysqli_query($this->dbcon, $updateQuery);

        // ตรวจสอบว่าการอัปเดตสำเร็จหรือไม่
        if ($result) {
            return true;
        } else {
            // แสดงข้อผิดพลาดหากเกิดปัญหา
            die('Error: ' . mysqli_error($this->dbcon));
        }
    }

    public function updateProfileAdmin(
        $filename1,
        $username,
        $email,
        $phone,
        $id_admin
    ) {

        // คำสั่ง SQL สำหรับอัปเดตข้อมูลในตาราง admin
        $updateQuery = "UPDATE admin SET
                            img_admin = '$filename1',
                            username = '$username',
                            email = '$email',
                            phone = '$phone'
                        WHERE id_admin = '$id_admin'";

        // ดำเนินการคำสั่ง SQL
        $result = mysqli_query($this->dbcon, $updateQuery);

        // ตรวจสอบว่าการอัปเดตสำเร็จหรือไม่
        if ($result) {
            return true;
        } else {
            // แสดงข้อผิดพลาดหากเกิดปัญหา
            die('Error: ' . mysqli_error($this->dbcon));
        }
    }

    public function updateProfileMember(
        $id_member,
        $username,
        $email,
        $phone,
        $birthday_user
    ) {


        $updateQuery = "UPDATE member SET
                           
                            username = '$username',
                            email = '$email',
                            phone = '$phone',
                            birthday_user ='$birthday_user'
                        WHERE id_member = '$id_member'";

        $result = mysqli_query($this->dbcon, $updateQuery);

        // ตรวจสอบว่าการอัปเดตสำเร็จหรือไม่
        if ($result) {
            return true;
        } else {
            // แสดงข้อผิดพลาดหากเกิดปัญหา
            die('Error: ' . mysqli_error($this->dbcon));
        }
    }

    public function fetchmemberonerecord($id_member)
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM member WHERE id_member = '$id_member' ");
        return $result;
    }


    public function fetchAllMembers()
    {
        $query = "SELECT * FROM member"; // Adjust your query
        $stmt = mysqli_prepare($this->dbcon, $query);

        if (!$stmt) {
            echo "Failed to prepare statement: " . mysqli_error($this->dbcon);
            exit();
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Failed to execute statement: " . mysqli_stmt_error($stmt);
            exit();
        }

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            echo "Failed to get result: " . mysqli_error($this->dbcon);
            exit();
        }

        return $result;
    }

    public function fetchMembersPage($start_from, $results_per_page)
    {
        $query = "SELECT * FROM member LIMIT ?, ?";
        $stmt = mysqli_prepare($this->dbcon, $query);

        if (!$stmt) {
            echo "Failed to prepare statement: " . mysqli_error($this->dbcon);
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ii", $start_from, $results_per_page);

        if (!mysqli_stmt_execute($stmt)) {
            echo "Failed to execute statement: " . mysqli_stmt_error($stmt);
            exit();
        }

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            echo "Failed to get result: " . mysqli_error($this->dbcon);
            exit();
        }

        return $result;
    }

    public function countTotalMemberspage()
    {
        $query = "SELECT COUNT(*) as total FROM member";
        $stmt = mysqli_prepare($this->dbcon, $query);

        if (!$stmt) {
            echo "Failed to prepare statement: " . mysqli_error($this->dbcon);
            exit();
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Failed to execute statement: " . mysqli_stmt_error($stmt);
            exit();
        }

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            echo "Failed to get result: " . mysqli_error($this->dbcon);
            exit();
        }

        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }


    public function fetchAllManager()
    {
        $query = "SELECT * FROM manager"; // Adjust your query
        $stmt = mysqli_prepare($this->dbcon, $query);

        if (!$stmt) {
            echo "Failed to prepare statement: " . mysqli_error($this->dbcon);
            exit();
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Failed to execute statement: " . mysqli_stmt_error($stmt);
            exit();
        }

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            echo "Failed to get result: " . mysqli_error($this->dbcon);
            exit();
        }

        return $result;
    }


    public function checkSurveyStatus($id_member)
    {
        $query = "SELECT COUNT(*) as count FROM eva_form1 WHERE id_member = '$id_member'";
        $result = mysqli_query($this->dbcon, $query);
        $row = mysqli_fetch_assoc($result);
        return $row['count'] > 0;
    }

    public function deletemember($id_member)
    {
        $deletemember = mysqli_query($this->dbcon, "DELETE FROM member WHERE id_member = '$id_member'");
        return $deletemember;
    }


    public function deleteManager($id_manager)
    {
        $deleteManager = mysqli_query($this->dbcon, "DELETE FROM manager WHERE id_manager = '$id_manager'");
        return $deleteManager;
    }


    // Method to count total areas
    public function countTotalMembers()
    {
        try {
            $query = "SELECT COUNT(*) AS total FROM members";
            $stmt = $this->dbcon->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$row['total']; // Ensure it returns an integer
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0; // Return 0 in case of an error
        }
    }
    public function countOwnedArea($id_manager)
    {
        // SQL query to count the number of places owned by a manager
        $query = "SELECT COUNT(*) AS area_count 
                  FROM area_info 
                  WHERE area_info.id_manager = ?";

        // Prepare the SQL statement
        $stmt = $this->dbcon->prepare($query);

        if (!$stmt) {
            // Handle error if prepare fails
            echo "Error preparing statement: " . $this->dbcon->error;
            return false;
        }

        // Bind the parameter
        if (!$stmt->bind_param("i", $id_manager)) {
            // Handle error if bind_param fails
            echo "Error binding parameters: " . $stmt->error;
            return false;
        }

        // Execute the statement
        if (!$stmt->execute()) {
            // Handle error if execute fails
            echo "Error executing statement: " . $stmt->error;
            return false;
        }

        // Get the result
        $result = $stmt->get_result();
        if (!$result) {
            // Handle error if get_result fails
            echo "Error getting result: " . $stmt->error;
            return false;
        }

        // Fetch the row
        $row = $result->fetch_assoc();
        if (!$row) {
            // Handle error if fetch_assoc fails
            echo "Error fetching result: " . $stmt->error;
            return false;
        }

        // Return the place count
        return $row['area_count'];
    }

    public function countOwnedPlaces($id_manager)
    {
        // SQL query to count the number of places owned by a manager
        $query = "SELECT COUNT(*) AS places_count 
                  FROM places_info 
                  WHERE places_info.id_manager = ?";

        // Prepare the SQL statement
        $stmt = $this->dbcon->prepare($query);

        if (!$stmt) {
            // Handle error if prepare fails
            echo "Error preparing statement: " . $this->dbcon->error;
            return false;
        }

        // Bind the parameter
        if (!$stmt->bind_param("i", $id_manager)) {
            // Handle error if bind_param fails
            echo "Error binding parameters: " . $stmt->error;
            return false;
        }

        // Execute the statement
        if (!$stmt->execute()) {
            // Handle error if execute fails
            echo "Error executing statement: " . $stmt->error;
            return false;
        }

        // Get the result
        $result = $stmt->get_result();
        if (!$result) {
            // Handle error if get_result fails
            echo "Error getting result: " . $stmt->error;
            return false;
        }

        // Fetch the row
        $row = $result->fetch_assoc();
        if (!$row) {
            // Handle error if fetch_assoc fails
            echo "Error fetching result: " . $stmt->error;
            return false;
        }

        // Return the place count
        return $row['places_count'];
    }



    //สถานที่

    public function addtypearea($name_typeArea)
    {
        $addtypearea = mysqli_query($this->dbcon, "INSERT INTO area_type_info(name_typeArea) VALUE('$name_typeArea')");
        return $addtypearea;
    }
    public function addtagplaces($tag_description)
    {
        $tag_description = mysqli_query($this->dbcon, "INSERT INTO places_tag(tag_description) VALUE('$tag_description')");
        return $tag_description;
    }
    public function tagplacesnameavailable($tag_description)
    {
        $checktagplaces = mysqli_query($this->dbcon, "SELECT tag_description FROM places_tag WHERE tag_description = '$tag_description' ");
        return $checktagplaces;
    }
    public function addtourtype($tour_type_descrip)
    {
        $addtourtype = mysqli_query($this->dbcon, "INSERT INTO tour_type(tour_type_descrip) VALUE('$tour_type_descrip')");
        return $addtourtype;
    }
    public function areaTypeavailable($name_typeArea)
    {
        $checkareaType = mysqli_query($this->dbcon, "SELECT name_typeArea FROM area_type_info WHERE name_typeArea = '$name_typeArea' ");
        return $checkareaType;
    }
    public function tourTypeavailable($tour_type_descrip)
    {
        $checktourType = mysqli_query($this->dbcon, "SELECT tour_type_descrip FROM tour_type WHERE tour_type_descrip = '$tour_type_descrip' ");
        return $checktourType;
    }
    public function addcategory($name_category)
    {
        $addcategory = mysqli_query($this->dbcon, "INSERT INTO area_category(name_category) VALUE('$name_category')");
        return $addcategory;
    }

    public function areacategoryavailable($name_category)
    {
        $checkareacategory = mysqli_query($this->dbcon, "SELECT name_category FROM area_category WHERE name_category = '$name_category' ");
        return $checkareacategory;
    }

    public function placesnameavailable($name_places)
    {
        $checkplaces = mysqli_query($this->dbcon, "SELECT name_places FROM places_info WHERE name_places = '$name_places' ");
        return $checkplaces;
    }



    public function areanameavailable($name_Area)
    {
        $checkarea = mysqli_query($this->dbcon, "SELECT name_Area FROM area_info WHERE name_Area = '$name_Area' ");
        return $checkarea;
    }

    public function addplaces(
        $tag_description,
        $name_Area,
        $name_places,
        $latitude_Places,
        $longitude_Places,
        $address_Places,
        $sub_dis_Places,
        $dis_Places,
        $provi_Places,
        $post_code,
        $details_places,
        $filename1,
        $filename2,
        $filename3,
        $filename4,
        $has_Map,
        $phonenum_places,
        $email_places,
        $url_places,
        $ontime_Mon,
        $ontime_Tue,
        $ontime_Wed,
        $ontime_Thu,
        $ontime_Fri,
        $ontime_Sat,
        $ontime_Sun,
        $closetime_Mon,
        $closetime_Tue,
        $closetime_Wed,
        $closetime_Thu,
        $closetime_Fri,
        $closetime_Sat,
        $closetime_Sun,
        $Id_manager

    ) {
        $getTagIdQuery = "SELECT id_tag FROM places_tag WHERE tag_description = '$tag_description'";
        $result = mysqli_query($this->dbcon, $getTagIdQuery);
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the id_Area from the result
            $row = mysqli_fetch_assoc($result);
            $id_tag = $row['id_tag'];

            // First, retrieve the id_Area corresponding to the selected name_Area

            // $getAreaIdQuery = "SELECT id_Area FROM area_info WHERE name_Area = '$name_Area'";
            // $result = mysqli_query($this->dbcon, $getAreaIdQuery);
            // if ($result && mysqli_num_rows($result) > 0) {
            //     // Fetch the id_Area from the result
            //     $row = mysqli_fetch_assoc($result);
            //     $id_Area = $row['id_Area'];

            // Now, insert the place with the retrieved id_Area
            $adplad = mysqli_query($this->dbcon, "INSERT INTO places_info(
                id_tag,
        id_Area,
        name_places,
        latitude_Places,
        longitude_Places,
        address_Places,
        sub_dis_Places,
        dis_Places,
        provi_Places,
        post_code,
        details_places,
        img_Places1,
        img_Places2,
        img_Places3,
        img_Places4,
        has_Map,
        phonenum_places,
        email_places,
        url_places,
        ontime_Mon,
        ontime_Tue,
        ontime_Wed,
        ontime_Thu,
        ontime_Fri,
        ontime_Sat,
        ontime_Sun,
        closetime_Mon,
        closetime_Tue,
        closetime_Wed,
        closetime_Thu,
        closetime_Fri,
        closetime_Sat,
        closetime_Sun,
        Id_manager
        ) 
        VALUES (
        '$id_tag',
        '$name_Area',
        '$name_places',
        '$latitude_Places',
        '$longitude_Places',
        '$address_Places',
        '$sub_dis_Places',
        '$dis_Places',
        '$provi_Places',
        '$post_code', 
        '$details_places',
        '$filename1',
        '$filename2',
        '$filename3',
        '$filename4',
        '$has_Map',
        '$phonenum_places',
        '$email_places',
        '$url_places',
        '$ontime_Mon',
        '$ontime_Tue',
        '$ontime_Wed',
        '$ontime_Thu',
        '$ontime_Fri',
        '$ontime_Sat',
        '$ontime_Sun',
        '$closetime_Mon',
        '$closetime_Tue',
        '$closetime_Wed',
        '$closetime_Thu',
        '$closetime_Fri',
        '$closetime_Sat',
        '$closetime_Sun',
        '$Id_manager'
        )
        ");

            return $adplad;
        } else {

            // Handle the case when the selected area is not found
            return false; // or handle the error as needed
        }
    }

    public function addplacesbyadmin(
        $tag_description,
        $name_Area,
        $name_places,
        $latitude_Places,
        $longitude_Places,
        $address_Places,
        $sub_dis_Places,
        $dis_Places,
        $provi_Places,
        $post_code,
        $details_places,
        $filename1,
        $filename2,
        $filename3,
        $filename4,
        $has_Map,
        $phonenum_places,
        $email_places,
        $url_places,
        $ontime_Mon,
        $ontime_Tue,
        $ontime_Wed,
        $ontime_Thu,
        $ontime_Fri,
        $ontime_Sat,
        $ontime_Sun,
        $closetime_Mon,
        $closetime_Tue,
        $closetime_Wed,
        $closetime_Thu,
        $closetime_Fri,
        $closetime_Sat,
        $closetime_Sun,
        $id_Admin

    ) {
        $getTagIdQuery = "SELECT id_tag FROM places_tag WHERE tag_description = '$tag_description'";
        $result = mysqli_query($this->dbcon, $getTagIdQuery);
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the id_Area from the result
            $row = mysqli_fetch_assoc($result);
            $id_tag = $row['id_tag'];

            // First, retrieve the id_Area corresponding to the selected name_Area

            // $getAreaIdQuery = "SELECT id_Area FROM area_info WHERE name_Area = '$name_Area'";
            // $result = mysqli_query($this->dbcon, $getAreaIdQuery);
            // if ($result && mysqli_num_rows($result) > 0) {
            //     // Fetch the id_Area from the result
            //     $row = mysqli_fetch_assoc($result);
            //     $id_Area = $row['id_Area'];

            // Now, insert the place with the retrieved id_Area
            $adplad = mysqli_query($this->dbcon, "INSERT INTO places_info(
                    id_tag,
            id_Area,
            name_places,
            latitude_Places,
            longitude_Places,
            address_Places,
            sub_dis_Places,
            dis_Places,
            provi_Places,
            post_code,
            details_places,
            img_Places1,
            img_Places2,
            img_Places3,
            img_Places4,
            has_Map,
            phonenum_places,
            email_places,
            url_places,
            ontime_Mon,
            ontime_Tue,
            ontime_Wed,
            ontime_Thu,
            ontime_Fri,
            ontime_Sat,
            ontime_Sun,
            closetime_Mon,
            closetime_Tue,
            closetime_Wed,
            closetime_Thu,
            closetime_Fri,
            closetime_Sat,
            closetime_Sun,
            id_Admin
            ) 
            VALUES (
            '$id_tag',
            '$name_Area',
            '$name_places',
            '$latitude_Places',
            '$longitude_Places',
            '$address_Places',
            '$sub_dis_Places',
            '$dis_Places',
            '$provi_Places',
            '$post_code', 
            '$details_places',
            '$filename1',
            '$filename2',
            '$filename3',
            '$filename4',
            '$has_Map',
            '$phonenum_places',
            '$email_places',
            '$url_places',
            '$ontime_Mon',
            '$ontime_Tue',
            '$ontime_Wed',
            '$ontime_Thu',
            '$ontime_Fri',
            '$ontime_Sat',
            '$ontime_Sun',
            '$closetime_Mon',
            '$closetime_Tue',
            '$closetime_Wed',
            '$closetime_Thu',
            '$closetime_Fri',
            '$closetime_Sat',
            '$closetime_Sun',
            '$id_Admin'
            )
            ");

            return $adplad;
        } else {

            // Handle the case when the selected area is not found
            return false; // or handle the error as needed
        }
    }


    public function addarea(
        $name_Area,
        $latitude_Area,
        $longitude_Area,
        $address_Area,
        $sub_dis_Area,
        $dis_Area,
        $provi_Area,
        $post_code,
        $info_Area,
        $activityinfo_Area,
        $tour_type_descrip1,
        $tour_type_descrip2,
        $filename1,
        $filename2,
        $filename3,
        $filename4,
        $has_map_Area,
        $phonenum_Area,
        $email_Area,
        $url_Area,
        $ontime_Mon,
        $ontime_Tue,
        $ontime_Wed,
        $ontime_Thu,
        $ontime_Fri,
        $ontime_Sat,
        $ontime_Sun,
        $closetime_Mon,
        $closetime_Tue,
        $closetime_Wed,
        $closetime_Thu,
        $closetime_Fri,
        $closetime_Sat,
        $closetime_Sun,
        $Access_Status,
        $price_in,
        $name_typeArea,
        $id_Admin

    ) {
        $getAreatypeIdQuery = "SELECT id_type_area FROM area_type_info WHERE name_typeArea = '$name_typeArea'";
        $result = mysqli_query($this->dbcon, $getAreatypeIdQuery);
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the id_type_area from the result
            $row = mysqli_fetch_assoc($result);
            $id_type_area = $row['id_type_area'];



            $getAreatourIdQuery1 = "SELECT tour_type_id FROM tour_type WHERE tour_type_descrip = '$tour_type_descrip1'";
            $result = mysqli_query($this->dbcon, $getAreatourIdQuery1);
            if ($result && mysqli_num_rows($result) > 0) {
                // Fetch the tour_type_id from the result
                $row = mysqli_fetch_assoc($result);
                $tour_Type_id_1 = $row['tour_type_id'];

                $getAreatourIdQuery2 = "SELECT tour_type_id FROM tour_type WHERE tour_type_descrip = '$tour_type_descrip2'";
                $result = mysqli_query($this->dbcon, $getAreatourIdQuery2);
                if ($result && mysqli_num_rows($result) > 0) {
                    // Fetch the tour_type_id from the result
                    $row = mysqli_fetch_assoc($result);
                    $tour_Type_id_2 = $row['tour_type_id'];




                    $addarea = mysqli_query($this->dbcon, "INSERT INTO area_info(
            name_Area, latitude_Area, longitude_Area,address_Area,sub_dis_Area,
        dis_Area,provi_Area,post_code,
    info_Area,activityinfo_Area,tour_Type_id_1,tour_Type_id_2,
    img_Area1,img_Area2,img_Area3,img_Area4,
    has_map_Area,phonenum_Area,email_Area,url_Area,
    ontime_Mon,ontime_Tue,ontime_Wed,ontime_Thu,ontime_Fri,ontime_Sat,ontime_Sun,
    closetime_Mon,closetime_Tue,closetime_Wed,closetime_Thu,closetime_Fri,closetime_Sat,closetime_Sun,
    Access_Status,
    price_in,id_type_area,id_Admin
    ) 
    VALUE(
        '$name_Area','$latitude_Area', '$longitude_Area', '$address_Area',' $sub_dis_Area','$dis_Area','$provi_Area','$post_code',
    '$info_Area','$activityinfo_Area',$tour_Type_id_1,$tour_Type_id_2,
    '$filename1','$filename2','$filename3','$filename4'
    ,'$has_map_Area','$phonenum_Area','$email_Area','$url_Area',
    '$ontime_Mon','$ontime_Tue','$ontime_Wed','$ontime_Thu','$ontime_Fri','$ontime_Sat','$ontime_Sun',
    '$closetime_Mon','$closetime_Tue','$closetime_Wed','$closetime_Thu','$closetime_Fri','$closetime_Sat','$closetime_Sun',
    '$Access_Status',
    '$price_in','$id_type_area','$id_Admin'
    )");
                    return $addarea;
                }
            }
        }
    }

    public function addareabymanager(
        $name_Area,
        $latitude_Area,
        $longitude_Area,
        $address_Area,
        $sub_dis_Area,
        $dis_Area,
        $provi_Area,
        $post_code,
        $info_Area,
        $activityinfo_Area,
        $tour_type_descrip1,
        $tour_type_descrip2,
        $filename1,
        $filename2,
        $filename3,
        $filename4,
        $has_map_Area,
        $phonenum_Area,
        $email_Area,
        $url_Area,
        $ontime_Mon,
        $ontime_Tue,
        $ontime_Wed,
        $ontime_Thu,
        $ontime_Fri,
        $ontime_Sat,
        $ontime_Sun,
        $closetime_Mon,
        $closetime_Tue,
        $closetime_Wed,
        $closetime_Thu,
        $closetime_Fri,
        $closetime_Sat,
        $closetime_Sun,
        $Access_Status,
        $price_in,
        $name_typeArea,
        $Id_manager

    ) {
        $getAreatypeIdQuery = "SELECT id_type_area FROM area_type_info WHERE name_typeArea = '$name_typeArea'";
        $result = mysqli_query($this->dbcon, $getAreatypeIdQuery);
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the id_type_area from the result
            $row = mysqli_fetch_assoc($result);
            $id_type_area = $row['id_type_area'];



            $getAreatourIdQuery1 = "SELECT tour_type_id FROM tour_type WHERE tour_type_descrip = '$tour_type_descrip1'";
            $result = mysqli_query($this->dbcon, $getAreatourIdQuery1);
            if ($result && mysqli_num_rows($result) > 0) {
                // Fetch the tour_type_id from the result
                $row = mysqli_fetch_assoc($result);
                $tour_Type_id_1 = $row['tour_type_id'];

                $getAreatourIdQuery2 = "SELECT tour_type_id FROM tour_type WHERE tour_type_descrip = '$tour_type_descrip2'";
                $result = mysqli_query($this->dbcon, $getAreatourIdQuery2);
                if ($result && mysqli_num_rows($result) > 0) {
                    // Fetch the tour_type_id from the result
                    $row = mysqli_fetch_assoc($result);
                    $tour_Type_id_2 = $row['tour_type_id'];




                    $addarea = mysqli_query($this->dbcon, "INSERT INTO area_info(
            name_Area, latitude_Area, longitude_Area,address_Area,sub_dis_Area,
        dis_Area,provi_Area,post_code,
    info_Area,activityinfo_Area,tour_Type_id_1,tour_Type_id_2,
    img_Area1,img_Area2,img_Area3,img_Area4,
    has_map_Area,phonenum_Area,email_Area,url_Area,
    ontime_Mon,ontime_Tue,ontime_Wed,ontime_Thu,ontime_Fri,ontime_Sat,ontime_Sun,
    closetime_Mon,closetime_Tue,closetime_Wed,closetime_Thu,closetime_Fri,closetime_Sat,closetime_Sun,
    Access_Status,
    price_in,id_type_area,id_Manager
    ) 
    VALUE(
        '$name_Area','$latitude_Area', '$longitude_Area', '$address_Area',' $sub_dis_Area','$dis_Area','$provi_Area','$post_code',
    '$info_Area','$activityinfo_Area',$tour_Type_id_1,$tour_Type_id_2,
    '$filename1','$filename2','$filename3','$filename4'
    ,'$has_map_Area','$phonenum_Area','$email_Area','$url_Area',
    '$ontime_Mon','$ontime_Tue','$ontime_Wed','$ontime_Thu','$ontime_Fri','$ontime_Sat','$ontime_Sun',
    '$closetime_Mon','$closetime_Tue','$closetime_Wed','$closetime_Thu','$closetime_Fri','$closetime_Sat','$closetime_Sun',
    '$Access_Status',
    '$price_in','$id_type_area','$Id_manager'
    )");
                    return $addarea;
                }
            }
        }
    }


    public function fetchdataarea()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM area_info");
        return $result;
    }

    public function fetchdataareaonerecord($id_Area)
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM area_info WHERE id_Area = '$id_Area'");
        return $result;
    }

    public function fetchdataAreaByManager($id_manager)
    {
        $sql = "SELECT * FROM area_info WHERE id_manager = '$id_manager'";
        $result = $this->dbcon->query($sql);
        return $result;
    }



    public function fetchdataareapage($start_from, $results_per_page)
    {
        $conn = $this->dbcon; // Assuming you have a method to get the DB connection
        $query = "SELECT * FROM area_info LIMIT $start_from, $results_per_page";
        return mysqli_query($conn, $query);
    }

    // Method to count total areas
    public function countTotalAreas()
    {
        $conn = $this->dbcon; // Assuming you have a method to get the DB connection
        $query = "SELECT COUNT(*) AS total FROM area_info";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total']; // Ensure it returns an integer
    }

    public function fetchdataplacespage($start_from, $results_per_page)
    {
        $conn = $this->dbcon; // Assuming you have a method to get the DB connection
        $query = "SELECT * FROM places_info LIMIT $start_from, $results_per_page";
        return mysqli_query($conn, $query);
    }

    // Method to count total places
    public function countTotalplaces()
    {
        $conn = $this->dbcon; // Assuming you have a method to get the DB connection
        $query = "SELECT COUNT(*) AS total FROM places_info";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total']; // Ensure it returns an integer
    }

    public function fetchdataType()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM area_type_info");
        return $result;
    }

    public function fetchdataTag()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM places_tag");
        return $result;
    }

    public function fetchdatacategory()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM area_category");
        return $result;
    }

    public function fetchNameTypeFromID($id_typeArea)
    {
        $query = "SELECT name_typeArea FROM area_type_info WHERE id_type_area = ?";
        $stmt = $this->dbcon->prepare($query);
        $stmt->bind_param("i", $id_typeArea);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['name_typeArea'];
    }


    public function fetchNameAreaFromID($id_Area)
    {
        $query = "SELECT name_Area FROM area_info WHERE id_Area = ?";
        $stmt = $this->dbcon->prepare($query);
        $stmt->bind_param("i", $id_Area);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['name_Area'];
    }




    public function fetchdataTypetour()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM tour_type");
        return $result;
    }


    public function fetchdataplaces()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM places_info");
        return $result;
    }

    public function fetchdataowner($id_manager)
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM places_info WHERE id_manager='$id_manager'");
        return $result;
    }

    public function fetchonerecord($id_places)
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM places_info WHERE id_places = '$id_places' ");
        return $result;
    }

    public function fetchonerecordArea($id_Area)
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM area_info WHERE id_Area = '$id_Area' ");
        return $result;
    }


    public function getAreaName($id_Area)
    {
        $query = "SELECT name_Area FROM area_info WHERE id_Area = '$id_Area'";
        $result = mysqli_query($this->dbcon, $query);
        return $result;
    }



    public function updateplaces(
        $tag_description,
        $name_Area,
        $name_places,
        $latitude_Places,
        $longitude_Places,
        $address_Places,
        $sub_dis_Places,
        $dis_Places,
        $provi_Places,
        $post_code,
        $details_places,
        $filename1,
        $filename2,
        $filename3,
        $filename4,
        $has_Map,
        $phonenum_places,
        $email_places,
        $url_places,
        $ontime_Mon,
        $ontime_Tue,
        $ontime_Wed,
        $ontime_Thu,
        $ontime_Fri,
        $ontime_Sat,
        $ontime_Sun,
        $closetime_Mon,
        $closetime_Tue,
        $closetime_Wed,
        $closetime_Thu,
        $closetime_Fri,
        $closetime_Sat,
        $closetime_Sun,
        $Id_manager,
        $id_places
    ) {

        $updateQuery = "UPDATE places_info SET
                            id_tag = '$tag_description', 
                            id_Area = '$name_Area',
                            name_places = '$name_places',
                            latitude_Places = '$latitude_Places',
                            longitude_Places = '$longitude_Places',
                            address_Places = '$address_Places',
                            sub_dis_Places = '$sub_dis_Places',
                            dis_Places = '$dis_Places',
                            provi_Places = '$provi_Places',
                            post_code = '$post_code',
                            details_places = '$details_places',
                            img_Places1 = '$filename1',
                            img_Places2 = '$filename2',
                            img_Places3 = '$filename3',
                            img_Places4 = '$filename4',
                            has_Map = '$has_Map',
                            phonenum_places = '$phonenum_places',
                            email_places = '$email_places',
                            url_places = '$url_places',
                            ontime_Mon = '$ontime_Mon',
                            ontime_Tue = '$ontime_Tue',
                            ontime_Wed = '$ontime_Wed',
                            ontime_Thu = '$ontime_Thu',
                            ontime_Fri = '$ontime_Fri',
                            ontime_Sat = '$ontime_Sat',
                            ontime_Sun = '$ontime_Sun',
                            closetime_Mon = '$closetime_Mon',
                            closetime_Tue = '$closetime_Tue',
                            closetime_Wed = '$closetime_Wed',
                            closetime_Thu = '$closetime_Thu',
                            closetime_Fri = '$closetime_Fri',
                            closetime_Sat = '$closetime_Sat',
                            closetime_Sun = '$closetime_Sun',
                            Id_manager = '$Id_manager'
                            WHERE id_places = '$id_places'";

        $result = mysqli_query($this->dbcon, $updateQuery);
        if ($result) {
            return true;
        } else {
            // Error occurred during the update
            die('Error: ' . mysqli_error($this->dbcon));
        }
    }

    public function updateplacesbyAD(
        $tag_description,
        $name_Area,
        $name_places,
        $latitude_Places,
        $longitude_Places,
        $address_Places,
        $sub_dis_Places,
        $dis_Places,
        $provi_Places,
        $post_code,
        $details_places,
        $filename1,
        $filename2,
        $filename3,
        $filename4,
        $has_Map,
        $phonenum_places,
        $email_places,
        $url_places,
        $ontime_Mon,
        $ontime_Tue,
        $ontime_Wed,
        $ontime_Thu,
        $ontime_Fri,
        $ontime_Sat,
        $ontime_Sun,
        $closetime_Mon,
        $closetime_Tue,
        $closetime_Wed,
        $closetime_Thu,
        $closetime_Fri,
        $closetime_Sat,
        $closetime_Sun,
        $id_Admin,
        $id_places
    ) {

        $updateQuery = "UPDATE places_info SET
                            id_tag = '$tag_description', 
                            id_Area = '$name_Area',
                            name_places = '$name_places',
                            latitude_Places = '$latitude_Places',
                            longitude_Places = '$longitude_Places',
                            address_Places = '$address_Places',
                            sub_dis_Places = '$sub_dis_Places',
                            dis_Places = '$dis_Places',
                            provi_Places = '$provi_Places',
                            post_code = '$post_code',
                            details_places = '$details_places',
                            img_Places1 = '$filename1',
                            img_Places2 = '$filename2',
                            img_Places3 = '$filename3',
                            img_Places4 = '$filename4',
                            has_Map = '$has_Map',
                            phonenum_places = '$phonenum_places',
                            email_places = '$email_places',
                            url_places = '$url_places',
                            ontime_Mon = '$ontime_Mon',
                            ontime_Tue = '$ontime_Tue',
                            ontime_Wed = '$ontime_Wed',
                            ontime_Thu = '$ontime_Thu',
                            ontime_Fri = '$ontime_Fri',
                            ontime_Sat = '$ontime_Sat',
                            ontime_Sun = '$ontime_Sun',
                            closetime_Mon = '$closetime_Mon',
                            closetime_Tue = '$closetime_Tue',
                            closetime_Wed = '$closetime_Wed',
                            closetime_Thu = '$closetime_Thu',
                            closetime_Fri = '$closetime_Fri',
                            closetime_Sat = '$closetime_Sat',
                            closetime_Sun = '$closetime_Sun',
                            id_Admin = '$id_Admin'
                            WHERE id_places = '$id_places'";

        $result = mysqli_query($this->dbcon, $updateQuery);
        if ($result) {
            return true;
        } else {
            // Error occurred during the update
            die('Error: ' . mysqli_error($this->dbcon));
        }
    }


    public function deleteplaces($id_places)
    {
        $deleteplaces = mysqli_query($this->dbcon, "DELETE FROM places_info WHERE id_places = '$id_places'");
        return $deleteplaces;
    }

    public function updateArea(
        $name_Area,
        $latitude_Area,
        $longitude_Area,
        $address_Area,
        $sub_dis_Area,
        $dis_Area,
        $provi_Area,
        $post_code,
        $info_Area,
        $activityinfo_Area,
        $tour_type_descrip1,
        $tour_type_descrip2,
        $filename1,
        $filename2,
        $filename3,
        $filename4,
        $has_map_Area,
        $phonenum_Area,
        $email_Area,
        $url_Area,
        $ontime_Mon,
        $ontime_Tue,
        $ontime_Wed,
        $ontime_Thu,
        $ontime_Fri,
        $ontime_Sat,
        $ontime_Sun,
        $closetime_Mon,
        $closetime_Tue,
        $closetime_Wed,
        $closetime_Thu,
        $closetime_Fri,
        $closetime_Sat,
        $closetime_Sun,
        $Access_Status,
        $price_in,
        $name_typeArea,
        $id_Admin,
        $id_Area
    ) {
        $result = mysqli_query($this->dbcon, "UPDATE area_info SET 
                    name_Area = '$name_Area',
                    latitude_Area = '$latitude_Area',
                    longitude_Area = '$longitude_Area',
                    address_Area = '$address_Area',
                    sub_dis_Area = '$sub_dis_Area',
                    dis_Area = '$dis_Area',
                    provi_Area = '$provi_Area',
                    post_code = '$post_code',
                    info_Area = '$info_Area',
                    activityinfo_Area = '$activityinfo_Area',
                    tour_Type_id_1 = '$tour_type_descrip1',
                    tour_Type_id_2 = '$tour_type_descrip2',
                    img_Area1 = '$filename1',
                    img_Area2 = '$filename2',
                    img_Area3 = '$filename3',
                    img_Area4 = '$filename4',
                    has_map_Area = '$has_map_Area',
                    phonenum_Area = '$phonenum_Area',
                    email_Area = '$email_Area',
                    url_Area = '$url_Area',
                    ontime_Mon = '$ontime_Mon',
                    ontime_Tue = '$ontime_Tue',
                    ontime_Wed = '$ontime_Wed',
                    ontime_Thu = '$ontime_Thu',
                    ontime_Fri = '$ontime_Fri',
                    ontime_Sat = '$ontime_Sat',
                    ontime_Sun = '$ontime_Sun',
                    closetime_Mon = '$closetime_Mon',
                    closetime_Tue = '$closetime_Tue',
                    closetime_Wed = '$closetime_Wed',
                    closetime_Thu = '$closetime_Thu',
                    closetime_Fri = '$closetime_Fri',
                    closetime_Sat = '$closetime_Sat',
                    closetime_Sun = '$closetime_Sun',
                    Access_Status = '$Access_Status',
                    price_in = '$price_in',
                    id_type_area = '$name_typeArea',
                    id_Admin = '$id_Admin'
                    WHERE id_Area = '$id_Area'
                    ");
        return $result;
    }

    public function updateAreabymanager(
        $name_Area,
        $latitude_Area,
        $longitude_Area,
        $address_Area,
        $sub_dis_Area,
        $dis_Area,
        $provi_Area,
        $post_code,
        $info_Area,
        $activityinfo_Area,
        $tour_type_descrip1,
        $tour_type_descrip2,
        $filename1,
        $filename2,
        $filename3,
        $filename4,
        $has_map_Area,
        $phonenum_Area,
        $email_Area,
        $url_Area,
        $ontime_Mon,
        $ontime_Tue,
        $ontime_Wed,
        $ontime_Thu,
        $ontime_Fri,
        $ontime_Sat,
        $ontime_Sun,
        $closetime_Mon,
        $closetime_Tue,
        $closetime_Wed,
        $closetime_Thu,
        $closetime_Fri,
        $closetime_Sat,
        $closetime_Sun,
        $Access_Status,
        $price_in,
        $name_typeArea,
        $Id_manager,
        $id_Area
    ) {
        $result = mysqli_query($this->dbcon, "UPDATE area_info SET 
                    name_Area = '$name_Area',
                    latitude_Area = '$latitude_Area',
                    longitude_Area = '$longitude_Area',
                    address_Area = '$address_Area',
                    sub_dis_Area = '$sub_dis_Area',
                    dis_Area = '$dis_Area',
                    provi_Area = '$provi_Area',
                    post_code = '$post_code',
                    info_Area = '$info_Area',
                    activityinfo_Area = '$activityinfo_Area',
                    tour_Type_id_1 = '$tour_type_descrip1',
                    tour_Type_id_2 = '$tour_type_descrip2',
                    img_Area1 = '$filename1',
                    img_Area2 = '$filename2',
                    img_Area3 = '$filename3',
                    img_Area4 = '$filename4',
                    has_map_Area = '$has_map_Area',
                    phonenum_Area = '$phonenum_Area',
                    email_Area = '$email_Area',
                    url_Area = '$url_Area',
                    ontime_Mon = '$ontime_Mon',
                    ontime_Tue = '$ontime_Tue',
                    ontime_Wed = '$ontime_Wed',
                    ontime_Thu = '$ontime_Thu',
                    ontime_Fri = '$ontime_Fri',
                    ontime_Sat = '$ontime_Sat',
                    ontime_Sun = '$ontime_Sun',
                    closetime_Mon = '$closetime_Mon',
                    closetime_Tue = '$closetime_Tue',
                    closetime_Wed = '$closetime_Wed',
                    closetime_Thu = '$closetime_Thu',
                    closetime_Fri = '$closetime_Fri',
                    closetime_Sat = '$closetime_Sat',
                    closetime_Sun = '$closetime_Sun',
                    Access_Status = '$Access_Status',
                    price_in = '$price_in',
                    id_type_area = '$name_typeArea',
                    Id_manager = '$Id_manager'
                    WHERE id_Area = '$id_Area'
                    ");
        return $result;
    }






    public function deleteArea($id_Area)
    {
        $deleteArea = mysqli_query($this->dbcon, "DELETE FROM area_info WHERE id_Area = '$id_Area'");
        return $deleteArea;
    }
    public function deleteareaType($id_type_area)
    {
        $deleteareaType = mysqli_query($this->dbcon, "DELETE FROM area_type_info WHERE id_type_area = '$id_type_area'");
        return $deleteareaType;
    }
    public function deleteTagplaces($id_tag)
    {
        $deleteTagplaces = mysqli_query($this->dbcon, "DELETE FROM places_tag WHERE id_tag = '$id_tag'");
        return $deleteTagplaces;
    }
    public function deletetourType($tour_type_id)
    {
        $deletetourType = mysqli_query($this->dbcon, "DELETE FROM tour_type WHERE tour_type_id = '$tour_type_id'");
        return $deletetourType;
    }

    public function deleteareacategory($id_category)
    {
        $deleteareacategory = mysqli_query($this->dbcon, "DELETE FROM area_category WHERE id_category = '$id_category'");
        return $deleteareacategory;
    }

    //=================เกี่ยวกับเเบบสอบถาม=================================================================================================
    public function fetchDataFormMembers()
    {
        $query = "
        SELECT ans_interest.id_member, member.username, member.email, member.phone
        FROM ans_interest
        INNER JOIN member ON ans_interest.id_member = member.id_member
    ";

        $result = mysqli_query($this->dbcon, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($this->dbcon));
        }

        return $result;
    }

    public function fetchdataformmember2()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM form_member2");
        return $result;
    }

    public function fetchDataFormMemberspage($start_from, $results_per_page)
    {
        $sql = "
        SELECT ans_interest.id_member, member.username, member.email, member.phone
        FROM ans_interest
        INNER JOIN member ON ans_interest.id_member = member.id_member
        LIMIT $start_from, $results_per_page
    ";
        $result = mysqli_query($this->dbcon, $sql);
        return $result;
    }

    public function countTotalFormMembers()
    {
        $conn = $this->dbcon;
        $query = "SELECT COUNT(*) AS total FROM ans_interest";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total'];
    }


    public function fetchAnswers($id_member)
    {
        // Prepare the SQL statement
        $stmt = $this->dbcon->prepare("
            SELECT ans1, ans2, ans3, ans4, ans5, ans6, ans7, ans8
            FROM ans_interest 
            WHERE id_member = ?
        ");

        // Check for prepare errors
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->dbcon->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $id_member);

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // Get the result
        $result = $stmt->get_result();

        // Check for result errors
        if ($result === false) {
            throw new Exception("Query failed: " . $this->dbcon->error);
        }

        // Close the statement
        $stmt->close();

        return $result;  // Return the mysqli_result object
    }

    public function getAnswerDescription($column, $value)
    {
        $descriptions = [
            'ans1' => 'แหล่งท่องเที่ยวเชิงนิเวศ/ธรรมชาติ (เช่น อุทยานแห่งชาติภูซาง, อุทยานแห่งชาติแม่ปืม)',
            'ans2' => 'แหล่งท่องเที่ยวเชิงอาหาร (เช่น บ้านตะวัน กว๊านพะเยา, เฮือนไทลื้อแม่แสงดา)',
            'ans3' => 'แหล่งท่องเที่ยวเชิงเทศกาล/งานประเพณี (เช่น ธุมะสิกขีศรีจอมทอง, วัดศรีโคมคำ)',
            'ans4' => 'แหล่งท่องเที่ยวเชิงเกษตร (เช่น ไร่องุ่นภูกลองฮิลล์)',
            'ans5' => 'แหล่งท่องเที่ยววัฒนธรรม/วิถีชีวิต (เช่น ศูนย์วัฒนธรรมไทลื้อ, ท่าเรือโบราณบ้านทุ่งกิ่ว)',
            'ans6' => 'แหล่งท่องเที่ยวเชิงผจญภัย (เช่น ถ้ำใหญ่ผาตั้ง, ฝั่งต้า, บ่อสิบสอง)',
            'ans7' => 'แหล่งท่องเที่ยวเชิงสุขภาพ (เช่น หมู่บ้านหนองหล่ม)',
            'ans8' => 'แหล่งท่องเที่ยวเชิงศาสนา (เช่น วัดอนาลโยทิพยาราม, ศรีอุโมงค์คำ)'
        ];

        return isset($descriptions[$column]) && $value == 1 ? $descriptions[$column] : '';
    }


    //=======================================Form 2 ==================================================

    public function fetchAnswers2($id_member)
    {
        // ตรวจสอบว่าการเตรียมคำสั่งทำงานได้หรือไม่
        $stmt = $this->dbcon->prepare("
            SELECT ans_form1, ans_form2, ans_form3, ans_form4
            FROM form_member 
            WHERE id_member = ?
        ");

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->dbcon->error);
        }

        $stmt->bind_param("i", $id_member);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Query failed: " . $this->dbcon->error);
        }

        return $result;
    }


    public function getAnswerDescription2($column, $value)
    {

        // คำอธิบายเฉพาะกลุ่มอื่น ๆ
        $specificDescriptions = [
            'ans_form1' => [
                1 => 'ชาย',
                2 => 'หญิง',
                3 => 'LGBTQ+',
                4 => 'ไม่ต้องการระบุ'
            ],
            'ans_form2' => [
                1 => '12-18 ปี',
                2 => '19-40 ปี',
                3 => '41-60 ปี',
                4 => 'มากกว่า 60 ปี'
            ],
            'ans_form3' => [
                1 => 'เจ้าของกิจการ',
                2 => 'ข้าราชการ',
                3 => 'พนักงานบริษัท',
                4 => 'พนักงานเอกชน',
                5 => 'นักเรียน/นักศึกษา',
                6 => 'อื่นๆ'
            ],
            'ans_form4' => [
                1 => 'ต่ำกว่า 5,000 บาท',
                2 => '5,001 - 10,000 บาท',
                3 => '10,001 - 20,000 บาท',
                4 => '20,001 - 30,000 บาท',
                5 => '30,001 - 40,000 บาท',
                6 => '40,001 บาทขึ้นไป'
            ]
        ];

        // ส่งคืนคำอธิบายที่ตรงกับคอลัมน์และค่า
        return $specificDescriptions[$column][$value] ?? '';
    }



    public function fetchonerecordFormMembers2($id_member)
    {
        $stmt = $this->dbcon->prepare("SELECT * FROM form_member WHERE id_member = ?");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->dbcon->error);
        }

        $stmt->bind_param("i", $id_member);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Query failed: " . $this->dbcon->error);
        }

        return $result;
    }

    //=======================================Form 3 ==================================================

    public function fetchAnswers3($id_member)
    {
        $stmt = $this->dbcon->prepare("
            SELECT eva_p1_ans1, eva_p1_ans2, eva_p1_ans3, eva_p1_ans4, eva_p1_ans5, eva_p1_ans6, eva_p1_ans7, eva_p1_ans8, eva_p1_ans9
            FROM eva_form1 
            WHERE id_member = ?
        ");

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->dbcon->error);
        }

        $stmt->bind_param("i", $id_member);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Query failed: " . $this->dbcon->error);
        }

        return $result;
    }

    public function getAnswerDescription3($column, $value)
    {
        // คำอธิบายทั่วไปสำหรับระดับความเห็น
        $generalDescriptions = [
            1 => '" 1 " เห็นด้วยน้อยที่สุด',
            2 => '" 2 " เห็นด้วยน้อย',
            3 => '" 3 " เห็นด้วยปานกลาง',
            4 => '" 4 " เห็นด้วยมาก',
            5 => '" 5 " เห็นด้วยมากที่สุด'
        ];

        // คำอธิบายสำหรับแต่ละคอลัมน์
        $specificDescriptions = [
            'eva_p1_ans1' => $generalDescriptions,
            'eva_p1_ans2' => $generalDescriptions,
            'eva_p1_ans3' => $generalDescriptions,
            'eva_p1_ans4' => $generalDescriptions,
            'eva_p1_ans5' => $generalDescriptions,
            'eva_p1_ans6' => $generalDescriptions,
            'eva_p1_ans7' => $generalDescriptions,
            'eva_p1_ans8' => $generalDescriptions,
            'eva_p1_ans9' => $generalDescriptions,
        ];

        // ส่งคืนคำอธิบายที่ตรงกับคอลัมน์และค่า
        return $specificDescriptions[$column][$value] ?? '';
    }


    // Remove this function if it serves the same purpose as fetchAnswers3
    public function fetchonerecordFormMembers3($id_member)
    {
        $stmt = $this->dbcon->prepare("SELECT * FROM eva_form1 WHERE id_member = ?");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->dbcon->error);
        }

        $stmt->bind_param("i", $id_member);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Query failed: " . $this->dbcon->error);
        }

        return $result;
    }

    //=======================================Form 3 ==================================================

    public function fetchAnswers4($id_member)
    {
        $stmt = $this->dbcon->prepare("
        SELECT eva_p2_ans1, eva_p2_ans2, eva_p2_ans3, eva_p2_ans4, eva_p2_ans5, eva_p2_ans6, eva_p2_ans7, eva_p2_ans8, eva_p2_ans9,
               eva_p2_ans10, eva_p2_ans11, eva_p2_ans12, eva_p2_ans13, eva_p2_ans14, eva_p2_ans15, eva_p2_ans16, eva_p2_ans17, eva_p2_ans18, eva_p2_ans19
        FROM eva_form2 
        WHERE id_member = ?
    ");

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->dbcon->error);
        }

        $stmt->bind_param("i", $id_member);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Query failed: " . $this->dbcon->error);
        }

        return $result;
    }

    public function getAnswerDescription4($column, $value)
    {
        // คำอธิบายทั่วไปสำหรับระดับความเห็น
        $generalDescriptions = [
            1 => '" 1 " เห็นด้วยน้อยที่สุด',
            2 => '" 2 " เห็นด้วยน้อย',
            3 => '" 3 " เห็นด้วยปานกลาง',
            4 => '" 4 " เห็นด้วยมาก',
            5 => '" 5 " เห็นด้วยมากที่สุด'
        ];

        // คำอธิบายที่ใช้ร่วมกัน
        $commonKeys = [
            'eva_p2_ans1',
            'eva_p2_ans2',
            'eva_p2_ans3',
            'eva_p2_ans4',
            'eva_p2_ans5',
            'eva_p2_ans6',
            'eva_p2_ans7',
            'eva_p2_ans8',
            'eva_p2_ans9',
            'eva_p2_ans10',
            'eva_p2_ans11',
            'eva_p2_ans12',
            'eva_p2_ans13',
            'eva_p2_ans14',
            'eva_p2_ans15',
            'eva_p2_ans16',
            'eva_p2_ans17',
            'eva_p2_ans18',
            'eva_p2_ans19'
        ];

        // สร้าง array ของคำอธิบายสำหรับคีย์ที่ใช้ร่วมกัน
        $commonDescriptions = array_fill_keys($commonKeys, $generalDescriptions);

        // ส่งคืนคำอธิบายที่ตรงกับคอลัมน์และค่า
        return $commonDescriptions[$column][$value] ?? '';
    }

    // Remove this function if it serves the same purpose as fetchAnswers4
    public function fetchonerecordFormMembers4($id_member)
    {
        $stmt = $this->dbcon->prepare("SELECT * FROM eva_form2 WHERE id_member = ?");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->dbcon->error);
        }

        $stmt->bind_param("i", $id_member);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Query failed: " . $this->dbcon->error);
        }

        return $result;
    }

    public function fetchAnswers5($id_member)
    {
        // ตรวจสอบว่าการเตรียมคำสั่งทำงานได้หรือไม่
        $stmt = $this->dbcon->prepare("
            SELECT ans_form5, ans_form6, ans_form7, ans_form8
            FROM form_member 
            WHERE id_member = ?
        ");

        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->dbcon->error);
        }

        $stmt->bind_param("i", $id_member);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Query failed: " . $this->dbcon->error);
        }

        return $result;
    }


    public function getAnswerDescription5($column, $value)
    {

        // คำอธิบายเฉพาะกลุ่มอื่น ๆ
        $specificDescriptions = [

            'ans_form5' => [
                1 => 'คนเดียว',
                2 => 'คนรัก',
                3 => 'เพื่อน',
                4 => 'ครอบครัว'
            ],
            'ans_form6' => [
                1 => 'รถยนต์',
                2 => 'รถสาธารณะ',
                3 => 'รถจักยานยนต์',
                4 => 'เช่ารถ',
                5 => 'อื่นๆ'
            ],
            'ans_form7' => [
                1 => 'โรงแรม',
                2 => 'วนอุทยาน',
                3 => 'รีสอร์ท',
                4 => 'โฮมสเตย์',
                5 => 'บ้านพักส่วนตัว',
                6 => 'อื่นๆ'
            ],
            'ans_form8' => [
                1 => 'น้อยกว่า 1,000 บาท',
                2 => '1,001 - 2,000 บาท',
                3 => '2,001 - 3,000 บาท',
                4 => '3,001 - 4,000 บาท',
                5 => '4,001 บาทขึ้นไป'
            ],
        ];

        // ส่งคืนคำอธิบายที่ตรงกับคอลัมน์และค่า
        return $specificDescriptions[$column][$value] ?? '';
    }



    public function fetchonerecordFormMembers5($id_member)
    {
        $stmt = $this->dbcon->prepare("SELECT * FROM form_member WHERE id_member = ?");
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->dbcon->error);
        }

        $stmt->bind_param("i", $id_member);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result === false) {
            throw new Exception("Query failed: " . $this->dbcon->error);
        }

        return $result;
    }




    public function deleteFormMembers1($id_member)
    {
        $deleteFormMembers1 = mysqli_query($this->dbcon, "DELETE FROM ans_interest WHERE id_member = '$id_member'");
        return $deleteFormMembers1;
    }

    public function deleteFormMembers2($id_member)
    {
        $deleteFormMembers2 = mysqli_query($this->dbcon, "DELETE FROM form_member WHERE id_member = '$id_member'");
        return $deleteFormMembers2;
    }
    public function deleteFormMembers3($id_member)
    {
        $deleteFormMembers3 = mysqli_query($this->dbcon, "DELETE FROM eva_form1 WHERE id_member = '$id_member'");
        return $deleteFormMembers3;
    }
    public function deleteFormMembers4($id_member)
    {
        $deleteFormMembers4 = mysqli_query($this->dbcon, "DELETE FROM eva_form2 WHERE id_member = '$id_member'");
        return $deleteFormMembers4;
    }

    ////////////////////////Form_Motivation///////////////

    public function fetchDataFormMotivation()
    {
        $query = "
        SELECT area_category_form.id_member, member.username, member.email, member.phone
        FROM area_category_form
        INNER JOIN member ON area_category_form.id_member = member.id_member
    ";

        $result = mysqli_query($this->dbcon, $query);

        if (!$result) {
            // จัดการข้อผิดพลาด
            die("Query failed: " . mysqli_error($this->dbcon));
        }

        return $result;
    }

    public function fetchdataformMotivation2()
    {
        $result = mysqli_query($this->dbcon, "SELECT * FROM area_category_form");
        return $result;
    }

    public function fetchDataFormMotivationpage($start_from, $results_per_page)
    {
        $conn = $this->dbcon; // Assuming you have a method to get the DB connection
        $query = "SELECT * FROM area_category_form LIMIT $start_from, $results_per_page";
        return mysqli_query($conn, $query);
    }

    // Method to count total areas
    public function countTotalFormMotivation()
    {
        $conn = $this->dbcon; // Assuming you have a method to get the DB connection
        $query = "SELECT COUNT(*) AS total FROM area_category_form";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        return (int)$row['total']; // Ensure it returns an integer
    }


    public function fetchAnswersMotivation($id_member)
    {
        // Prepare the SQL statement
        $stmt = $this->dbcon->prepare("
            SELECT *
            FROM area_category_form 
            WHERE id_member = ?
        ");

        // Check for prepare errors
        if ($stmt === false) {
            throw new Exception("Prepare failed: " . $this->dbcon->error);
        }

        // Bind the parameter
        $stmt->bind_param("i", $id_member);

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // Get the result
        $result = $stmt->get_result();

        // Check for result errors
        if ($result === false) {
            throw new Exception("Query failed: " . $this->dbcon->error);
        }

        // Close the statement
        $stmt->close();

        return $result;  // Return the mysqli_result object
    }

    public function getAnswerMotivationDescription($column, $value)
    {
        $descriptions = [
            1 => 'แหล่งท่องเที่ยวเชิงนิเวศ/ธรรมชาติ',
            2 => 'แหล่งท่องเที่ยวเชิงอาหาร',
            3 => 'แหล่งท่องเที่ยวเชิงเทศกาล/งานประเพณี',
            4 => 'แหล่งท่องเที่ยวเชิงเกษตร',
            5 => 'แหล่งท่องเที่ยววัฒนธรรม/วิถีชีวิต',
            6 => 'แหล่งท่องเที่ยวเชิงผจญภัย',
            7 => 'แหล่งท่องเที่ยวเชิงสุขภาพ',
            8 => 'แหล่งท่องเที่ยวเชิงศาสนา'
        ];

        if (isset($value)) {
            return isset($descriptions[$value]) ? $descriptions[$value] : 'ไม่ได้ถูกตอบไว้ในแบบสอบถาม';
        } else {
            return 'ไม่ได้ถูกตอบไว้ในแบบสอบถาม';
        }
    }

    public function deleteFormMotivation($id_member)
    {
        $deleteFormMotivation = mysqli_query($this->dbcon, "DELETE FROM area_category_form WHERE id_member = '$id_member'");
        return $deleteFormMotivation;
    }

    //============================================================================================================
    // Function to calculate the Euclidean distance
    function calculateDistance($answers, $cluster)
    {
        $distance = 0;
        foreach ($answers as $i => $answer) {
            $distance += pow($answer - $cluster[$i], 2);
        }
        return sqrt($distance);
    }

    // Function to find the nearest cluster
    function findNearestCluster($newAnswers, $clusters)
    {
        $minDistance = PHP_INT_MAX;
        $nearestCluster = -1;
        foreach ($clusters as $clusterId => $cluster) {
            $distance = calculateDistance($newAnswers, $cluster);
            if ($distance < $minDistance) {
                $minDistance = $distance;
                $nearestCluster = $clusterId;
            }
        }
        return $nearestCluster;
    }

    public function fetchCommentsByArea($id_Area)
    {
        $query = "SELECT c.comment_details, c.star, c.date, m.username, c.id_comment
                  FROM comment c
                  JOIN member m ON c.id_member = m.id_member
                  WHERE c.id_Area = ?";

        $stmt = $this->dbcon->prepare($query);

        if (!$stmt) {
            // Error preparing the statement
            die("Error preparing the statement: " . $this->dbcon->error);
        }

        $stmt->bind_param("i", $id_Area);
        $stmt->execute();
        return $stmt->get_result();
    }



    public function fetchUsernameById($id_member)
    {
        $getinfo = mysqli_query($this->dbcon, "SELECT username FROM member WHERE id_member = '$id_member' ");
        return $getinfo;
    }

    // Method to fetch total views for an area
    public function getTotalViews($id_Area)
    {
        $query = "SELECT total_views FROM area_info WHERE id_Area = ?";
        $stmt = $this->dbcon->prepare($query);
        $stmt->bind_param("i", $id_Area);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total_views'] ?? 0;
    }

    // Method to count number of likes for an area
    public function getNumberOfLikes($id_Area)
    {
        $query = "SELECT COUNT(*) as likes FROM favorit_places WHERE id_Area = ?";
        $stmt = $this->dbcon->prepare($query);
        $stmt->bind_param("i", $id_Area);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['likes'] ?? 0;
    }

    // Method to calculate average rating for an area
    public function getAverageRating($id_Area)
    {
        $query = "SELECT AVG(star) as avg_rating FROM comment WHERE id_Area = ?";
        $stmt = $this->dbcon->prepare($query);
        $stmt->bind_param("i", $id_Area);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['avg_rating'] ?? 0;
    }

    public function deleteCommentArea($id_comment)
    {
        $deleteCommentArea = mysqli_query($this->dbcon, "DELETE FROM comment WHERE id_comment = '$id_comment'");
        return $deleteCommentArea;
    }


    public function fetchCommentsByPlaces($id_places)
    {
        $query = "SELECT c.detail_comment, c.star, c.date, m.username, c.id_comment_p 
                  FROM comment_places c
                  JOIN member m ON c.id_member = m.id_member
                  WHERE c.id_places = ?";

        $stmt = $this->dbcon->prepare($query);

        if (!$stmt) {
            // Error preparing the statement
            die("Error preparing the statement: " . $this->dbcon->error);
        }

        $stmt->bind_param("i", $id_places);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getTotalViewsplaces($id_places)
    {
        $query = "SELECT total_views FROM places_info WHERE id_places = ?";
        $stmt = $this->dbcon->prepare($query);
        $stmt->bind_param("i", $id_places);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total_views'] ?? 0;
    }

    public function getAverageRatingplaces($id_places)
    {
        $query = "SELECT AVG(star) as avg_rating FROM comment_places WHERE id_places = ?";
        $stmt = $this->dbcon->prepare($query);
        $stmt->bind_param("i", $id_places);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['avg_rating'] ?? 0;
    }

    public function deleteCommentPlaces($id_comment_p)
    {
        $id_comment_p = mysqli_real_escape_string($this->dbcon, $id_comment_p);
        $deleteCommentPlaces = mysqli_query($this->dbcon, "DELETE FROM comment_places WHERE id_comment_p = '$id_comment_p'");
        return $deleteCommentPlaces;
    }

    /////////////////////////Recommend system////////////////////////////////////////////////////////////////


    public function fetchUpdateTimes()
    {
        $query = "SELECT DISTINCT id_update_cluster FROM cluster_value ORDER BY id_update_cluster DESC"; // Adjust as necessary
        $stmt = mysqli_prepare($this->dbcon, $query);

        if (!$stmt) {
            echo "Failed to prepare statement: " . mysqli_error($this->dbcon);
            exit();
        }

        if (!mysqli_stmt_execute($stmt)) {
            echo "Failed to execute statement: " . mysqli_stmt_error($stmt);
            exit();
        }

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            echo "Failed to get result: " . mysqli_error($this->dbcon);
            exit();
        }

        return $result;
    }


    public function fetchvaluecluster($updateId = null)
    {
        // If no updateId is provided, fetch the latest id_update_cluster
        if (!$updateId) {
            $query = "SELECT id_update_cluster FROM cluster_value ORDER BY day_update DESC LIMIT 1";
            $stmt = mysqli_prepare($this->dbcon, $query);

            if (!$stmt) {
                echo "Failed to prepare statement: " . mysqli_error($this->dbcon);
                exit();
            }

            if (!mysqli_stmt_execute($stmt)) {
                echo "Failed to execute statement: " . mysqli_stmt_error($stmt);
                exit();
            }

            $result = mysqli_stmt_get_result($stmt);

            if (!$result) {
                echo "Failed to get result: " . mysqli_error($this->dbcon);
                exit();
            }

            $row = mysqli_fetch_assoc($result);
            $updateId = $row['id_update_cluster'];
        }

        // Fetch data for the specified or latest id_update_cluster
        $query = "SELECT * FROM cluster_value WHERE id_update_cluster = ?";
        $stmt = mysqli_prepare($this->dbcon, $query);

        if (!$stmt) {
            echo "Failed to prepare statement: " . mysqli_error($this->dbcon);
            exit();
        }

        mysqli_stmt_bind_param($stmt, "i", $updateId);

        if (!mysqli_stmt_execute($stmt)) {
            echo "Failed to execute statement: " . mysqli_stmt_error($stmt);
            exit();
        }

        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            echo "Failed to get result: " . mysqli_error($this->dbcon);
            exit();
        }

        return $result;
    }




    public function getClusterRecommendations()
    {
        $sql = "SELECT id_cluster, activity_cluster, group_cluster_dis FROM summarize_cluster";
        $result = $this->dbcon->query($sql);
        $recommendations = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cluster = $row['id_cluster'];
                $activities = explode(',', $row['activity_cluster']); // Assuming activities are comma-separated
                $attractions = explode(',', $row['group_cluster_dis']); // Assuming attractions are comma-separated
                $recommendations[$cluster] = [
                    "กิจกรรม" => $activities,
                    "แหล่งท่องเที่ยว" => $attractions
                ];
            }
        }
        return $recommendations;
    }


    public function displayClusterResults($clusters, $customK)
    {
        $clusterHtml = '<h2>ผลการจัดกลุ่ม K = ' . $customK . '</h2>';
        $clusterHtml .= '<table class="table table-bordered" style="font-size: 10px;" id="clusterTable">';
        $clusterHtml .= '<thead><tr style="background-color: #ffcc00;"><th>ID Cluster</th>';
        for ($i = 1; $i <= 20; $i++) {
            $clusterHtml .= '<th>Value' . $i . '</th>';
        }
        $clusterHtml .= '</tr></thead><tbody>';

        foreach ($clusters as $clusterId => $clusterValues) {
            $clusterHtml .= '<tr>';
            $clusterHtml .= '<td>' . $clusterId . '</td>';
            foreach ($clusterValues as $value) {
                $clusterHtml .= '<td>' . number_format($value, 6) . '</td>';
            }
            $clusterHtml .= '</tr>';
        }
        $clusterHtml .= '</tbody></table>';

        return $clusterHtml;
    }

    public function getClusterMembers($clusterId)
    {
        global $dbcon;

        $query = "SELECT id_member FROM clustering_results WHERE cluster_id = ?";

        $stmt = $dbcon->prepare($query);
        $stmt->bind_param('i', $clusterId);
        $stmt->execute();
        $result = $stmt->get_result();

        $members = [];
        while ($row = $result->fetch_assoc()) {
            $members[] = $row['id_member'];
        }

        return $members;
    }

    public function getMemberInterests($members)
    {
        global $dbcon;

        $placeholders = implode(',', array_fill(0, count($members), '?'));
        $types = str_repeat('i', count($members));

        $query = "
        SELECT 
            AVG(ans1) as avg_ans1,
            AVG(ans2) as avg_ans2,
            AVG(ans3) as avg_ans3,
            AVG(ans4) as avg_ans4,
            AVG(ans5) as avg_ans5,
            AVG(ans6) as avg_ans6,
            AVG(ans7) as avg_ans7,
            AVG(ans8) as avg_ans8
        FROM ans_interest
        WHERE id_member IN ($placeholders)
    ";

        $stmt = $dbcon->prepare($query);
        $stmt->bind_param($types, ...$members);
        $stmt->execute();
        $result = $stmt->get_result();
        $averages = $result->fetch_assoc();

        return $averages;
    }

    public function getTourismCategories()
    {
        return [
            "แหล่งท่องเที่ยวเชิงนิเวศ/ธรรมชาติ" => ["value1", "value10", "value18"],
            "แหล่งท่องเที่ยวเชิงอาหาร" => ["value5", "value11", "value18"],
            "แหล่งท่องเที่ยวเชิงเทศกาล/งานประเพณี" => ["value4", "value6", "value17"],
            "แหล่งท่องเที่ยวเชิงเกษตร" => ["value5", "value18", "value20"],
            "แหล่งท่องเที่ยววัฒนธรรม/วิถีชีวิต" => ["value3", "value7", "value18"],
            "แหล่งท่องเที่ยวเชิงผจญภัย" => ["value8", "value16", "value19"],
            "แหล่งท่องเที่ยวเชิงสุขภาพ" => ["value2", "value9", "value15"],
            "แหล่งท่องเที่ยวเชิงศาสนา" => ["value3", "value6", "value19"]
        ];
    }


    public function getTop3Interests($clusterId)
    {
        // ใช้ $this-> เพื่อเรียกใช้เมธอดภายในคลาส
        $members = $this->getClusterMembers($clusterId);
        $averages = $this->getMemberInterests($members);

        // เรียงลำดับผลลัพธ์จากมากไปน้อย
        arsort($averages);
        $top3 = array_slice($averages, 0, 3, true);

        // กำหนดชื่อสำหรับค่าเฉลี่ย
        $labels = [
            'avg_ans1' => 'แหล่งท่องเที่ยวเชิงนิเวศ/ธรรมชาติ',
            'avg_ans2' => 'แหล่งท่องเที่ยวเชิงอาหาร',
            'avg_ans3' => 'แหล่งท่องเที่ยวเชิงเทศกาล/งานประเพณี',
            'avg_ans4' => 'แหล่งท่องเที่ยวเชิงเกษตร',
            'avg_ans5' => 'แหล่งท่องเที่ยววัฒนธรรม/วิถีชีวิต',
            'avg_ans6' => 'แหล่งท่องเที่ยวเชิงผจญภัย',
            'avg_ans7' => 'แหล่งท่องเที่ยวเชิงสุขภาพ',
            'avg_ans8' => 'แหล่งท่องเที่ยวเชิงศาสนา'
        ];

        $top3Interests = [];
        foreach ($top3 as $key => $value) {
            $top3Interests[] = [
                'interest' => $labels[$key],
                'average' => $value
            ];
        }

        return $top3Interests;
    }





    //////////cal//////////////

    // Fetch data from eva_form1 and eva_form2 for a specific member
    // ฟังก์ชันดึงข้อมูลจากทุก id_member
    public function fetchAllEvaluationData()
    {
        $query = "
        SELECT eva_p1_ans1, eva_p1_ans2, eva_p1_ans3, eva_p1_ans4, eva_p1_ans5, 
               eva_p1_ans6, eva_p1_ans7, eva_p1_ans8, eva_p1_ans9, 
               eva_p2_ans1, eva_p2_ans10, eva_p2_ans11, eva_p2_ans12, 
               eva_p2_ans13, eva_p2_ans14, eva_p2_ans15, eva_p2_ans16, 
               eva_p2_ans17, eva_p2_ans18, eva_p2_ans19,
               ans_interest.ans1, ans_interest.ans2, ans_interest.ans3, ans_interest.ans4, 
               ans_interest.ans5, ans_interest.ans6, ans_interest.ans7, ans_interest.ans8
        FROM eva_form1
        LEFT JOIN eva_form2 ON eva_form1.id_member = eva_form2.id_member
        LEFT JOIN ans_interest ON eva_form1.id_member = ans_interest.id_member
    ";
        return $this->dbcon->query($query);
    }

    // Calculate optimal K using Elbow Method
    public function calculateOptimalK()
    {
        $data = [];
        $query = "SELECT * FROM eva_form1 UNION SELECT * FROM eva_form2";
        $result = mysqli_query($this->dbcon, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = [
                $row["eva_p1_ans1"],
                $row["eva_p1_ans2"],
                $row["eva_p1_ans3"],
                $row["eva_p1_ans4"],
                $row["eva_p1_ans5"],
                $row["eva_p1_ans6"],
                $row["eva_p1_ans7"],
                $row["eva_p1_ans8"],
                $row["eva_p1_ans9"],
                $row["eva_p2_ans1"],
                $row["eva_p2_ans10"],
                $row["eva_p2_ans11"],
                $row["eva_p2_ans12"],
                $row["eva_p2_ans13"],
                $row["eva_p2_ans14"],
                $row["eva_p2_ans15"],
                $row["eva_p2_ans16"],
                $row["eva_p2_ans17"],
                $row["eva_p2_ans18"],
                $row["eva_p2_ans19"]
            ];
        }

        // Implement the Elbow Method here
        // Use Python for K-means clustering and plot the Elbow graph
        // You need to set up Python environment with required libraries and execute the script

        // Example: using exec() to run a Python script
        $output = [];
        exec("python3 calculate_kmeans.py", $output);

        return $output;
    }


    public function saveNewClusterValues($clusters)
    {
        $conn = $this->dbcon;

        // Get the latest id_update_cluster
        $result = $conn->query("SELECT MAX(id_update_cluster) AS max_id FROM cluster_value");
        if ($result === false) {
            return "Error querying max id_update_cluster: " . $conn->error;
        }
        $row = $result->fetch_assoc();
        $next_id_update_cluster = $row['max_id'] + 1;

        foreach ($clusters as $clusterId => $clusterValues) {
            // Prepare the query
            $query = "INSERT INTO cluster_value (id_cluster, id_update_cluster, value1, value2, value3, value4, value5, value6, value7, value8, value9, value10, value11, value12, value13, value14, value15, value16, value17, value18, value19, value20)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Prepare and bind
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("ii" . str_repeat("d", 20), $clusterId, $next_id_update_cluster, ...$clusterValues);
                if (!$stmt->execute()) {
                    return "Error executing statement: " . $stmt->error;
                }
                $stmt->close();
            } else {
                return "Error preparing statement: " . $conn->error;
            }
        }
        return "Clusters saved successfully";
    }
}
