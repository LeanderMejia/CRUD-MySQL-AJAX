<?php 
    $dbHost = "localhost";
	$dbUser = "root";
	$dbPass = "root";
	$dbName = "crud_ajax"; 
	
	$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

	if (!$conn) {
		die("Database Connection Failed!");
	}

    function createQuery($conn, $sql) {
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "Failed";
            return;
        }

        echo "Success";
    }

	function readQuery($conn, $sql) {
		$arrData = [];
		$i = 0;
		$result = mysqli_query($conn, $sql);

		if (!$result || mysqli_num_rows($result) < 1) return;
		
		
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			foreach ($row as $key => $value) {
                if ($key == "date") {
                    $formattedDate = date("F d, Y", strtotime($value));
                    $arrData[$i][$key] = $formattedDate;
                } else if ($key == "price" || $key == "cost") {
                    $formattedValue = number_format($value, 2);
                    $arrData[$i][$key] = $formattedValue; 
                } else {
                    $arrData[$i][$key] = $value;
                }
			}
			$i++;
		}
		mysqli_free_result($result);

		return $arrData;
	}

	function updateQuery($conn, $sql) {
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "Failed";
            return;
        }

        echo "Success";
    }

	function deleteQuery($conn, $sql) {
		$result = mysqli_query($conn, $sql);
		
		if (!$result) {
            echo "Failed";
			return;
		}

		echo "Success";
	}
