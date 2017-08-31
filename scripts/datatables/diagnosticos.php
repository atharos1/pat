<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

$padre = "";
if( $_GET["Padre"] != "" ) $padre = "Padre = $_GET[Padre]";
 
// DB table to use
$table = 'diagpatol';
 
// Table's primary key
$primaryKey = 'diagpatol.Id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array(
        'db' => 'diagpatol.id',
        'dt' => 'DT_RowId',
        'Alias' => 'ID',
        'formatter' => function( $d, $row ) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
            return 'row_'.$d;
        }
    ),
    array( 'db' => "diagpatol.Nombre", 'dt' => 0, 'Alias' => 'Nombre' ),
    array( 'db' => "diagpatol.Codigo",   'dt' => 1, 'Alias' => 'Codigo' ),
);

$join="";

// SQL server connection information
require( 'mysql-conn.php' );
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp-class.php' );



echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $join, $padre )
);