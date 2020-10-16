<?php
require_once "Database.php";

class Complaint extends Database
{


    public function checkComplainerExists($nic) {
        $q = "SELECT `complainer_id` FROM `complainer` WHERE `NIC`='$nic'";
        $list =   $this->conn->query($q);
        if ($list->num_rows >0) {
            $id = $list->fetch_assoc();
            return $id['complainer_id'];
        }else {
            return -1;
        }
    }

    public function addComplainer($id,$nic,$name,$phone_no) {
        if ($id == -1) {
            $q = " INSERT INTO `complainer`( `NIC`, `Name`, `phone_no`) VALUES 
            ('$nic','$name','$phone_no') ";

        }else {
             $q = "UPDATE `complainer` SET `NIC`='$nic',`Name`='$name',`phone_no`='$phone_no' WHERE `complainer_id`='$id'  ";
        }
        $list =   $this->conn->query($q);
    }

    public function addComplaint() {
        $q = "SELECT `complainer_id` FROM `complainer` WHERE `NIC`=''";
        $list =   $this->conn->query($q);
    }






    public function getCompliant_by_id($c_id)
    {
        $q = "SELECT complaint.complaint_id, complaint.is_bulb_there, complaint.Notes, complainer.NIC, complainer.phone_no
        FROM complaint INNER JOIN complainer 
        ON complaint.complainer_id=complainer.complainer_id WHERE complaint.complaint_id='$c_id'";

       

        $list =   $this->conn->query($q);
        // echo $list;
        return $list->fetch_assoc();
    
    }

   
    public function getCompliant_by_repair_id($r_id)
    {
        $q = "SELECT complaint.complaint_id, complaint.is_bulb_there, complaint.Notes, complainer.NIC, complainer.phone_no ,complainer.Name
        FROM complaint INNER JOIN complainer 
        ON complaint.complainer_id=complainer.complainer_id WHERE complaint.repair_id='$r_id'";

        $list =   $this->conn->query($q);
        // echo $list;
        return $list->fetch_assoc();
    }
}
