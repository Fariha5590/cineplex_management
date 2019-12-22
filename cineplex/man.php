<?php
 require 'config.php';
?>
<!Doctype html>
<html>
<head>
<title>Quiz Mania</title>
</head>
<body>
<form action="index.php" method="POST">
<?php 
  $query="select * from question";
  $result=mysql_query($query) or die(mysql_error());
  while($row=mysql_fetch_assoc($result))
  {
	  echo "Question".$row["id"].":".$row["question"]."<br />";
	  echo "<input type='radio' name='".$row['id']."' value='".$row['option1']."'/>".$row['option1'];"<br />";
	  echo "<input type='radio' name='".$row['id']."' value='".$row['option2']."'/>".$row['option2'];"<br />";
	  echo "<input type='radio' name='".$row['id']."' value='".$row['option3']."'/>".$row['option3'];"<br />";
    echo "<input type='radio' name='".$row['id']."' value='".$row['answer']."'/>".$row['answer'];"<br />";	 
  }
?>
</form>
</body>
</html>
