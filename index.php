<?php
//error_reporting(0);
include('db_config.php');
//include('waf.php');

if(isset($_GET['id'])){

	$id = $_GET['id'];	
	//$id = waf_replace($_GET['id']);
	//$id = waf_block_word($_GET['id']);

	/*
	$id = waf_addslashes($_GET['id']);
	mysqli_query($con,"SET NAMES gbk");  // Untuk bypass Addslashes() dengan kondisi charset harus big5 / gbk (multibyte character)
	*/

	$query = "SELECT * FROM flag WHERE id = $id LIMIT 0,1"; // Integer based
    //$query = "SELECT * FROM article WHERE id = '$id' LIMIT 0,1"; // String based
    $result = mysqli_query($con,$query) or mysqli_error($con);
    $row = mysqli_fetch_array($result);

    /* Routed Injection

    $query2 = "SELECT image, quote FROM article WHERE id = '$row[id]' ORDER BY id ASC";
    $result2 = mysqli_query($con,$query2) or mysqli_error($con);
    $row2 = mysqli_fetch_array($result2);
	*/

	/* Mencegah SQLi dengan Mysqli Prepare Statement 
    $stmt = $con->prepare("SELECT * FROM article WHERE id = ? LIMIT 0,1");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    */
    
?>

<html>
<head>
<title>Home Page - SQL Injection</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PICT - CTF</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
    <link rel="stylesheet" href="assets/css/bootstrap4-neon-glow.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/particles.css">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/font-hack/2.020/css/hack.min.css'>
    <link href="css/htmlstyles.css" rel="stylesheet">
</head>

<body>
<div class="container-narrow">
	<br><br>
	<div class="jumbotron">
			<p class="lead" style="color:white">
				Basic SQL Injection
			</p>
        </div>
	<center>
		<h2><?=$row['quote'];?></h2>
		<span><font color=lime> QUERY :</font> <font color=green><?php if(isset($query)){ echo $query;} else echo $_GET['id'];?></font></span>		
	</center>

<?php
}else 
	header('Location: index.php?id=1');

?>
</div>
</body>
</html>
