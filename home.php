<?php $page='home';
include("php/dbconnect.php");
include("php/check.php");


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>School Fees Management System</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


</head>
<?php
include("php/studentheader.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Student</h1>
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage courses
                        </div>
                        <div class="panel-body">
                             <div class="table-sorting table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Level</th>
                                            <th>Semester</th>
                                            <th>Status</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									
                                    $sid = $_SESSION['uid'];
                                    $sta = '';
                                    $sql2 = "select * from student where id='".$sid."' and delete_status='0'";
                                    $q2 = $conn->query($sql2);
                                    if($q2->num_rows==1)
                                    {
                                        $res = $q2->fetch_assoc();
                                        if($res['balance'] == '0'){
                                            $sta = 'paid';
                                        }else{
                                            $sta = 'unpaid';
                                        }

                                    }
                                    $sql = "select * from grade where delete_status='0'";
									$q = $conn->query($sql);
									$i=1;
									while($r = $q->fetch_assoc())
									{
                                        $act = '';
                                        if($sta == "paid"){
                                            $act = '<a href="reg.php?id='.$r['id'].'" class="btn btn-success btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-edit">Select</span></a>';
                                        }else{
                                            $act = 'You have not paid';
                                        }    
									echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['detail'].'</td>
											<td>'.$r['grade'].'</td>
                                            <td>'.$sta.'</td>
											<td>'.$act.'</td>
                                        </tr>';
										$i++;
									}
									?>
									
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->

            
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    
   
   <script src="js/jquery-1.10.2.js"></script>	
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="js/custom1.js"></script>
    


</body>
</html>
