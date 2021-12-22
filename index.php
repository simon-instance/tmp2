<?php

	require 'verbinding.php';

	$verbinding = verkrijgVerbinding();
	die(var_dump($verbinding));
	// Een query net zoals we dat wel vaker in SQL doen.
	$query = "INSERT INTO fletnix_user (username)
	VALUES ('student')";

	// Query uitvoeren.
	$result = $verbinding->exec($query);

	// Alle users ophalen.
	$users = $verbinding->query('SELECT * from fletnix_user');

	// Resultaten per rij printen.
	foreach ($users as $row) {
	  print_r($row);
	}

	function formFilled() { 
		foreach($_POST as $field) {
			if($field == null)
				return false;
		}

		return true;
	}

	function getFormVars() {
		$fields = [];
		foreach($_POST as $key=>$field) {
			$fields[$key] = htmlspecialchars($field);
		}
		return $fields;
	}
?>
