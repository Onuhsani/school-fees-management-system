<?php $page='course';
include("php/dbconnect.php");
include("php/check.php");
$errormsg = '';
$action = "add";

$course='';
$detail = '';
$id= '';
if(isset($_POST['save']))
{

$semester = mysqli_real_escape_string($conn,$_POST['semester']);
$ccode = mysqli_real_escape_string($conn,$_POST['ccode']);
$ctitle = mysqli_real_escape_string($conn,$_POST['ctitle']);
$delete_status = '0';

 if($_POST['action']=="add")
 {
 
  $sql = $conn->query("INSERT INTO courses (sem_id,course_code,course_title,delete_status) VALUES ('$semester','$ccode','$ctitle','$delete_status')") ;
    
    echo '<script type="text/javascript">window.location="course.php?act=1";</script>';
 
 }else
  if($_POST['action']=="update")
 {
 $id = mysqli_real_escape_string($conn,$_POST['id']);	
   $sql = $conn->query("UPDATE  grade  SET  grade  = '$grade', detail  = '$detail'  WHERE  id  = '$id'");
   echo '<script type="text/javascript">window.location="course.php?act=2";</script>';
 }



}




if(isset($_GET['action']) && $_GET['action']=="delete"){

$conn->query("UPDATE  grade set delete_status = '1'  WHERE id='".$_GET['id']."'");
header("location: course.php?act=3");

}


$action = "add";
if(isset($_GET['action']) && $_GET['action']=="edit" ){
$id = isset($_GET['id'])?mysqli_real_escape_string($conn,$_GET['id']):'';

$sqlEdit = $conn->query("SELECT * FROM grade WHERE id='".$id."'");
if($sqlEdit->num_rows)
{
$rowsEdit = $sqlEdit->fetch_assoc();
extract($rowsEdit);
$action = "update";
}else
{
$_GET['action']="";
}

}


if(isset($_REQUEST['act']) && @$_REQUEST['act']=="1")
{
$errormsg = "<div class='alert alert-success'> Course has been added successfully</div>";
}else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="2")
{
$errormsg = "<div class='alert alert-success'> Course has been updated successfully</div>";
}
else if(isset($_REQUEST['act']) && @$_REQUEST['act']=="3")
{
$errormsg = "<div class='alert alert-success'> Course has been deleted successfully</div>";
}

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
	
	 <script src="js/jquery-1.10.2.js"></script>


	
