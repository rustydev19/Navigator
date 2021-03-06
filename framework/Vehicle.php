<?php



require_once 'Connection.php';

class Vehicle {
	private $id;
	private $vehicleNumber;
	private $type;
	private $model;
	private $makeYear;
	private $companyId;
	private $isDeployed;
	private $isOnJob;
	private $dateAdded;
	private $addedBy;
	private $description;
	private $address;
	private $LatLong;
	
	function __construct($id){
		
		
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();

		$sql = "SELECT * FROM vehicle WHERE id='$id'";
		$action = mysqli_query($conn, $sql);

		if (mysqli_num_rows($action) > 0) {
			while($row = mysqli_fetch_assoc($action)) {
				$this->id = $row['id'];
				$this->vehicleNumber = $row['vehicle_number'];
				$this->type = $row['type'];
				$this->model = $row['model'];
				$this->makeYear = $row['make_year'];
				$this->userId = $row['company_id'];
				$this->companyId = $row['company_id'];
				$this->isDeployed = $row['deployed'];
				$this->isOnJob = $row['on_job'];
				$this->addedBy = $row['added_by'];
				$this->description = $row['description'];
				$this->dateAdded = $row['date_added'];
				$this->address = $row['address'];
				$this->LatLong["lat"] = $row['lattitude'];
				$this->LatLong["long"] = $row['longitude'];
			}
		}
	}
	
	public static function add($type, $model, $vehicle_number, $make_year, $description) {
		//require_once '../framework/DBConnect.php';
		
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		if(Vehicle::exists($conn, $vehicle_number)) return false;
        if(!isset($_SESSION))
	       session_start();
		$companyId = $_SESSION['user']['company'];
		$userId = $_SESSION['user']['id'];
		
		$sql = "INSERT INTO vehicle (type, model, vehicle_number, make_year, company_id, added_by, description) VALUES ('$type','$model','$vehicle_number','$make_year','$companyId','$userId','$description')";
		
		if (mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	function delete() {
		//require_once '../framework/DBConnect.php';
		
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		//if(!Vehicle::exists($conn, $vehicle_number)) return false;
		
		// sql to delete a record
		$sql = "DELETE FROM vehicle WHERE id='$this->id'";

		if (mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	function getCurrentJob() {
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		//if(!Vehicle::exists($conn, $vehicle_number)) return;
		
		$sql = "SELECT id FROM job WHERE vehicle_id = '$this->id' AND status = '0'";
		$action = mysqli_query($conn, $sql);
		

		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($action)) {
				return $row['id'];
			}
		}
	}
    
    function getCurrentDriver() {
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		//if(!Vehicle::exists($conn, $vehicle_number)) return;
		
		$sql = "SELECT driver FROM vehicle WHERE id = '$this->id' AND status = '1'";
        //echo $sql;
		$action = mysqli_query($conn, $sql);
		

		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($action)) {
				return $row['driver'];
			}
		}
        return 0;
	}
    
    function removeDriver() {
		//require_once '../framework/DBConnect.php';
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		
		$sql = "UPDATE vehicle SET driver = 0 WHERE id = '$this->id'";
		//print_r($sql);

		if (mysqli_query($conn, $sql)) {
			//print_r("Record updated successfully");
            return true;
		} else {
			//print_r("Error updating record: " . mysqli_error($conn));
            return false;
		}
	}
	
