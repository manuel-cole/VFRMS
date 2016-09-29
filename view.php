<?php 
ob_start();
session_start();

//$region_name = $_POST['region_name']; 
$con=mysqli_connect("localhost","bootstrap","bootstrap","vfrms");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql="SELECT * FROM records";

$records=mysqli_query($con,$sql);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>VfRMS.</title>
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/lightbox.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />

 
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
 <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style>
    .roww {
    float: center;
    text-align: right;
    width: 65%;
}

 .container{
    padding-left: 30px;
    padding-bottom: 50px;
    float: left;      
 }

</style>
<script>
$( document ).ready(function() {
    $('#myModal').on('hidden.bs.modal', function () {
        $(this).removeData('bs.modal');
    });
     $("#myBtn").click(function(){
        $("#myModal").modal({backdrop: "static"});
    });
});
</script>
  </head>

  <body id="target">
<script type="text/javascript">
    function submitForm(action)
    {
        document.getElementById('form1').action = action;
        document.getElementById('form1').submit();
    }
</script>

    <div class="container">
 <div class="row">
     <form id="form1" action="" method="post">
     <div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
    <thead>
    
    <tr>
   <th>File Name</th>
    <th>File Type</th>
    <td>File Size(KB)</td>
    <th>Date Uploaded</th>
    <th>Owner</th>
    <th>View</th>
    </tr>
        </thead>
        
<tbody>       
    <?php

    $result = mysqli_query($con,"SELECT * FROM records");
    $count = mysqli_num_rows($result);

// echo "<h3><center>Today's Reservations</center></h3><br><br>";

while($row=mysqli_fetch_array($result)){
    // $reservation_id = $row['reservation_id'];
    
    ?>
    
    <tr>
    
        
            <td><?php echo $row['fileName'];?></td>
            <td><?php echo $row['fileType'];?></td>
            <td><?php echo $row['size'];?></td>
            <td><?php echo $row['dateCreated'];?></td>
            <td><?php echo $row['owner'];?></td>
            <td><a href="uploads/<?php echo $row['file']; ?>" target="_blank">view file</a></td>            
            

    </tr>
    
    <?php   } //end of while loop ?>
        
    </tbody>
</table> 
</div>
    
      </form>
        </div>
            
    <!--    <button id="cmd">generate PDF</button>-->
        </div>
    
    
<script>
function myFunction() {
    window.print();
}
</script>

 <!-- <script type="text/javascript">
$(function () {
  var specialElementHandlers = {
        '#editor': function (element,renderer) {
            return true;
        }
    };
 $('#cmd').click(function () {
        var doc = new jsPDF();
        doc.fromHTML($('#target').html(), 15, 15, {
            'width': 170,'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });  
});
  </script>-->
    <script src="js/main.js"></script>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/lightbox.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
