<html lang="en">
<style type="text/css">

.divTable{
	display: table;
	width: 100%;
	border-collapse: collapse;
}
.divTableRow {
	display: table-row;
}
.divTableHeading {
	display: table-header-group;
}
.divTableCell, {
	border: 1px solid #000;
	display: table-cell;
	padding: 3px 10px;
	font-weight: bold; font-size: 12px;
}
.divTableHeading {
	display: table-header-group;
	font-weight: bold;
}
.divTableFoot {
	display: table-footer-group;
	font-weight: bold;
}
.divTableBody {
	display: table-row-group;
}

.divTableCell1, {
	border: 1px solid #000;
	display: table-cell;
	padding: 3px 10px;
	font-weight: bold; font-size: 12px;
}

.divTableHead {
	border: 1px solid #000;
	display: table-cell;
	padding: 3px 10px;
	font-weight: bold; font-size: 12px;
	background-color: lightblue;
}

.div1 {
	display: inline-block; text-align: right;
}

table {
	width: 100%;
	border-collapse: collapse;
	text-align: center;
}

.td {
	width: 100%;
	border-collapse: collapse;
	border: 1px solid #000
}

</style>
<head>
	<title>Historia Clínica</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
	<body>

		<div>
			<div align="left" style="width: 50%;">
				<img src="/var/www/html/victal/public/victal.png"  style="width: 20%;"/>
			</div>

		</div>
		<div class="text-center title-header col-12">
			<center><strong>HISTORIA CLINICA</strong> </center>
		</div>
		<br>
		
		<div class="row">
			
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead">DATOS DEL PACIENTE</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 30%">Apellidos y Nombres</div>
						<div class="divTableCell" style="width: 70%">{{$paciente->apellidos}} {{$paciente->nombres}}</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 30%">Fecha de Nacimiento</div>
						<div class="divTableCell" style="width: 20%">{{$paciente->fechanac}};</div>
						<div class="divTableCell" style="width: 10%">Edad</div>
						<div class="divTableCell" style="width: 10%">{{$edad}}</div>
						<div class="divTableCell" style="width: 10%">DNI</div>
						<div class="divTableCell" style="width: 20%">{{$paciente->dni}}</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 30%">Domicilio actual</div>
						<div class="divTableCell" style="width: 70%">{{$paciente->direccion}}</div>
					</div>
				</div>
			</div>
			
		
		
	
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead"> HISTORIAL BASE</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 10%">ALERGIAS</div>
						<div class="divTableCell" style="width: 20%">{{$historias_base->alergias}}</div>
						<div class="divTableCell" style="width: 10%">ANTECEDENTES PERSONALES</div>
						<div class="divTableCell" style="width: 60%">{{$historias_base->ant_per}}</div>
					</div>
					<div class="divTableRow">
						<div class="divTableCell" style="width: 10%">ANTECEDENTES FAMILIARES</div>
						<div class="divTableCell" style="width: 40%">{{$historias_base->ant_fam}}</div>
						<div class="divTableCell" style="width: 10%">ANTECEDENTES PATOLÓGICOS</div>
						<div class="divTableCell" style="width: 40%">{{$historias_base->ant_pat}}</div>
					</div>
				</div>
			</div>
			
            <div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead"> DATOS DE CONSULTA</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 5%">FECHA</div>
						<div class="divTableCell" style="width: 15%">{{$hist->created_at}}</div>
						<div class="divTableCell" style="width: 10%">MOTIVO</div>
						<div class="divTableCell" style="width: 70%">{{$hist->motivo}}</div>
					</div>
				</div>
			</div>

            <div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead"> FUNCIONES VITALES</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 10%">P/A</div>
						<div class="divTableCell" style="width: 10%">{{$hist->pa}}</div>
						<div class="divTableCell" style="width: 10%">Pulso</div>
						<div class="divTableCell" style="width: 10%">{{$hist->pulso}}</div>
                        <div class="divTableCell" style="width: 10%">Temp</div>
						<div class="divTableCell" style="width: 10%">{{$hist->temp}}</div>
                        <div class="divTableCell" style="width: 10%">Talla</div>
                        <div class="divTableCell" style="width: 10%">{{$hist->talla}}</div>
                        <div class="divTableCell" style="width: 10%">Peso</div>
						<div class="divTableCell" style="width: 10%">{{$hist->peso}}</div>
					</div>
					
				</div>
			</div>

            <div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead"> FUNCIONES BIOLÓGICAS</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 10%">Apetito</div>
						<div class="divTableCell" style="width: 10%">{{$hist->apetito}}</div>
						<div class="divTableCell" style="width: 10%">Sed</div>
						<div class="divTableCell" style="width: 10%">{{$hist->sed}}</div>
                        <div class="divTableCell" style="width: 10%">Animo</div>
						<div class="divTableCell" style="width: 10%">{{$hist->animo}}</div>
                       
					</div>
				</div>
                <div class="divTableBody">
					    <div class="divTableRow">
                        <div class="divTableCell" style="width: 10%">Frec.Mic</div>
                        <div class="divTableCell" style="width: 10%">{{$hist->mic}}</div>
                        <div class="divTableCell" style="width: 10%">R/C</div>
						<div class="divTableCell" style="width: 10%">{{$hist->rc}}</div>
						<div class="divTableCell" style="width: 10%">Frec.Dep</div>
						<div class="divTableCell" style="width: 10%">{{$hist->dep}}</div>
					</div>
				</div>
			</div>
            <div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead"> ANTECEDENTES</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 10%">FUR</div>
						<div class="divTableCell" style="width: 10%">{{$hist->fur}}</div>
						<div class="divTableCell" style="width: 10%">PAP</div>
						<div class="divTableCell" style="width: 10%">{{$hist->pap}}</div>
                        <div class="divTableCell" style="width: 10%">MAC</div>
						<div class="divTableCell" style="width: 10%">{{$hist->mac}}</div>
                       
					</div>
				</div>
                <div class="divTableBody">
					    <div class="divTableRow">
                        <div class="divTableCell" style="width: 10%">Andria</div>
                        <div class="divTableCell" style="width: 10%">{{$hist->andria}}</div>
                        <div class="divTableCell" style="width: 10%">G</div>
						<div class="divTableCell" style="width: 10%">{{$hist->g}}</div>
						<div class="divTableCell" style="width: 10%">P</div>
						<div class="divTableCell" style="width: 10%">{{$hist->p}}</div>
					</div>
				</div>
			</div>

            <div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead"> EXAMEN FISICO REGIONAL</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 10%">Piel/Mucosas</div>
						<div class="divTableCell" style="width: 10%">{{$hist->piel}}</div>
						<div class="divTableCell" style="width: 10%">Mamas</div>
						<div class="divTableCell" style="width: 10%">{{$hist->mamas}}</div>
                        <div class="divTableCell" style="width: 10%">Abdomen</div>
						<div class="divTableCell" style="width: 10%">{{$hist->abdomen}}</div>
                       
					</div>
				</div>
                <div class="divTableBody">
					    <div class="divTableRow">
                        <div class="divTableCell" style="width: 10%">Genitales Externos</div>
                        <div class="divTableCell" style="width: 10%">{{$hist->ext}}</div>
                        <div class="divTableCell" style="width: 10%">Genitales Internos</div>
						<div class="divTableCell" style="width: 10%">{{$hist->int}}</div>
						<div class="divTableCell" style="width: 10%">Miembros Inferiores</div>
						<div class="divTableCell" style="width: 10%">{{$hist->miem}}</div>
					</div>
				</div>
			</div>
            <div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 10%">Evolución de Enfermedad</div>
						<div class="divTableCell" style="width: 40%">{{$hist->evo}}</div>
						<div class="divTableCell" style="width: 10%">Tipo de Enfermedad</div>
						<div class="divTableCell" style="width: 40%">{{$hist->tipo}}</div>
                      
					</div>
				</div>
                <div class="divTableBody">
                        <div class="divTableCell" style="width: 10%">Presunción Diagnóstica</div>
						<div class="divTableCell" style="width: 40%">{{$hist->pd}}</div>
						<div class="divTableCell" style="width: 10%">CIE X</div>
						<div class="divTableCell" style="width: 40%">{{$hist->cie}}</div>
				</div>
                
				</div>

            
			</div>
            <div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead"> EXAMENES AUXILIARES</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 10%">Servicios</div>
						<div class="divTableCell" style="width: 40%">{{$hist->ex_aux_s}}</div>
						<div class="divTableCell" style="width: 10%">Laboratorios</div>
						<div class="divTableCell" style="width: 40%">{{$hist->ex_aux_l}}</div>
                       
					</div>
				</div>
              
			</div>
            <div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead"> OSBSERVACIONES</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 100%">{{$hist->obser}}</div>
                       
					</div>
				</div>
              
			</div>

            <div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead"> OSBSERVACIONES REEVALUACIÓN</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 100%">{{$hist->observacion}}</div>
                       
					</div>
				</div>
              
			</div>

            <div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell divTableHead"> REEVALUADO POR:</div>
					</div>
				</div>
			</div>
			<div class="divTable">
				<div class="divTableBody">
					<div class="divTableRow">
						<div class="divTableCell" style="width: 100%">{{$hist->usuario_reevalua}}</div>
                       
					</div>
				</div>
              
			</div>
          
            
         
           
		</div>
	</body>
</html>

