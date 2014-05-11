<?php
$acItems = array();
$pcItems = array();
if (($mapHandle = fopen("DataSets/svg_map.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($mapHandle, 1000, ",")) !== FALSE) {
		$acItems[$data[1]]='ac'.$data[0];
		if(array_key_exists($data[2], $pcItems)) {
			array_push($pcItems[$data[2]], 'ac'.$data[0]);
		} else {
			$pcItems[$data[2]][0] = 'ac'.$data[0];
		}

	}
	fclose($mapHandle);
}

if($_GET['detail'] == 'ac' && $_GET['dataset'] == '2014' && $_GET['type'] == 'turnout') {
	if (($dataHandle = fopen("DataSets/Turnout/result_2014_AC_turnout.csv", "r")) !== FALSE) {
	    while (($data = fgetcsv($dataHandle, 1000, ",")) !== FALSE) {
        	echo $acItems[$data[1]].","."AC:".$data[1]." ".$data[2]."%".",".$data[2]."\n";
	    }
	    fclose($dataHandle);
	}
}
if($_GET['detail'] == 'pc' && $_GET['dataset'] == '2014' && $_GET['type'] == 'turnout') {
	if (($dataHandle = fopen("DataSets/Turnout/result_2014_AC_turnout.csv", "r")) !== FALSE) {
		$pcAvg = array();
		$pcCount = array();
	    while (($data = fgetcsv($dataHandle, 1000, ",")) !== FALSE) {
        	if(!array_key_exists($data[0],$pcAvg)) {
				$pcAvg[$data[0]] = 0;
				$pcCount[$data[0]] = 0;
        	}
			$pcAvg[$data[0]] += $data[2];
			$pcCount[$data[0]] += 1;
	    }
	    foreach($pcCount as $key => $value) {
	    	$pcAvg[$key]/=$value;
	    }
	    rewind($dataHandle);
	    while (($data = fgetcsv($dataHandle, 1000, ",")) !== FALSE) {
        	echo $acItems[$data[1]].","."PC:".$data[0]." ".$pcAvg[$data[0]]."%".",".$pcAvg[$data[0]]."\n";
	    }
	}
}
if($_GET['detail'] == 'pc' && $_GET['dataset'] == '2009' && $_GET['type'] == 'swing') {
	if (($dataHandle = fopen("DataSets/IndependentSwing/result_2009_PC_swing.csv", "r")) !== FALSE) {
	    while (($data = fgetcsv($dataHandle, 1000, ",")) !== FALSE) {
			foreach($pcItems[$data[0]] as $value) {
        		echo $value.","."SW:".$data[0]." ".$data[1]."%".",".$data[1]."\n";
			}
	    }
	}
}
if($_GET['detail'] == 'pc' && $_GET['dataset'] == 'trend' && $_GET['type'] == 'indcorr') {
	if (($dataHandle = fopen("DataSets/IndependentCorrelation/result_trend_PC_indcorr.csv", "r")) !== FALSE) {
	    while (($data = fgetcsv($dataHandle, 1000, ",")) !== FALSE) {
			foreach($pcItems[$data[0]] as $value) {
        		echo $value.","."CO:".$data[0]." ".$data[1]."%".",".$data[1]."\n";
			}
	    }
	}
}

?>