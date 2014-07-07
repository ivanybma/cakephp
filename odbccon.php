<?php
echo "MySQL database connect with ODBC";
$conn = odbc_connect(
		  "DRIVER={MySQL ODBC 5.3 Unicode Driver};Server=localhost;Database=ivan", 
		  "ivan", "440103");
		if (!($conn)) { 
		  echo "<p>Connection to DB via ODBC failed: ";
		  echo odbc_errormsg ($conn );
		  echo "</p>\n";
		}

		$sql = "SELECT * from persons";
		$rs = odbc_exec($conn,$sql);
		echo "<table><tr>";
		echo "<th>LastName</th><th>FirstName</tr>";
		while (odbc_fetch_row($rs))
		 {
		 $ln = odbc_result($rs,"LastName");
		 $fn = odbc_result($rs,"FirstName");
		 echo "<tr><td>$ln</td><td>$fn</td></tr>";
		}
		odbc_close($conn);
		echo "</table>";
		odbc_close($conn);
		
		
$conn = odbc_connect(
		  "DRIVER={MySQL ODBC 5.3 Unicode Driver};Server=localhost;", 
		  "ivan", "440103");
		if (!($conn)) { 
		  echo "<p>Connection to DB via ODBC failed: ";
		  echo odbc_errormsg ($conn );
		  echo "</p>\n";
		}
	//	$sql= "create database odb";
	//	odbc_exec($conn,$sql);
	//	$sql= "use odb";
	//	odbc_exec($conn,$sql);
	//	$sql="create table odbctst(id char(5) not null, name char(10))";
	//	odbc_exec($conn,$sql);
		
?>
