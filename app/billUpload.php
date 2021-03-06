<?php

	require_once '../framework/Vehicle.php';
	require_once '../framework/Job.php';

	//print_r($_POST);
    $vehicle = trim($_POST['vehicle']);
	$vehicleId = Vehicle::getIdByNumber($vehicle);
	$mVehicle = new Vehicle($vehicleId);
	
    $driver = trim($_POST['driver']);

    $latitude = trim($_POST['latitude']);
    $longitude = trim($_POST['longitude']);
    $address = trim($_POST['address']);
    $reason = trim($_POST['reason']);
    $amount = trim($_POST['amount']);

    $filename = date("YmdHis");

    $image = trim($_POST['bill_image']);
    $binary=base64_decode($image);
    header('Content-Type: bitmap; charset=utf-8');
	
	//checks whether the folder exists or not
	$folderpath = "../res/bills/".$vehicle;
	if (!file_exists($folderpath)) {
		mkdir($folderpath, 0777, true);
	}
	
    $filepath = $folderpath."/".$filename.".jpg";
    echo $filepath;
    $file = fopen($filepath, 'wb');
    fwrite($file, $binary);
    fclose($file);
	
	$mVehicle->updateExpenses($driver, $latitude, $longitude, $address, $reason, $amount, $filename);

    echo "image uploaded";
	
?>