</head>
<?php
include("php/studentheader.php");
?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Register</h1>
                     
						<?php

						echo $errormsg;
						?>
                    </div>
                </div>
				
				
				
        <?php 
		 if(isset($_GET['action']) && @$_GET['action']=="add" || @$_GET['action']=="edit")
		 {
		?>
		
			<script type="text/javascript" src="js/validation/jquery.validate.min.js"></script>
                <div class="row">
				
                    <div class="col-sm-8 col-sm-offset-2">
               <div class="panel panel-success">
                        <div class="panel-heading">
                           <?php echo ($action=="add")? "Add course": "Edit course"; ?>
                        </div>
						<form action="course.php" method="post" id="signupForm1" class="form-horizontal">
                        <div class="panel-body">

                        <div class="form-group">
								<label class="col-sm-3 control-label" for="Confirm"> Semester</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="semester" id="semester">
                                        <option value="">Select Semester</option>
                                        <?php
                                            $sem = "select * from grade order by grade asc";
                                            $ns = $conn->query($sem);
                                                
                                            while($r = $ns->fetch_assoc())
                                            {
                                                // echo '<option value="'.$r['id'].'"  '.(($grade==$r['id'])?'selected="selected"':'').'>'.$r['grade'].'</option>';
                                                // echo '<option value="'.$r['id'].'"'>'.$r['grade'].'</option>';
                                                echo '<option value="'.$r['id'].'">'.$r['detail']." (".$r['grade']." Semester)".'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                
								<!-- <div class="col-sm-9">
									    <input class="form-control" name="ccode" id="ccode" value="<?php echo $detail;?>" maxlength="6"/>
								</div> -->
							</div>
						
						<div class="form-group">
								<label class="col-sm-3 control-label" for="Confirm"> Course code</label>
								<div class="col-sm-9">
									    <input class="form-control" name="ccode" id="ccode" value="<?php echo $detail;?>" maxlength="6"/>
								</div>
							</div>
						
						
						<div class="form-group">
								<label class="col-sm-3 control-label" for="Old">Course title </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="ctitle" name="ctitle" value="<?php echo $course;?>"  maxlength="100"/>
								</div>
							</div>
						
						<div class="form-group">
								<div class="col-sm-8 col-sm-offset-2">
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<input type="hidden" name="action" value="<?php echo $action;?>">
								
									<button type="submit" name="save" class="btn btn-success" style="border-radius:0%">Add </button>
								</div>
							</div>
                         
                           
                           
                         
                           
                         </div>
							</form>
							
                        </div>
                            </div>
            
			
                </div>
               

			   
			   
		<script type="text/javascript">
		

		$( document ).ready( function () {			
			
			 if($("#signupForm1").length > 0)
         {
			$( "#signupForm1" ).validate( {
				rules: {
					grade: "required",
					
					
				
					
				},
				messages: {
					grade: "Please enter class name",
					
					
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-10" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-10" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );
			
			}
			
		} );
	</script>


			   
		<?php
		}else{
		?>
		
		 <link href="css/datatable/datatable.css" rel="stylesheet" />
		 
		
		 
		 
		<div class="panel panel-default">
                        <div class="panel-heading">
                            Register courses
                        </div>
                        <div class="panel-body">
                             <div class="table-sorting table-responsive">

                                <table class="table table-striped table-bordered table-hover" id="tSortable22">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Course code</th>
                                            <th>Course title</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
                                    $id = $_GET['id'];
                                    // $sem = $_GET['sem'];
                                    // $sql1 = "select * from grade where detail= '".$level."' and grade= '".$sem."' and delete_status=0";
									// $v1 = $conn->query($sql1);
                                    // if($v1->num_rows>=1){
                                    //     $res = $v1->fetch_assoc();
                                    $sql = "select * from courses where sem_id= '".$id."' and delete_status='0'";
									$q = $conn->query($sql);
									$i=1;
                                    $d1 = '';
                                    $d2 = '';
                                    $se = '';
                                    $dn = '<button name="reg" class="btn btn-success btn-xs" style="border-radius:60px;"><span class="glyphicon glyphicon-plus">Register</span></button>';
									while($r = $q->fetch_assoc())
									{
                                        
									echo '<tr>
                                            <td>'.$i.'</td>
                                            <td>'.$r['course_code'].'</td>
											<td>'.$r['course_title'].'</td>
											<td id="regi">
                                            <form action="reg.php?id='.$r['sem_id'].'" method="post">
                                                '.$dn.'
                                            </form>
											</td>
                                        </tr>';
										$i++;
                                        $d1 = $r['course_code'];
                                        $d2 = $r['course_title'];
                                        $se = $r['sem_id'];
									}  
                                                                
                                    if(isset($_POST['reg'])){
                                        $ch = 0; 
                                        if($ch == 0){
                                            $user = $_SESSION['uid'];
                                            $re = "INSERT INTO registrations(stu_id,course_code,course_title) VALUES('$user','$d1','$d2')";
                                            $run = $conn->query($re);
                                            $dn = "Register";
                                            $ch = 1;
                                            echo "<script>alert('Course registered successfully')</script>";
                                        }else{
                                            echo "<script>alert('Already Registered')</script>";
                                        }
                                        
                                    }


									?>
									
                                        
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                     
	<script src="js/dataTable/jquery.dataTables.min.js"></script>
     <script>
         $(document).ready(function () {
             $('#tSortable22').dataTable({
    "bPaginate": true,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": true });
	
         });
		 
	$(document).ready(function(){
       $('#regi').click(function(){
        $('regi').text('registered');
       }); 
    });
    </script>
		
		<?php
		}
		?>
				
				
            
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

   
   
  
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="js/custom1.js"></script>

    
</body>
</html>