	function getPreviousJobs() {
		//require_once '../framework/DBConnect.php';
		
		$result = array();
		
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		//if(!Driver::exists($conn, $vehicle_number)) return $result;
		
		$sql = "SELECT id FROM job WHERE vehicle_id = '$this->id' AND status = '0'";
		$action = mysqli_query($conn, $sql);
		

		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($action)) {
				array_push($job, $row['id']);
			}
		}
		return $job;
	}
	
	function getLocation() {
		//require_once '../framework/DBConnect.php';
		
		$result = null;
		
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		//if(!Vehicle::exists($conn, $vehicle_number)) return $result;
		
		$sql = "SELECT id, vehicle_number, lattitude, longitude, address, last_update FROM vehicle WHERE id = '$this->id'";
		$action = mysqli_query($conn, $sql);
		

		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($action)) {
				$result = $row;
			}
		}
		return $result;
	}

	function getLat() {
		//require_once '../framework/DBConnect.php';
		
		$result = null;
		
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		//if(!Vehicle::exists($conn, $vehicle_number)) return $result;
		
		$sql = "SELECT lattitude FROM vehicle WHERE id = '$this->id'";
		$action = mysqli_query($conn, $sql);
		

		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($action)) {
				return $row['lattitude'];
			}
		}
		//return $result;
	}

	function getLastUpdate() {
		//require_once '../framework/DBConnect.php';
		
		$result = null;
		
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		//if(!Vehicle::exists($conn, $vehicle_number)) return $result;
		
		$sql = "SELECT last_update FROM vehicle WHERE id = '$this->id'";
		$action = mysqli_query($conn, $sql);
		

		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($action)) {
				return $row['last_update'];
			}
		}
		//return $result;
	}

	function getAddress() {
		//require_once '../framework/DBConnect.php';
		
		$result = null;
		
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		//if(!Vehicle::exists($conn, $vehicle_number)) return $result;
		
		$sql = "SELECT address FROM vehicle WHERE id = '$this->id'";
		$action = mysqli_query($conn, $sql);
		

		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($action)) {
				return $row['address'];
			}
		}
		//return $result;
	}

	function getLong() {
		//require_once '../framework/DBConnect.php';
		
		$result = null;
		
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		//if(!Vehicle::exists($conn, $vehicle_number)) return $result;
		
		$sql = "SELECT longitude FROM vehicle WHERE id = '$this->id'";
		$action = mysqli_query($conn, $sql);
		

		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($action)) {
				return $row['longitude'];
			}
		}
		//return $result;
	}
	
    function setLocation($lattitude, $longitude, $address, $city) {
		//require_once '../framework/DBConnect.php';
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		$lattitude_list;
		$longitude_list;
		$last_last_update;		

		/*
		* Finally update the vehicle table with latest values
		*/
		
		$fgDate = $db->getTimeNow();
		
		$sql = "UPDATE vehicle SET lattitude = '$lattitude', longitude = '$longitude', city = '$city', address = '$address', last_update = '$fgDate' WHERE id = '$this->id'";
		//print_r($sql);

		if (mysqli_query($conn, $sql)) {
			//print_r("Record updated successfully");
            return true;
		} else {
			//print_r("Error updating record: " . mysqli_error($conn));
            return false;
		}
	}
    
    function addTrack($lattitude, $longitude, $address){
        $db = new Connection();
		$conn = $db->connect();
        
        $today = date('Y-m-d');
        
		$fgDate = $db->getTimeNow();
		
        $sql = "INSERT INTO location (vehicle_id, lattitude, longitude, address, added_date, added, last_updated) VALUES ('$this->id', '$lattitude', '$longitude', '$address', '$today', '$fgDate', '$fgDate')";
		
		if (mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
		}
    }
    
    function getTrack($start, $end){
		$result['track'][]=null;
		
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		//if(!Vehicle::exists($conn, $vehicle_number)) return $result;
		
		$sql = "SELECT * FROM location WHERE vehicle_id = '$this->id' AND added_date BETWEEN '$start' AND '$end'";
        // AND added_date BETWEEN '$start' AND '$end'
		$action = mysqli_query($conn, $sql);
        
		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($action)) {
				array_push($result['track'], $row);
			}
        } else{
            return null;
        }
		return $result;
    }
	
	function updateExpenses($driver, $latitude, $longitude, $address, $reason, $amount, $filename) {
		$db = new Connection();
		$conn = $db->connect();
        
        $sql = "INSERT INTO expenses (vehicle_id, driver_id, lattitude, longitude, address, reason, amount, filename) VALUES ('$this->id', '$driver', '$latitude', '$longitude', '$address', '$reason', '$amount', '$filename')";
		
		if (mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
		}
	}
    
    function updateDuration($lattitude, $longitude){
        print_r("update duration<br>");
        $db = new Connection();
		$conn = $db->connect();
        
        $id = 0;
        
        $sql = "SELECT id FROM location WHERE vehicle_id = '$this->id' ORDER BY id DESC ";
        print_r($sql);
		$action = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			if($row = mysqli_fetch_assoc($action)) {
				$id = $row['id'];
			}
		}
        
		$fgDate = $db->getTimeNow();
		
        $sql = "UPDATE location SET last_updated = '$fgDate' WHERE id = '$id'";
		print_r($sql);
		if (mysqli_query($conn, $sql)) {
            print_r("Record updated successfully");
			return true;
		} else {
            print_r("Error updating record: " . mysqli_error($conn));
			return false;
		}
    }
    
    function getTotalExpense($month){
    }
    
    function getExpenseList($month){
    }
    
    function getAllTotalExpense(){
    }
    
    function getAllExpenseList(){
    }

    function deploy() {
		//require_once '../framework/DBConnect.php';
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		$lattitude_list;
		$longitude_list;
		$last_last_update;		

		/*
		* Finally update the vehicle table with latest values
		*/
		$this->isDeployed = 1;
		$fgDate = $db->getTimeNow();
		
		$sql = "UPDATE vehicle SET deployed = '1', date_deployed = '$fgDate' WHERE id = '$this->id'";
		//print_r($sql);

		if (mysqli_query($conn, $sql)) {
			return true;
		} else {
			return false;
			//print_r("Error updating record: " . mysqli_error($conn));
		}
	}

    function getJob(){
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();
		
		$sql = "SELECT id FROM job WHERE vehicle_id = '$this->id'";
		$action = mysqli_query($conn, $sql);
		$result = array();

		if (mysqli_num_rows($action) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($action)) {
				array_push($result, $row['id']);
			}
		}
		return $result;		
	}
	
	public static function getIdByNumber($vehicleNumber) {
		// opening db connection
		$db = new Connection();
		$conn = $db->connect();

		$sql = "SELECT id FROM vehicle WHERE vehicle_number = '$vehicleNumber'";
		$action = mysqli_query($conn, $sql);

		if (mysqli_num_rows($action) > 0) {
			while($row = mysqli_fetch_assoc($action)) {
				return $row['id'];
			}
		}
		return null;
	}
	
	public static function exists($conn, $vehicle_number) {
		$sql = "SELECT id FROM vehicle WHERE vehicle_number = '$vehicle_number'";
		$action = mysqli_query($conn, $sql);

		if (mysqli_num_rows($action) > 0) {
			while($row = mysqli_fetch_assoc($action)) {
				return $row['id'];
			}
		}
		return null;		
	}
	
	function search($customer_id, $type, $model, $vehicle_number, $destination, $deployed) {
		
	}

	function getId(){
		return $this->id;
	}

	function getVehicleNumber(){
		return $this->vehicleNumber;
	}

	function getCompany(){
		return $this->companyId;
	}
	
	function getType(){
		return $this->type;
	}
	
	function getModel(){
		return $this->model;
	}

	function getMakeYear(){
		return $this->makeYear;
	}
	
	function isDeployed(){
		return $this->isDeployed;
	}
	
	function isOnTrip(){
		return $this->isOnJob;
	}
	
/*	function getAddress() {
		return $this->address;
	}*/
	
	function getDescription() {
		return $this->description;
	}
}
?>