<html>
<style>
table, th, td {
  border: 1px solid black;
}

</style
<body>
<p><h2>University Student Directory Search:</h2></p>
<form action="Stu-search-id.php" method=get>
	<p>Enter Student ID number: <input type=text size=5 name="id">
        <p> <input type=submit value="submit">
                <input type="hidden" name="form_submitted" value="1" >
</form>


<?php //starting php code again!
if (!isset($_GET["form_submitted"]))
{
		echo "Hello. Please enter a students ID number and submit the form.";
}
else {
// Create connection

 $conn = new mysqli($servername, $username, $password, $dbname);
 // Check connection
 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 }
 
 if (!empty($_GET["id"]))
 {
   $stuID = $_GET["id"]; //gets name from the form
   $search = "$stuID%";
   $sqlstatement = $conn->prepare("SELECT id, name, dept_name,tot_cred FROM student where id like ?"); //prepare the statement
   $sqlstatement->bind_param("s",$search); //insert the string variable into the ? in the above statement
   $sqlstatement->execute(); //execute the query
   $result = $sqlstatement->get_result(); //return the results
   $sqlstatement->close();
 }
 else {
	 echo "<b>Please enter student ID number</b>";
 }
   if ($result->num_rows > 0) {
     	// Setup the table and headers
	echo "<table><tr><th>ID</th><th>Name</th><th>Department</th><th>Total credits</th></tr>";
	// output data of each row into a table row
	 while($row = $result->fetch_assoc()) {
		 echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td> ".$row["dept_name"]."</td><td> ".$row["tot_cred"]."</td></tr>";
   	}
	
	echo "</table>"; // close the table
	echo "There are ". $result->num_rows . " results.";
	// Don't render the table if no results found
   	} else {
               echo "$name not found. 0 results";
	} 
   $conn->close();
 } //end else condition where form is submitted
  ?> <!-- this is the end of our php code -->
<p> Thanks for using the directory search! 
</body>
</html>
