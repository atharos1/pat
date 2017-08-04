<?php

    require_once('../VerificarLogin.php');

    

    include('../../vendors/fpdf/fpdf.php');

    include('../../vendors/fpdi/fpdi.php'); 

 

    $ProtocoloID = $_GET["Protocolo"];

 

    include("conexion.php");

/*

    $pdf = new FPDF();

    $pdf->AddPage();

    $pdf->SetFont('Arial','B',16);

    $pdf->Cell(40,10,utf8_encode('¡Hola, Mundo!'));

    $pdf->Output();*/

 

    if($ProtocoloID > 85758) { //Protocolo nuevo

        $strSQL = "Select 

            p.ID as 'PacienteID', CONCAT(UPPER(p.Apellido), ', ', p.Nombre) as 'AyN', 

            p.DNI, 

            CASE WHEN p.Edad = '0' THEN CONCAT(DATE_FORMAT(p.Nacimiento, '%d/%m/%Y'), ' (',  TIMESTAMPDIFF(YEAR,p.Nacimiento,CURDATE()), ' años)') ELSE CONCAT('Desconocida (', p.Edad, ' años)') END as 'Nacimiento',

            CASE WHEN p.Sexo = 0 THEN 'Desconocido' WHEN p.Sexo = 1 THEN 'Masculino' WHEN p.Sexo = 2 THEN 'Femenino' END as 'Sexo', 

            p.Telefono, 

            p.Telefono2,

            obra.Nombre as 'Prepaga',

            p.NumPrepaga, 

            p. Observaciones as 'ObservacionesPac', 

            pro.Tumor1, 

            pro.Tumor2, 

            pro.Tumor1Duda, 

            pro.Tumor2Duda, 

            pro.DiagPresuntivo, 

            CASE pro.Imagenes WHEN 1 Then 'Sí' WHEN 0 Then 'No' END as 'Imagenes', pro.ImagenesObs, 

            DATE_FORMAT(pro.FechaOrden, '%d/%m/%Y') as FechaOrden, 

            DATE_FORMAT(pro.Cuando, '%d/%m/%Y') as FechaIngreso, 

            pro.DiagnosticoClinico, 

            CASE pro.Lado WHEN 0 Then NULL WHEN 1 Then 'izquierdo' WHEN 2 Then 'derecho' END as Lado, 

            p1.Nombre as 'TipoTumor', 

            p2.Nombre as 'Localizacion', 

            p3.Nombre as 'LocHueso', 

            h.Nombre as 'Hospital',

            CONCAT(UPPER(m.Apellido), ', ', m.Nombre) as 'Medico', 

            m.Matricula, 

            m.Telefono as 'MedTel', 

            m.Email 

            From Protocolos pro

            Left Join Pacientes p ON pro.PacienteID = p.ID 

            Left Join Prepagas obra ON p.Prepaga = obra.ID 

            Left Join Medicos m ON m.ID = pro.MedicoID 

            Left Join Hospitales h ON h.ID = pro.HospitalID 

            Left Join Partes p1 On p1.ID = pro.TipoTumor 

            Left Join Partes p2 On p2.ID = pro.Localizacion 

            Left Join Partes p3 On p3.ID = pro.LocHueso 

            Where pro.ID = $ProtocoloID";

            } else { //Protocolo viejo

                $strSQL = "Select 

            CONCAT(p.Apellido, ' ', p.Nombre) as 'AyN', 

            p.DNI, 

            CONCAT('Desconocida (Aprox. ', p.Edad, ' años)') as 'Nacimiento',

            p.Sexo, 

            p.Telefono, 

            p.Telefono2,

            obra.Nombre as 'Prepaga',

            '' as NumPrepaga, 

            pro.IdTumor1 as 'Tumor1', 

            pro.IdTumor2 as 'Tumor2', 

            pro.Tumor1Duda, 

            pro.Tumor2Duda, 

            DATE_FORMAT(pro.FechaEmision, '%d/%m/%Y') as FechaIngreso, 

            DATE_FORMAT(pro.FechaBiopsia, '%d/%m/%Y') as FechaOrden, 

            pro.DiagnosticoClinico, 

            '' as DiagPresuntivo, 

            pro.Lado, 

            CASE pro.TipoTumor WHEN 'B' THEN 'BONES AND JOINTS' WHEN 'S' THEN 'SOFT TISSUES' END as 'TipoTumor', 

            pro.Localizacion, 

            pro.LocalizacionHueso as 'LocHueso', 

            h.Nombre as 'Hospital',

            CONCAT(m.Apellido, ' ', m.Nombre) as 'Medico', 

            m.Matricula, 

            m.Telefono as 'MedTel', 

            m.Email 

            From v_Protocolos pro

            LEFT Join v_Pacientes p ON pro.IDPaciente = p.ID 

            LEFT Join v_Prepagas obra ON obra.ID = pro.IDCoberturaMedica 

            LEFT Join v_Medicos m ON m.ID = pro.IDMedico 

            LEFT Join v_Hospitales h ON h.ID = pro.IDHospital 

            Where pro.IDProtocolo = " . $ProtocoloID;

    }

 

    $query = mysqli_query($conn, $strSQL);


    if (!$query) {

        echo 'MySQL Error: ' . mysqli_error($conn);

        die;

    }

                    

    $valor = mysqli_fetch_assoc($query);

 

    if( $valor["PacienteID"] != 0 ) {
        $queryAnteriores = mysqli_query($conn, "Select group_concat(ID SEPARATOR ', ') as 'Anteriores' From 
            Protocolos WHERE PacienteID = $valor[PacienteID] AND Id <> $ProtocoloID");

        if (!$queryAnteriores) {
            echo 'MySQL Error: ' . mysqli_error($conn);
            die;
        }              

        $valorAnteriores = mysqli_fetch_assoc($queryAnteriores);
    } else {
        $valorAnteriores = null;
    }

 

    $Nombre = $valor['AyN'];

    $Nacimiento = $valor['Nacimiento'];

    $DNI = $valor['DNI'];

    $Telefono = $valor['Telefono'];

    $Telefono2 = $valor['Telefono2'];

    $Sexo = $valor['Sexo'];

    $Prepaga = $valor['Prepaga'];

    $PrepagaNum = $valor['NumPrepaga'];

    $Hospital  = $valor['Hospital'];

    $Medico  = $valor['Medico'];

    $Matricula  = $valor['Matricula'];

    $MedTel = $valor['MedTel'];

    $Email = $valor['Email'];

    $FOrden = $valor['FechaOrden'];

    $FIngreso = $valor['FechaIngreso'];

    $DiagnosticoClinico = $valor['DiagnosticoClinico'];

    $TipoTumor = $valor['TipoTumor'];

    $Localizacion = $valor['Localizacion'];

    $LocHueso = $valor['LocHueso'];

    $Lado = $valor['Lado'];

    $Presun = $valor['DiagPresuntivo'];

    $Imagenes = $valor['Imagenes'];

    $ImagenesObs = $valor['ImagenesObs'];

    $ObservacionesPac = $valor['ObservacionesPac'];

    $ProtocolosAnteriores = $valorAnteriores["Anteriores"];

 

    // initiate FPDI 

    $pdf =& new FPDI(); 

    // add a page 

    $pdf->AddPage(); 

    // set the sourcefile 

    $pdf->setSourceFile('../../Templates/protocolo.pdf'); 

    // import page 1 

    $tplIdx = $pdf->importPage(1); 

    // use the imported page as the template 

    $pdf->useTemplate($tplIdx, 0, 0); 

 

    // now write some text above the imported page 

 

    $y = 45;

    $yLinea= 5;

    $ySalto = 7;

    $xMargen = 13;

    $xMargenTexto = 20;

 

    //NRO PROTOCOLO

    $yViejo = $y;

    $y = $y + $ySalto;

 

    $pdf->SetXY($xMargenTexto + 120, $y); 

    $pdf->SetFont('times', 'B', '16');

    $pdf->Write(0, utf8_decode("PROTOCOLO #" . $ProtocoloID)); 

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->SetFont('times', 'B', '16');

    $pdf->Write(0, utf8_decode("INGRESO: " . $FIngreso)); 

 

    $y = $y + $ySalto;

 

    $pdf->Rect($xMargen + 120, $yViejo, 70, ($y - $yViejo) , 'D');

    //**NRO PROTOCOLO

 

    $y = $y + $yLinea;

 

    //DATOS PACIENTE

    $yViejo = $y;

    $y = $y + $ySalto;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->SetFont('times', 'B', '11');

    $pdf->Write(0, "Datos paciente"); 

 

    $pdf->SetFont('times', '', '10'); 

    $pdf->SetTextColor(0,0,0); 

    $y = $y + $ySalto;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Nombre: " . $Nombre . ".")); 

 

    $pdf->SetXY($xMargenTexto + 80, $y); 

    $pdf->Write(0, utf8_decode("DNI: " . $DNI . ".")); 

 

    $pdf->SetXY($xMargenTexto + 140, $y); 

    $pdf->Write(0, utf8_decode("Sexo: " . $Sexo . ".")); 

    $y = $y + $yLinea;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Fecha de nacimiento: " . $Nacimiento . ".")); 

 

    $pdf->SetXY($xMargenTexto + 80, $y); 

    $pdf->Write(0, utf8_decode("Teléfono 1: " . $Telefono . ".")); 

    $y = $y + $yLinea;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Cobertura: " . $Prepaga . " (Nro " . $PrepagaNum . ").")); 

 

    $pdf->SetXY($xMargenTexto + 80, $y); 

    $pdf->Write(0, utf8_decode("Teléfono 2: " . $Telefono2 . ".")); 

 

    if( $ObservacionesPac != "" ) { //Hay obs

        $y = $y + $yLinea;

 

        $pdf->SetXY($xMargenTexto, $y); 

        $pdf->Write(0, utf8_decode("Observaciones: " . $ObservacionesPac . "." )); 

    }

 

    $y = $y + $ySalto;

 

    $pdf->Rect($xMargen, $yViejo, 190, ($y - $yViejo) , 'D');

    //**DATOS PACIENTE

 

    $y = $y + $yLinea;

 

    //DATOS MÉDICO

    $yViejo = $y;

    $y = $y + $ySalto;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->SetFont('times', 'B', '11');

    $pdf->Write(0, "Enviado por"); 

 

    $pdf->SetFont('times', '', '10'); 

    $y = $y + $ySalto;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Médico: " . $Medico . ".")); 

 

    $pdf->SetXY($xMargenTexto + 80, $y); 

    $pdf->Write(0, utf8_decode("Matrícula: " . $Matricula . ".")); 

 

    $y = $y + $yLinea;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Teléfono de contacto: " . $MedTel . ".")); 

 

    $pdf->SetXY($xMargenTexto + 80, $y); 

    $pdf->Write(0, utf8_decode("Email: " . $Email . ".")); 

 

    $y = $y + $yLinea;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Fecha de orden: " . $FOrden . ".")); 

 

    $pdf->SetXY($xMargenTexto + 80, $y); 

    $pdf->Write(0, utf8_decode("Institución: " . $Hospital . ".")); 

 

    $y = $y + $yLinea;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Diagnóstico presuntivo: " . $Presun . ".")); 

 

    $y = $y + $ySalto;

 

    $pdf->Rect($xMargen, $yViejo, 190, ($y - $yViejo) , 'D');

    //**DATOS MÉDICO

 

    $y = $y + $yLinea;

 

    //DATOS CLÍNICOS

    $yViejo = $y;

    $y = $y + $ySalto;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->SetFont('times', 'B', '11');

    $pdf->Write(0, utf8_decode("Datos clínicos")); 

    $y = $y + $ySalto;

 

    $pdf->SetFont('times', '', '10'); 

 

    $textoLoc = $TipoTumor . ', ' . $Localizacion;

    if($LocHueso != '') $textoLoc = $textoLoc . ', ' . $LocHueso;

    if( $Lado ) $textoLoc = $textoLoc . ', lado ' . $Lado;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Localización: " . $textoLoc . ".")); 

    $y = $y + $yLinea;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Historial clínico: " . $DiagnosticoClinico . ".")); 

    $y = $y + $yLinea;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Protocolos anteriores: " . $ProtocolosAnteriores . ".")); 

    $y = $y + $ySalto;

 

    $pdf->Rect($xMargen, $yViejo, 190, ($y - $yViejo) , 'D');

    //**DATOS CLÍNICOS

 

    $y = $y + $yLinea;

 

    //MATENV

    $yViejo = $y;

    $y = $y + $ySalto;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->SetFont('times', 'B', '11');

    $pdf->Write(0, utf8_decode("Materiales recibidos")); 

    $y = $y + $ySalto;

 

    if($ProtocoloID >= 85759) { //Protocolo nuevo

 

    $pdf->SetFont('times', 'B', '10'); 

    $pdf->SetXY($xMargenTexto, $y);

    $pdf->Write(0, utf8_decode("Imágenes: ")); 

    $pdf->SetFont('times', '', '10'); 

    if( $ImagenesObs == NULL ) {

        $pdf->Write(0, utf8_decode($Imagenes . ".")); 

    } else {

        $pdf->Write(0, utf8_decode($Imagenes . " (" . $ImagenesObs . ")." )); 

    }

    

 

    $y = $y + $ySalto;

 

    $pdf->SetFont('times', 'B', '10'); 

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->Write(0, utf8_decode("Material")); 

 

    $pdf->SetXY($xMargenTexto + 34, $y); 

    $pdf->Write(0, utf8_decode("Cant")); 

 

    $pdf->SetXY($xMargenTexto + 50, $y); 

    $pdf->Write(0, utf8_decode("Fijado en")); 

 

    $pdf->SetXY($xMargenTexto + 74, $y); 

    $pdf->Write(0, utf8_decode("Obtenido por")); 

 

    $pdf->SetXY($xMargenTexto + 102, $y); 

    $pdf->Write(0, utf8_decode("Contenido")); 

 

    $pdf->SetXY($xMargenTexto + 142, $y); 

    $pdf->Write(0, utf8_decode("Observaciones")); 

 

    $y = $y + $ySalto;

 

    $pdf->SetFont('times', '', '10'); 

 

    $strSQL = "Select 

        ID, 

        Material as 'TipoMaterialID', 

        FijadoEn as 'FijadoEnID', 

        ObtenidoPor as 'ObtenidoPorID', 

        CASE WHEN Material = 1 Then 'Taco' 

        WHEN Material = 2 Then 'Frasco' 

        WHEN Material = 3 Then 'Preparado histológico' 

        WHEN Material = 4 Then 'Imágenes' 

        WHEN Material = 5 Then 'Frotis'

        WHEN Material = 6 Then 'Tubo'

        WHEN Material = 7 Then 'Sachet' END as 'TipoMaterial',

        Cantidad, 

        CASE WHEN FijadoEn = 1 Then 'Sin fijar' 

        WHEN FijadoEn = 2 Then 'Solución fisiológica' 

        WHEN FijadoEn = 3 Then 'Formol' 

        WHEN FijadoEn = 4 Then 'Alcohol' 

        WHEN FijadoEn = 5 Then 'Bouin' END as 'FijadoEn', 

        CASE WHEN ObtenidoPor = 1 Then 'Intraoperatoria' 

        WHEN ObtenidoPor = 2 Then 'Necrosis tumoral' 

        WHEN ObtenidoPor = 3 Then 'Punción' 

        WHEN ObtenidoPor = 4 Then 'Quirúrgica' END as 'ObtenidoPor',

        Contenido, 

        Obs 

        From MatEnv Where ProtocoloID = $ProtocoloID And Estado = 0";

 

    $query = mysqli_query($conn, $strSQL);

    if (!$query) {

        echo 'MySQL Error: ' . mysqli_error($conn);

    }

    $i = 0;

    while($row = mysqli_fetch_array($query)){

 

        $pdf->SetXY($xMargenTexto, $y); 

        $pdf->Write(0, utf8_decode($row["TipoMaterial"])); 

        

        $pdf->SetXY($xMargenTexto + 34, $y); 

        $pdf->Write(0, $row["Cantidad"]); 

        

        $pdf->SetXY($xMargenTexto + 50, $y); 

        $pdf->Write(0, utf8_decode($row["FijadoEn"])); 

        

        $pdf->SetXY($xMargenTexto + 74, $y); 

        $pdf->Write(0, utf8_decode($row["ObtenidoPor"])); 

        

        $pdf->SetXY($xMargenTexto + 102, $y); 

        $pdf->Write(0, utf8_decode($row["Contenido"])); 

 

        $pdf->SetXY($xMargenTexto + 142, $y); 

        $pdf->Write(0, utf8_decode($row["Obs"])); 

        

        $y = $y + $yLinea;

    } 

    } else { //Protocolo viejo

 

    $pdf->SetFont('times', '', '10'); 

 

    $strSQL = "Select MatEnv, FijadoEn, ObtenidoPor, CASE Iconografia WHEN 1 Then 'Si' WHEN 2 Then 'No' END as 'Iconografia', ElemAcom From v_Protocolos Where IDProtocolo = $ProtocoloID";

 

        $query = mysqli_query($conn, $strSQL);

    if (!$query) {

        echo 'MySQL Error: ' . mysqli_error($conn);

        die;

    }

                    

    $valor = mysqli_fetch_assoc($query);

 

        $pdf->SetXY($xMargenTexto, $y); 

        $pdf->Write(0, utf8_decode("Material enviado: " . $valor["MatEnv"] . ".")); 

        

        $pdf->SetXY($xMargenTexto + 80, $y); 

        $pdf->Write(0, utf8_decode("Fijado en: " . $valor["FijadoEn"] . ".")); 

        

        $y = $y + $yLinea;

        

        $pdf->SetXY($xMargenTexto, $y); 

        $pdf->Write(0, utf8_decode("Obtenido por: " . $valor["ObtenidoPor"] . ".")); 

        

        $pdf->SetXY($xMargenTexto + 80, $y); 

        $pdf->Write(0, utf8_decode("Elem. acompañan: " . $valor["ElemAcom"] . ".")); 

        

        $y = $y + $yLinea;

            

        $pdf->SetXY($xMargenTexto, $y); 

        $pdf->Write(0, utf8_decode("Iconografía: " . $valor["Iconografia"] . "."));  //revisar

        

        $y = $y + $ySalto;

    }

 

    $pdf->Rect($xMargen, $yViejo, 190, ($y - $yViejo) , 'D');

    //**MATENV

 

    $y = $y + $yLinea;

 

    //ESQUEMA

    $yViejo = $y;

    $y = $y + $ySalto;

 

    $pdf->SetXY($xMargenTexto, $y); 

    $pdf->SetFont('times', 'B', '11');

    $pdf->Write(0, utf8_decode("Macroscopía")); 

 

    $y = $y + $ySalto;

    $y = $y + $ySalto;

    $y = $y + $ySalto;

    $y = $y + $ySalto;

    $y = $y + $ySalto;

    $y = $y + $ySalto;

    $y = $y + $ySalto;

 

    $pdf->Rect($xMargen, $yViejo, 190, ($y - $yViejo) , 'D');

    //**ESQUEMA

 

    /*

    $pdf->SetFont('times');

    $pdf->SetXY(20, 95); 

    $pdf->MultiCell(0, 5, utf8_decode($Informe1), 0);

    */




    $pdf->SetTitle('Protocolo #' . $ProtocoloID);

    ob_end_clean();

    $pdf->Output('Protocolo ' . $ProtocoloID . '.pdf', 'I'); 

 

?>