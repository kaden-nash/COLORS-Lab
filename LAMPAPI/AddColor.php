<?php
	$inData = getRequestInfo();
	
	$color = $inData["color"];
	$userId = $inData["userId"];

		// Load the .env file
	$env = parse_ini_file(__DIR__ . '/.env');

	// Use the variables
	$conn = new mysqli(
		$env["DB_SERVER"], 
		$env["DB_USER"], 
		$env["DB_PASS"], 
		$env["DB_NAME"]
	);
	
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("INSERT into Colors (UserId,Name) VALUES(?,?)");
		$stmt->bind_param("ss", $userId, $color);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		returnWithError("");
	}

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
?>