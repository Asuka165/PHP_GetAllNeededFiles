//#################################################################################################################
// + Get all needed files in the directory
//=================================================================================================================
//	 - Attributes :
//			$dir 		: (String) Directory of the folder
//			$fileType	: (String/Integer/Array) File extension that should be included (Ex: array(".json",".csv")  OR ".php" )
//						  If all file type should be include, use array(".*") OR ".*"
//=================================================================================================================
// + Return : Files name in array
//#################################################################################################################	
function GetAllNeededFile($dir,$fileType){

	//==============================================================================================
	// + Convert String or integer $fileType into array form
	//==============================================================================================
	$fileType_type = gettype($fileType);
	if($fileType_type != "array"){$fileType = array($fileType);}

	//==============================================================================================
	// + Get all files in the directory
	//==============================================================================================
	$files_array = array_values(array_diff(scandir($dir), array('..', '.')));
	$files_count = count($files_array);

	//-----------------------------------------------------------
	// - STOP : if no files found in the folder 
	//-----------------------------------------------------------
	if($files_count == 0){return FALSE;}

	//-----------------------------------------------------------
	// - STOP : return all files if user request for all files
	//-----------------------------------------------------------
	if($fileType[0] == ".*"){return $files_array;}

	//==============================================================================================
	// + Removing any file that is not what we wanted
	//==============================================================================================
	$fileType_count = count($fileType);

	//--- Loop though every files in the folder -----
	for($file_x = 0; $file_x < $files_count; $file_x++){

		//--- Cache & Variable -----
		$this_file = $files_array[$file_x];
		$Needed = 0;

		//--- Check the files is wanted type or not -----
		for($type_x = 0; $type_x < $fileType_count; $type_x++){
			$WantedORNot = strpos($this_file,$fileType[$type_x]);
			if($WantedORNot !== FALSE){$Needed++;} 

		}

		//--- If not, remove it from array -----
		if($Needed == 0){$files_array = array_diff($files_array, array($this_file));}	

	} // END for (file loop)

	//==============================================================================================
	// + Re-ordering the array
	//==============================================================================================
	$files_array = array_values($files_array); // Re-order the number of array
	$files_count = count($files_array); // Re-Calculate the total file

	//-----------------------------------------------------------
	// - STOP : if no files left in array
	//-----------------------------------------------------------
	if($files_count == 0){return FALSE;}

	//-----------------------------------------------------------
	// - STOP : return the final result(array)
	//-----------------------------------------------------------
	else{return $files_array;}

}
