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
 
// DB table to use
$table = 'protocolo';
 
// Table's primary key
$primaryKey = 'protocolo.IDPROTOCOLO';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'protocolo.IDPROTOCOLO', 'dt' => 0, 'Alias' => 'ID' ),
    array( 'db' => "(medico.Apellido || ', ' || medico.Nombre)",     'dt' => 1, 'Alias' => 'Medico' ),
    array( 'db' => "(paciente.Apellido || ', ' || paciente.Nombre)",   'dt' => 2, 'Alias' => 'Paciente' ),
    array( 'db' => 'protocolo.Localizacion',     'dt' => 3, 'Alias' => 'Localizacion' ),
    array( 'db' => 'hospital.nombre',     'dt' => 4, 'Alias' => 'Hospital' ),
    array(
        'db'        => 'protocolo.FechaEmision',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            if( $d != null) return date( 'd/m/Y', strtotime($d));
        },
        'Alias' => 'FechaOrden'
    )
);

$join = " Left Join paciente On paciente.ID = protocolo.IDPACIENTE
Left Join medico On medico.ID = protocolo.IDMedico 
Left Join hospital On hospital.ID = protocolo.IDHospital ";
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => 'ventormenta1',
    'db'   => 'patol',
    'host' => 'localhost'
); //????
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp-class-sqlite.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $join )
);