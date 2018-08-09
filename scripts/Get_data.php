<?php
  /* MySQL connection */
	$gaSql['user']       = "root";
	$gaSql['password']   = "";
	$gaSql['db']         = "projet";
	$gaSql['server']     = "localhost";
	$gaSql['type']       = "mysql";
	
	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );
	
	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		die( 'Could not select database '. $gaSql['db'] );
	
	/* Paging */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	
	/* Ordering */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<mysql_real_escape_string( $_GET['iSortingCols'] ) ; $i++ )
		{
			$sOrder .= fnColumnToField(mysql_real_escape_string( $_GET['iSortCol_'.$i] ))."
			 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
		}
		$sOrder = substr_replace( $sOrder, "", -2 );
	}
	
	/* Filtrage - Remplace le filtrage côté client, peut donc être long si la base de données est importante
	 */
	$sWhere = "";
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE Designation LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ".
		                "Type LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ".
		                "Famille = '".mysql_real_escape_string( $_GET['sSearch'] )."' OR ".
		                "long = '".mysql_real_escape_string( $_GET['sSearch'] )."'";
	}
	
	$sQuery = "SELECT SQL_CALC_FOUND_ROWS ID_A, DESIGNATION, TYPE, FAMILLE, LONGUEUR,LARGEUR,
  EPAISSEUR FROM users $sWhere $sOrder $sLimit";
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	
	$sQuery = "SELECT FOUND_ROWS()";
	
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	$sQuery = "SELECT COUNT(ID_A)	FROM article";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	$sOutput = '{';
	$sOutput .= '"sEcho": '.intval($_GET['sEcho']).', ';
	$sOutput .= '"iTotalRecords": '.$iTotal.', ';
	$sOutput .= '"iTotalDisplayRecords": '.$iFilteredTotal.', ';
	$sOutput .= '"aaData": [ ';
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$sOutput .= "[";
		$sOutput .= '"'.addslashes($aRow['designation']).'",';
		$sOutput .= '"'.addslashes($aRow['Type']).'",';
		$sOutput .= '"'.addslashes($aRow['FAMILLE']).'",';
		$sOutput .= '"'.addslashes($aRow['LONGUEUR']).'",';
		$sOutput .= '"'.addslashes($aRow['LARGEUR']).'",';
		$sOutput .= '"'.addslashes($aRow['EPAISSEUR']).'",';
		$sOutput .= '"'.addslashes($aRow['SURFACE']).'",';
		$sOutput .= '"'.addslashes($aRow['EPAISSEUR']).'",';
		$sOutput .= '"'.addslashes(date('H:i d/m/Y', $aRow['inscription'])).'",';
		$sOutput .= '"'.addslashes($aRow['mail']).'"';
		$sOutput .= '"<a href="user.php?id=" '.$arow['id'].'="">Détails</a>"';
		$sOutput .= "],";
	}
	$sOutput = substr_replace( $sOutput, "", -1 );
	$sOutput .= '] }';
	
	echo $sOutput;
	
	
	function fnColumnToField( $i )
	{
		if ( $i == 0 )
			return "nom";
		else if ( $i == 1 )
			return "prenom";
		else if ( $i == 2 )
			return "inscription";
		else if ( $i == 3 )
			return "mail";
	}
?>
