<html>
<style>
table, th, td {
  border: 1px solid black;
}

<?php
// Create connection
 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 }
//run a query to get all department names  
$sqlstatement = $conn->prepare("SELECT distinct dept_name FROM department order by dept_name asc"); //prepare the statement
$sqlstatement->execute(); //execute the query
$departments = $sqlstatement->get_result(); 
$sqlstatement->close();
?>


</style
<body>
<p><h2>New Student Entry Form:</h2></p>
<form action="newstudent.php" method=get>
	Enter Student name: <input type=text size=20 name="name">
	<p>Enter Student ID number: <input type=text size=5 name="id">
        <p>Enter total credits if you are a transfer student: <input type=text size=10 name="credits">
	<p>Select Student Department: 
	<select name="department">
        <?php 
	while($department = $departments->fetch_assoc()) {
	?>
		<option value="<?php echo $department["dept_name"]; ?>"> <?php echo $department["dept_name"]; ?>
		</option>
	<?php } //end while loop ?>
	</select>
	<p> <input type=submit value="submit"> 
                <input type="hidden" name="form_submitted" value="1" >
</form>


<?php //starting php code again!
if (!isset($_GET["form_submitted"]))
{
		echo "Hello. Please enter new student information and submit the form.";
}
else {
  if (!empty($_GET["name"]) && !empty($_GET["id"]))
{
   $stdName = $_GET["name"]; //gets name from the form
   $stdID = $_GET["id"]; //gets id from the form
   $stdDept = $_GET["department"]; //get department from the form
   if(!isset($_GET["credits"])) {
		$stdCredits = 0;
          }
   else{
   $stdCredits = $_GET["credits"];
   }
   $sqlstatement = $conn->prepare("INSERT INTO student values(?, ?, ?, ?)"); //prepare the statement
   $sqlstatement->bind_param("sssd",$stdID,$stdName,$stdDept,$stdCredits); //insert the variables into the ? in the above statement
   $sqlstatement->execute(); //execute the query
   
   if($sqlstatement->error){
	echo $sqlstatement->error;   //print an error if the query fails
	}
   else {
        echo "$stdName enrolled successfully";
       }
   $sqlstatement->close();
   
 }
 else {
	 echo "<b> Error: Please enter all details to proceed.</b>";
 }
   $conn->close();
 } //end else condition where form is submitted
  ?>
</body>
</html>
