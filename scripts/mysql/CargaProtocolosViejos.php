<?php
	require_once('../VerificarLogin.php');

	$ProtocoloID = $_GET['ID'];
	
	/*$strSQL = "SELECT CONCAT(pac.Apellido, ', ', pac.Nombre) as Paciente, 
	CONCAT(m.Apellido, ', ', m.Nombre) as Medico, 
	h.Nombre as Hospital, 
	CASE p.TipoTumor WHEN 'S' Then 'Soft Tissues' WHEN 'B' Then 'Bones And Joints' END as TipoTumor, 
	p.Localizacion, p.LocalizacionHueso as 'LocHueso', p.Lado, 
    d1.Nombre as 'Tumor1', p.Tumor1Duda, d2.Nombre as 'Tumor2', p.Tumor2Duda, 
	p.DiagnosticoClinico as 'HistorialClinico', 
	DATE_FORMAT(p.FechaBiopsia, '%d/%m/%Y') as FechaOrden, 
	p.InformePrincipal as 'InformePrincipal', p.InformeComplementario as 'InformeComplementario', 

    p.MatEnv, p.FijadoEn, p.ObtenidoPor, p.ElemAcom, 
    CASE p.Iconografia WHEN 0 Then 'No' WHEN 1 Then 'Sí' END as Iconografia, 

    o.Nombre as 'Prepaga', o.Plan as 'Plan' 

	FROM v_Protocolos p 
	LEFT JOIN v_Pacientes pac On pac.Id = p.IDPaciente AND p.IDPaciente > '' 
	LEFT JOIN v_Medicos m On m.Id = p.IDMedico AND p.IDMedico > '' 
	LEFT JOIN v_Hospitales h On h.Id = p.IDHospital AND p.IDHospital > '' 
	LEFT JOIN diagpatol d1 On p.IdTumor1 = d1.Codigo AND p.IdTumor1 > '' 
	LEFT JOIN diagpatol d2 On p.IdTumor2 = d2.Codigo AND p.IdTumor2 > '' 
    LEFT JOIN v_Prepagas o On p.IDCoberturaMedica = o.ID AND p.IDCoberturaMedica > '' 

	WHERE p.ID = $ProtocoloID";*/

	$strSQL = "SELECT (pac.Apellido || ', ' || pac.Nombre) as Paciente, 
	(m.Apellido || ', ' || m.Nombre) as Medico, 
	h.Nombre as Hospital, 
	CASE p.TipoTumor WHEN 'S' Then 'Soft Tissues' WHEN 'B' Then 'Bones And Joints' END as TipoTumor, 
	p.Localizacion, p.LocalizacionHueso as 'LocHueso', p.Lado, 
    d1.Nombre as 'Tumor1', p.Tumor1Duda, d2.Nombre as 'Tumor2', p.Tumor2Duda, 
	p.DiagnosticoClinico as 'HistorialClinico', 
	strftime('%d/%m/%Y', p.FechaBiopsia), strftime('%d/%m/%Y', p.FechaEmision) as 'FechaIngreso', 
	p.InformePrincipal as 'InformePrincipal', p.InformeComplementario as 'InformeComplementario', 

    p.MatEnv, p.FijadoEn, p.ObtenidoPor, p.ElemAcom, 
    CASE p.Iconografia WHEN 0 Then 'No' WHEN 1 Then 'Sí' END as Iconografia, 

    o.Nombre as 'Prepaga', o.Plan as 'Plan' 

	FROM Protocolo p 
	LEFT JOIN Paciente pac On pac.ID = p.IDPaciente
	LEFT JOIN Medico m On m.ID = p.IDMedico
	LEFT JOIN Hospital h On h.ID = p.IDHospital
	LEFT JOIN Tumores d1 On p.IdTumor1 = d1.codigo
	LEFT JOIN Tumores d2 On p.IdTumor2 = d2.codigo
    LEFT JOIN CoberturaMedica o On p.IDCoberturaMedica = o.ID

	WHERE p.IDProtocolo = $ProtocoloID";

/*

	"SELECT (pac.Apellido || ', ' || pac.Nombre) as Paciente, 
	(m.Apellido || ', ' || m.Nombre) as Medico, 
	h.Nombre as Hospital, 
	CASE p.TipoTumor WHEN 'S' Then 'Soft Tissues' WHEN 'B' Then 'Bones And Joints' END as TipoTumor, 
	p.Localizacion, p.LocalizacionHueso as 'LocHueso', p.Lado, 
    d1.Nombre as 'Tumor1', p.Tumor1Duda, d2.Nombre as 'Tumor2', p.Tumor2Duda, 
	p.DiagnosticoClinico as 'HistorialClinico', 
	strftime('%d/%m/%Y', p.FechaBiopsia), 
	p.InformePrincipal as 'InformePrincipal', p.InformeComplementario as 'InformeComplementario', 

    p.MatEnv, p.FijadoEn, p.ObtenidoPor, p.ElemAcom, 
    CASE p.Iconografia WHEN 0 Then 'No' WHEN 1 Then 'Sí' END as Iconografia, 

    o.Nombre as 'Prepaga', o.Plan as 'Plan' 

	FROM Protocolo p 
	LEFT JOIN Paciente pac On pac.ID = p.IDPaciente
	LEFT JOIN Medico m On m.ID = p.IDMedico
	LEFT JOIN Hospital h On h.ID = p.IDHospital
	LEFT JOIN Tumores d1 On p.IdTumor1 = d1.codigo
	LEFT JOIN Tumores d2 On p.IdTumor2 = d2.codigo
    LEFT JOIN CoberturaMedica o On p.IDCoberturaMedica = o.ID

	WHERE p.IDProtocolo = 40468"

*/

	//require("conexion.php");

	$file_db = new PDO( 
    'sqlite:../../patologia.sqlite', 
    null, 
    null, 
    array(PDO::ATTR_PERSISTENT => false) 
); 

	//$query = mysqli_query($conn, $strSQL);
	$sth = $file_db->prepare($strSQL);
    $sth->execute();

    $row = $sth->fetch(PDO::FETCH_ASSOC);
	//$row = $file_db->query($strSQL);



	/*if (!$query) {
		echo 'MySQL Error: ' . mysqli_error($conn);
		die;
	}*/
		
	//$dataArray = array();
	//$row = mysqli_fetch_assoc($query);

	echo json_encode($row);