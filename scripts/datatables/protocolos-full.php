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
$table = 'protocolos';
 
// Table's primary key
$primaryKey = 'protocolos.Id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => 'protocolos.Id', 'dt' => 0, 'Alias' => 'Identificador' ),
    array( 'db' => "CONCAT(Medicos.Apellido, ', ', Medicos.Nombre)",     'dt' => 1, 'Alias' => 'Medico' ),
    array( 'db' => "CONCAT(Pacientes.Apellido, ', ', Pacientes.Nombre)",   'dt' => 2, 'Alias' => 'Paciente' ),
    array( 'db' => 'Partes.Nombre',     'dt' => 3, 'Alias' => 'Localizacion' ),
    array( 'db' => 'Hospitales.Nombre',     'dt' => 4, 'Alias' => 'Hospital' ),
    array(
        'db'        => 'protocolos.Cuando',
        'dt'        => 5,
        'formatter' => function( $d, $row ) {
            if( $d != null) return date( 'd/m/Y', strtotime($d));
        },
        'Alias' => 'FechaIngreso'
    ),
    array(
        'db'        => 'CONCAT(protocolos.Estado, "|", LEFT(protocolos.MailSend,1))',
        'dt'        => 6,
        'formatter' => function( $d, $row ) {
            $valores = explode('|', $d);
            switch( $valores[0] ) {
                case 0:
                    $ret = "<a style='text-decoration: none; color:#f48c50;' title='Caso sin cerrar'><i class='zmdi zmdi-lock-open zmdi-hc-fw'></i></a>";
                    break;
                case 1:
                    if( $valores[1] == "" ) {
                        $ret = "<a style='text-decoration: none; color:green;' title='Caso cerrado'><i class='zmdi zmdi-lock-outline zmdi-hc-fw'></i></a>";
                    } else {
                        $ret = "<a style='text-decoration: none; color:green;' title='Caso cerrado (Informe enviado por mail)'><i class='zmdi zmdi-email zmdi-hc-fw'></i></a>";
                    }
                    break;
                case 2:
                    $ret = "<a style='text-decoration: none; color:#c047e8;' title='Caso reabierto'><i class='zmdi zmdi-lock-open zmdi-hc-fw'></i></a>";
                    break;
            }
            
            $ret .= "</a>";
            return $ret;
        },
        'Alias' => 'Estado'
    ),
    array( 'db' => 'DiagPatol.Nombre',     'dt' => 7, 'Alias' => 'Diagnostico1' )
);

$join = " Left Join Pacientes On Pacientes.ID = protocolos.PacienteID 
Left Join Medicos On Protocolos.MedicoID = Medicos.ID 
Left Join Partes On Partes.ID = Protocolos.Localizacion 
Left Join Hospitales On Hospitales.ID = Protocolos.HospitalID 
Left Join DiagPatol On DiagPatol.ID = Protocolos.Tumor1 ";

// SQL server connection information
require( 'mysql-conn.php' );
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp-class.php' );

echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $join )
);