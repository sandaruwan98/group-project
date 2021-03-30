<?php
namespace classes;
// include_once '../utils/modelLoader.php';
include_once  __DIR__ . '/../utils/classloader.php';

class DS extends Framework
{
    public function __construct() {
        $this->session = new Session(DSFL);
    }
    
   
    public function SystemOverview()
    {
        // inventory data for bar chart
        $inventryModel = new \models\Inventory();
        $inventry = $inventryModel->getInventory();
        $barlabel = "";
        $barval = "";
        while ($row = $inventry->fetch_array()) {
          $barlabel .= '"'.$row["name"] . '" ,';
          $barval .= $row["total"] . ",";
        }
        $data['barlabel'] =$barlabel;
        $data['barval'] =$barval;
        
        $currentdate = date('Y-m-d');
        $lastmonthdate = date('Y-m-d',strtotime(date('Y-m-d')." -1 Months")) ;
        $reportmodel = new \models\ReportGenerate();
        $data['normcount'] =$reportmodel->getnormalRepairCount($lastmonthdate,$currentdate);
        $data['suscount'] =$reportmodel->getsuspiRepairCount($lastmonthdate,$currentdate);

        $result =$reportmodel->getRepairCountBydate($lastmonthdate,$currentdate);
        $arealabel = "";
        $areaval = "";
        $max = 0;
        while ($row = $result->fetch_array()) {
          $arealabel .= '"'.$row["date"] . '" ,';
          $areaval .= $row["count"] . ",";
          if ($row["count"]> $max) {
            $max = $row["count"];
          }
        }
        
        $data['arealabel'] =$arealabel;
        $data['areaval'] =$areaval;
        $data['areamax'] =$max;
        return $data;
    }


    public function TechOverview()
    {
       
       
        
       
        $user = new \models\User();
        $data['techs']  = $user->getUsers(TechnicianFL);
                
         
        if (isset($_POST["generate"])) {
            
            $repairModel = new \models\Repair();
            $fraudModel = new \models\Fraud();
            $reportmodel = new \models\ReportGenerate();
            $data['normcount'] =$reportmodel->getnormalRepairCount($_POST["firstDate"], $_POST["secondDate"]);
            $data['suscount'] =$reportmodel->getsuspiRepairCount($_POST["firstDate"], $_POST["secondDate"]);

            $techdetail = $user->getUserDetails($_POST["techid"]);
            $data['techdetail'] = $techdetail;


            $fraudResult = $fraudModel->getFraudsByUserID($techdetail['userId'], $_POST["firstDate"], $_POST["secondDate"]);
            $data['fraudlist'] = $fraudResult;
           

           

        }

        return $data;
    }











}