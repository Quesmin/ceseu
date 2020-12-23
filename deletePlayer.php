<?php
// Process delete operation after confirmation
session_start();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if($_SESSION["tournament"] && $_SESSION["loggedin"] == true){
    // Include config file
    require_once "config.php";
    
    if(isset($_POST["id"]) && !empty($_POST["id"])){
		$sql_delete_player1 = "DELETE FROM individualresults WHERE individualresults.id_player =".$_POST["id"];
		$sql_delete_player2 = "DELETE FROM players WHERE players.id =".$_POST["id"];
		$sql_delete_player3 = "DELETE FROM persons WHERE persons.id =".$_POST["id"];
		
		
		try{
				mysqli_query($link, $sql_delete_player1);
				mysqli_query($link, $sql_delete_player2);
				mysqli_query($link, $sql_delete_player3);
				header("location: readTeam.php?id=".$_SESSION["currentTeamId"]);
			} catch (mysqli_sql_exception $exception){
				mysqli_rollback($link);
				throw $exception;
			} 
		}
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="id" value='<?php echo trim($_GET["id"]); ?>'>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="readTeam.php?id=<?php echo $_SESSION["currentTeamId"]; ?>" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>