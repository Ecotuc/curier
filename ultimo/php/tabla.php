<div class="divcenter2">
		<table>
		  <thead>
			<tr>	
			  <th>Orden</th>
			  <th>Destinatario</th>
			  <th>Dirección</th>
			  <th>Destino</th>
			  <th>Origen</th>
			  <th>Precio</th>
			  <th>Tienda</th>
			</tr>
		  </thead>
		  <tbody>
			<?php
				$order=$_POST['orden'];
				$tienda=$_POST['tienda'];
		  		$dbconn = pg_connect("host=localhost dbname=curier user=postgres password=1998") or die('Could not connect: ' . pg_last_error());
				$query = "SELECT * FROM ordenes WHERE orden='$order' AND tienda='$tienda'";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error()); 
				while ($row = pg_fetch_row($result)){
					// Obtengo el origen de la tienda
					// echo $row[8];
					$query3 = "SELECT ido FROM tienda WHERE nombre='$row[8]'";
					$result3 = pg_query($query3) or die('Query failed: ' . pg_last_error()); 
					$row3=pg_fetch_row($result3);
					// echo $row3[0];
					// Obtengo el precio de la orden
					$query2 = "SELECT precio FROM costos WHERE idd='$row[5]' AND ido='$row3[0]'";
					$result2 = pg_query($query2) or die('Query failed: ' . pg_last_error()); 
					$row2=pg_fetch_row($result2);
				    echo "<tr>
				      <th scope=\"row\">$row[0]</th>
				      <td>$row[1]</td>
				      <td>$row[2]</td>
				      <td>$row[3]</td>
				      <td>$row[4]</td>
				      <td>$row2[0]</td>
				      <td>$row[8]</td>
				    </tr>";
				}
		  	?>
		  	
		  </tbody>
		</table>
	</div>