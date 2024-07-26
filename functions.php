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

    public function getinfomanager($id_manager)
    {
        $getinfo = mysqli_query($this->dbcon, "SELECT email FROM manager WHERE Id_manager = '$id_manager' ");
        return $getinfo;
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

    public function addplaces($name_places, $details_places, $contact_places, $name_Area, $id_manager)
    {
        // First, retrieve the id_Area corresponding to the selected name_Area
        $getAreaIdQuery = "SELECT id_Area FROM area_info WHERE name_Area = '$name_Area'";
        $result = mysqli_query($this->dbcon, $getAreaIdQuery);
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the id_Area from the result
            $row = mysqli_fetch_assoc($result);
            $id_Area = $row['id_Area'];
            // Now, insert the place with the retrieved id_Area
            $adplad = mysqli_query($this->dbcon, "INSERT INTO places_info(name_places, details_places, contact_places, id_Area, id_manager) VALUES ('$name_places', '$details_places', '$contact_places', '$id_Area', '$id_manager')");

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
        $tour_type_descrip1,
        $tour_type_descrip2,
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
        $Access_Status,
        $price_in,
        $id_Admin

    ) {
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
            tour_Type_id_1,
            tour_Type_id_2,
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
            Access_Status,
            price_in,
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
            '$tour_Type_id_1',
            '$tour_Type_id_2',
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
            '$Access_Status',
            '$price_in',
            '$id_Admin'
            )
            ");

                    return $adplad;
                } else {

                    // Handle the case when the selected area is not found
                    return false; // or handle the error as needed
                }
            }
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
        $name_typeArea


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
    price_in,id_type_area
    ) 
    VALUE(
        '$name_Area','$latitude_Area', '$longitude_Area', '$address_Area',' $sub_dis_Area','$dis_Area','$provi_Area','$post_code',
    '$info_Area','$activityinfo_Area',$tour_Type_id_1,$tour_Type_id_2,
    '$filename1','$filename2','$filename3','$filename4'
    ,'$has_map_Area','$phonenum_Area','$email_Area','$url_Area',
    '$ontime_Mon','$ontime_Tue','$ontime_Wed','$ontime_Thu','$ontime_Fri','$ontime_Sat','$ontime_Sun',
    '$closetime_Mon','$closetime_Tue','$closetime_Wed','$closetime_Thu','$closetime_Fri','$closetime_Sat','$closetime_Sun',
    '$Access_Status',
    '$price_in','$id_type_area'
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



    public function updateplaces($name_places, $details_places, $contact_places, $id_places)
    {
        $result = mysqli_query($this->dbcon, "UPDATE places_info SET 
                    name_places = '$name_places',
                    details_places = '$details_places',
                    contact_places = '$contact_places'
                    WHERE id_places = '$id_places'
                    ");
        return $result;
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
        $tour_type_descrip1,
        $tour_type_descrip2,
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
        $Access_Status,
        $price_in,
        $id_Admin,
        $id_places
    ) {
        $getTagIdQuery = "SELECT id_tag FROM places_tag WHERE tag_description = '$tag_description'";
        $result = mysqli_query($this->dbcon, $getTagIdQuery);
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the id_Area from the result
            $row = mysqli_fetch_assoc($result);
            $id_tag = $row['id_tag'];


            $updateQuery = "UPDATE places_info SET
                            id_tag = '$id_tag', 
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
                            tour_Type_id_1 = '$tour_type_descrip1',
                            tour_Type_id_2 = '$tour_type_descrip2',
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
                            Access_Status = '$Access_Status',
                            price_in = '$price_in',
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
                    id_type_area = '$name_typeArea'
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
}
