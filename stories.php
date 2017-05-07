<?php
include('templates/header.php');
//check if logged in already, if you are, redirect to login page?
if(isset($_SESSION['userName'])){
    
}else {
    header('Location: '.'login.php');
}

?>

<h2> Stories Uploaded</h2>


<?php
print '<table style="width:75%">
  <tr>
    <th style = "text-decoration: underline">Name</th>
    <th style = "text-decoration: underline">Last Modified</th> 
  </tr>';

date_default_timezone_set('America/Chicago');

$currentUser = $_SESSION['userName'];

//Set the directory
$search_dir = '../users/'. $currentUser . '/';
$contents = scandir($search_dir);

//print '
//    <tr>
//    <td>check1</td>
//    <td>check2</td> 
//  </tr>
//   <tr>
//    <td>test3</td>
//    <td>test4</td>
//    </tr>';

foreach($contents as $item){
    
    if (trim($item) == "." | trim($item) == ".." | trim($item) == 'books.csv'){
         //skip... 
    }else {
        $fileTimeLong = filemtime($search_dir . $item);
        $dateFileTime = date('F d Y h:i A', $fileTimeLong);
        print '<tr><td style = "color: blue">'. $item. '</td>' . '<td style = "color: blue">' . $dateFileTime . '</td>';
    }
    
    
 
}


print '</table>';


?>

    
<?php
include('templates/footer.php');

?>

