<?php 

$id = $_POST["id"];
$data = $_POST["coords"];
$color = $_POST["color"];

echo $_POST["id"]. '    '. $data[0][1][0];


// array(1) { 
//     [0]=> array(4) {
//         [0]=> array(2) { [0]=> float(79.874427976289) [1]=> float(6.8828447927322) } 
//         [1]=> array(2) { [0]=> float(79.864686193147) [1]=> float(6.8734713659537) } 
//         [2]=> array(2) { [0]=> float(79.876187505402) [1]=> float(6.8700628012813) }
//         [3]=> array(2) { [0]=> float(79.874427976289) [1]=> float(6.8828447927322) }
//     } 
// }
?>