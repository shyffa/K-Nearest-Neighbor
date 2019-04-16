<?php

  // DATA TRAIN
  $i=0;
  if (($handle = fopen("DataTrain_Tugas3_AI.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $data_set[$i] = $data;
      $i++;
    }
  }
  fclose($handle);

  //DATA TEST
  $i=0;
  if ( ($handle = fopen("DataTest_Tugas3_AI.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $data_test[$i] = $data;
      $i++;
    }
  }
  fclose($handle);

  for ($i=1; $i <= 200 ; $i++) {
    //menghitung jarak
		for ($x=1; $x <= 800; $x++) {
			$data_hasil[$x][0] = sqrt( pow(($data_test[$i][1] - $data_set[$x][1]),2) + pow(($data_test[$i][2] - $data_set[$x][2]),2) + pow(($data_test[$i][3] - $data_set[$x][3]),2) + pow(($data_test[$i][4] - $data_set[$x][4]),2) + pow(($data_test[$i][5] - $data_set[$x][5]),2) );
			$data_hasil[$x][1] = $data_set[$x][6];
		}

		$nol = 0;
		$satu = 0;
		$dua = 0;
		$tiga = 0;
    $a = 0;

    //mengurutkan data dari yag terkecil ke terbesar
		sort($data_hasil);

    //memvoting nilai y yg palig banya. nilai z = 12 yg artinya nilai k = 12
		for ($z=0; $z <= 11 ; $z++) {
			if ($data_hasil[$z][1] == 0) {
				$nol = $nol+1;
			}
			else if ($data_hasil[$z][1] == 1) {
				$satu = $satu+1;
			}
			else if ($data_hasil[$z][1] == 2) {
				$dua = $dua+1;
			}
			else {
				$tiga = $tiga+1;
			}
		}

    //memberikan keputusan kelas(y) yang didapat oleh datatest
		if  ( ( $nol > $satu ) && ( $nol > $dua ) && ( $nol > $tiga )){
			$kelas[$i] = "0";
      // if (($data_akurasi[$i][0]) == ($kelas[$i])) {
      //   $a = $a + 1;
      //    $data_test[$i][7] = 'sama';
      // }
      // else {
      //    $data_test[$i][7] = 'tidak';
      // }
		} else if ( ( $satu > $nol ) && ( $satu > $dua ) && ( $satu > $tiga )){
			$kelas[$i] ="1";
      // if (($data_akurasi[$i][0]) == ($kelas[$i])) {
      //   $a = $a + 1;
      //    $data_test[$i][7] = 'sama';
      // }
      // else {
      //    $data_test[$i][7] = 'tidak';
      // }
		}
		else if ( ( $dua > $nol ) && ( $dua > $satu ) && ( $dua > $tiga )){
			$kelas[$i] ="2";
      // if (($data_akurasi[$i][0]) == ($kelas[$i])) {
      //   $a = $a + 1;
      //   $data_test[$i][7] = 'sama';
      // }
      // else {
      //   $data_test[$i][7] = 'tidak';
      // }
		}
		else if ( ( $tiga > $nol ) && ( $tiga > $satu ) && ( $tiga > $dua )){
			$kelas[$i] ="3";
      // if (($data_akurasi[$i][0]) == ($kelas[$i])) {
      //   $a = $a + 1;
      //   $data_test[$i][7] = 'sama';
      // }
      // else {
      //   $data_test[$i][7] = 'tidak';
      // }
		}
    else if ( ( $satu >= $nol )){
      $kelas[$i] = rand(0,1);
      // if (($data_akurasi[$i][0]) == ($kelas[$i])) {
      //   $a = $a + 1;
      //   $data_test[$i][7] = 'sama';
      // }
      // else {
      //   $data_test[$i][7] = 'tidak';
      // }
    }
    else if ( ( $dua > $nol ) && ( $dua >= $satu )){
      $kelas[$i] = rand(1,2);
      // if (($data_akurasi[$i][0]) == ($kelas[$i])) {
      //   $a = $a + 1;
      //   $data_test[$i][7] = 'sama';
      // }
      // else {
      //   $data_test[$i][7] = 'tidak';
      // }
    }
    else if ( ( $tiga > $nol ) && ( $tiga >= $satu ) && ( $tiga >= $dua )){
			$kelas[$i] = rand(1,3);
      // if (($data_akurasi[$i][0]) == ($kelas[$i])) {
      //   $a = $a + 1;
      //   $data_test[$i][7] = 'sama';
      // }
      // else {
      //   $data_test[$i][7] = 'tidak';
      // }
    }
    else {
      $kelas[$i] = rand(0,3);
      // if (($data_akurasi[$i][0]) == ($kelas[$i])) {
      //   $a = $a + 1;
      //   $data_test[$i][7] = 'sama';
      // }
      // else {
      //   $data_test[$i][7] = 'tidak';
      // }
    }
    // $k = $k + $a;
    // $akurasi = $k / 2;
    $hasil[$i]['kelas'] = $kelas[$i];
	 }

   //mengouputkan hasil ke dalam file TebakanTugas3.csv
   $header = array("kelas");
 	 $fp = fopen("TebakanTugas3.csv", "w");
 	 fputcsv ($fp, $header, ","," ");
 	 foreach($hasil as $row)
 	 {
 	   fputcsv($fp, $row,","," ");
   }
 	 fclose($fp);
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>TUPRO 3 AI </title>
 		<style type="text/css">
 		td {
 			text-align: center;
 		}
 	</style>
 </head>
 <body>
 	<h1>DATA TEST</h1>
 	<table border="1px solid black" width="40%">
 	  <tr>
 			<th>No</th>
 	  	<th>X1</th>
 	  	<th>X2</th>
 	    <th>X3</th>
 	    <th>X4</th>
 	    <th>X5</th>
 	    <th>Kelas</th>
      <!-- <th>kelasawal</th>
      <th>akurasi</th>
      <th>sama</th> -->
 	  </tr>

 	  <?php
 	  	for ($i=1; $i <= 200 ; $i++) {
 	  		echo "<tr >
 						<td>".$data_test[$i][0]."</td>
 	  				<td>".$data_test[$i][1]."</td>
 				    <td>".$data_test[$i][2]."</td>
 				    <td>".$data_test[$i][3]."</td>
 				    <td>".$data_test[$i][4]."</td>
 						<td>".$data_test[$i][5]."</td>
 						<td>".$kelas[$i]."</td>
 				  </tr>";
 	  	}
 	  ?>
 	</table>
  K optimum = 12 <br>
 </body>
 </html>
 <!-- <td>".$data_akurasi[$i][0]."</td>
 <td>".$akurasi." %</td>
 <td>".$data_test[$i][7]."</td> -->
