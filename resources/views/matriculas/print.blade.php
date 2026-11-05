<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Hoja de matrícula {{ $matricula->anio_academico }} - {{ $matricula->primer_nombre }} {{ $matricula->primer_apellido }}</title>
    <style>
        @page { size: A4 portrait; margin: 10mm; }
        * { box-sizing: border-box; }
        body { margin: 0; background: #e5e7eb; color: #111; font-family: "Times New Roman", serif; }
        .toolbar { max-width: 210mm; margin: 20px auto; padding: 16px; background: white; border-radius: 12px; font: 14px Arial, sans-serif; display: flex; align-items: center; flex-wrap: wrap; gap: 12px; }
        .toolbar a { color: #003876; } .toolbar p { flex: 1 1 300px; margin: 0; }
        .toolbar button { border: 0; border-radius: 8px; padding: 12px 20px; background: #0089d0; color: white; font-weight: bold; cursor: pointer; }
        .paper { width: 210mm; min-height: 297mm; padding: 10mm; margin: 0 auto 20px; background: white; box-shadow: 0 2px 14px #0002; font-size: 9pt; }
        .masthead { height: 12mm; display: flex; justify-content: space-between; align-items: flex-start; }
        .masthead img { height: 12mm; object-fit: contain; }
        .logo-gobierno { width: 48mm; object-position: left top; }
        .logo-inatec { width: 23mm; object-position: right top; }
        h1 { font: bold 15pt Arial, sans-serif; text-align: center; margin: 1mm 0 4mm; }
        h2 { font-size: 10.5pt; font-weight: normal; text-align: center; background: #ccc; margin: 1mm 0; padding: 1mm 0; break-after: avoid; print-color-adjust: exact; -webkit-print-color-adjust: exact; }
        .row { display: flex; align-items: flex-end; gap: 1mm; min-height: 6.2mm; padding-bottom: 1mm; break-inside: avoid; }
        .field { display: flex; align-items: baseline; gap: 1mm; flex-basis: 0; min-width: 0; }
        .label { flex-shrink: 0; } .value { flex: 1; min-width: 5mm; min-height: 4mm; border-bottom: .2mm solid #666; padding: 0 1mm .3mm; font-size: 9pt; overflow-wrap: anywhere; }
        .continuation { border-bottom: .2mm solid #666; height: 5mm; margin-bottom: 1mm; }
        .checks { display: flex; align-items: center; gap: 5mm; min-height: 7mm; font-size: 8.5pt; }
        .check { display: inline-flex; align-items: center; gap: 2mm; } .box { width: 4mm; height: 4mm; border: .2mm solid #777; display: inline-flex; align-items: center; justify-content: center; font: 9pt Arial, sans-serif; }
        .documents { display: flex; flex-wrap: wrap; justify-content: space-around; gap: 3mm; padding: 3mm 0; font-size: 8pt; }
        .notes-bar { height: 5mm; background: #ccc; print-color-adjust: exact; -webkit-print-color-adjust: exact; }
        .signatures { display: flex; justify-content: space-between; gap: 32mm; margin-top: 8mm; text-align: center; font-size: 10pt; break-inside: avoid; }
        .signatures div { flex: 1; border-top: .2mm solid #555; padding-top: 1mm; }
        @media screen and (max-width: 800px) { .toolbar { margin: 12px; } .preview { overflow-x: auto; } }
        @media print { body { background: white; } .toolbar { display: none !important; } .paper { width: 190mm; min-height: 0; padding: 0; margin: 0; box-shadow: none; } }
    </style>
</head>
<body>
    <div class="toolbar">
        <a href="{{ route('matriculas.index') }}">Volver a matrículas</a>
        <p>A4 · Vertical · Escala 100 %. Desactive los encabezados y pies de página del navegador. Los campos sin datos quedan en blanco para completarlos a mano.</p>
        <button type="button" onclick="window.print()">Imprimir hoja</button>
    </div>
    <main class="preview"><article class="paper" aria-label="Hoja de matrícula">
        <div class="masthead">
            <img class="logo-gobierno" src="{{ asset('img/logo-gobierno.png') }}" alt="Gobierno de Reconciliación y Unidad Nacional">
            <img class="logo-inatec" src="{{ asset('img/logo-inatec.png') }}" alt="INATEC - Tecnológico Nacional">
        </div>
        <h1>HOJA DE MATRICULA {{ $matricula->anio_academico }}</h1>
        <div class="row"><x-matricula-print-field label="CENTRO TECNOLÓGICO:" :value="$matricula->centro_tecnologico" /></div>
        <div class="row"><x-matricula-print-field label="FECHA:" :value="$matricula->fecha_matricula?->format('d/m/Y')" /></div>
        <h2>DATOS PERSONALES DEL PARTICIPANTE</h2>
        <div class="row"><x-matricula-print-field label="HA SIDO BECADO ANTERIORMENTE SI/NO:" :value="$matricula->becado_anteriormente ? 'SÍ' : 'NO'" :grow="1.1" /><x-matricula-print-field label="FECHA DE NACIMIENTO:" :value="$matricula->fecha_nacimiento?->format('d/m/Y')" /></div>
        <div class="row"><x-matricula-print-field label="NACIONALIDAD:" :value="$matricula->nacionalidad" :grow="0.7" /><x-matricula-print-field label="PASAPORTE O CÉDULA DE RESIDENCIA:" :value="$matricula->documento_identidad" :grow="1.3" /></div>
        <div class="row"><x-matricula-print-field label="PRIMER NOMBRE:" :value="$matricula->primer_nombre" /><x-matricula-print-field label="SEGUNDO NOMBRE:" :value="$matricula->segundo_nombre" /></div>
        <div class="row"><x-matricula-print-field label="PRIMER APELLIDO:" :value="$matricula->primer_apellido" /><x-matricula-print-field label="SEGUNDO APELLIDO:" :value="$matricula->segundo_apellido" /></div>
        <div class="row"><x-matricula-print-field label="SEXO:" :value="$matricula->sexo" :grow="0.5" /><x-matricula-print-field label="ESTADO CIVIL:" :value="$matricula->estado_civil" :grow="0.8" /><x-matricula-print-field label="MUNICIPIO DE NACIMIENTO:" :value="$matricula->municipio_nacimiento" :grow="1.4" /></div>
        <div class="row"><x-matricula-print-field label="ETNIA:" :value="$matricula->etnia" :grow="0.6" /><x-matricula-print-field label="DEPARTAMENTO DOMICILIAR:" :value="$matricula->departamento_domicilio" :grow="1.4" /></div>
        <div class="row"><x-matricula-print-field label="MUNICIPIO DOMICILIAR:" :value="$matricula->municipio_domicilio" :grow="0.9" /><x-matricula-print-field label="DIRECCIÓN DOMICILIAR:" :value="$matricula->direccion_domicilio" :grow="1.1" /></div>
        <div class="continuation"></div>
        <div class="row"><x-matricula-print-field label="ÁREA (URBANO/RURAL):" :value="$matricula->area" /><x-matricula-print-field label="COMUNIDAD:" :value="$matricula->comunidad" /></div>
        <div class="row"><x-matricula-print-field label="TELÉFONO CELULAR:" :value="$matricula->telefono_celular" /><x-matricula-print-field label="TELÉFONO DOMICILIAR:" :value="$matricula->telefono_domiciliar" /></div>
        <div class="row"><x-matricula-print-field label="N° DE PERSONAS EN EL HOGAR:" :value="$matricula->personas_hogar" :grow="0.9" /><x-matricula-print-field label="CORREO:" :value="$matricula->correo" :grow="1.2" /><x-matricula-print-field label="PROFESIÓN U OFICIO:" :value="$matricula->profesion_oficio" /></div>
        <div class="row"><x-matricula-print-field label="NIVEL ACADÉMICO:" :value="$matricula->nivel_academico" /><x-matricula-print-field label="AÑO DE EGRESO BACHILLERATO:" :value="$matricula->anio_egreso_bachillerato" /></div>
        <div class="checks"><span class="check">BACHILLERATO EN EL CAMPO: <span class="box">{{ $matricula->modalidad_bachillerato === 'Bachillerato en el campo' ? 'X' : '' }}</span></span><span class="check">OTRAS MODALIDADES: <span class="box">{{ $matricula->modalidad_bachillerato === 'Otras modalidades' ? 'X' : '' }}</span></span></div>
        <div class="row"><x-matricula-print-field label="IDIOMAS:" :value="$matricula->idiomas" /><x-matricula-print-field label="DISCAPACIDAD:" :value="$matricula->discapacidad" /><x-matricula-print-field label="TIPO DE SANGRE:" :value="$matricula->tipo_sangre" :grow="0.7" /></div>
        <h2>DATOS LABORALES</h2>
        <div class="row"><x-matricula-print-field label="TRABAJA ACTUALMENTE:" :value="$matricula->trabaja_actualmente ? 'SÍ' : 'NO'" :grow="0.7" /><x-matricula-print-field label="NOMBRE DE LA EMPRESA O EMPRENDIMIENTO:" :value="$matricula->empresa" :grow="1.3" /></div>
        <div class="row"><x-matricula-print-field label="DEPARTAMENTO:" :value="$matricula->departamento_trabajo" /><x-matricula-print-field label="MUNICIPIO:" :value="$matricula->municipio_trabajo" /></div>
        <div class="row"><x-matricula-print-field label="DIRECCIÓN:" :value="$matricula->direccion_trabajo" /></div>
        <div class="row"><x-matricula-print-field label="TELÉFONO:" :value="$matricula->telefono_trabajo" :grow="0.8" /><x-matricula-print-field label="CARGO:" :value="$matricula->cargo" :grow="1.2" /></div>
        <h2>EN CASO DE EMERGENCIA NOTIFICAR A</h2>
        <div class="row"><x-matricula-print-field label="NOMBRE DE LA PERSONA:" :value="$matricula->emergencia_nombre" :grow="1.4" /><x-matricula-print-field label="PARENTESCO:" :value="$matricula->emergencia_parentesco" :grow="0.6" /></div>
        <div class="row"><x-matricula-print-field label="DIRECCIÓN:" :value="$matricula->emergencia_direccion" :grow="1.4" /><x-matricula-print-field label="TELÉFONO:" :value="$matricula->emergencia_telefono" :grow="0.6" /></div>
        <h2>DATOS DE LA ESPECIALIDAD O CURSO A MATRICULAR</h2>
        <div class="row"><x-matricula-print-field label="DEPARTAMENTO:" :value="$matricula->departamento_curso" /><x-matricula-print-field label="MUNICIPIO:" :value="$matricula->municipio_curso" /></div>
        <div class="row"><x-matricula-print-field label="COMUNIDAD:" :value="$matricula->comunidad_curso" :grow="0.8" /><x-matricula-print-field label="NOMBRE DE LA ESCUELA:" :value="$matricula->escuela" :grow="1.2" /></div>
        <div class="row"><x-matricula-print-field label="PROGRAMA O ESTRATEGIA:" :value="$matricula->programa_estrategia" :grow="1.4" /><x-matricula-print-field label="TURNO:" :value="$matricula->turno" :grow="0.6" /></div>
        <div class="row"><x-matricula-print-field label="NOMBRE DE LA ESPECIALIDAD O CURSO:" :value="$matricula->carrera_nombre" /></div>
        <h2>DOCUMENTOS PRESENTADOS</h2>
        <div class="documents">
            <span class="check">CERTIFICADO DE NOTA <span class="box">{{ in_array('certificado_notas', $matricula->documentos ?? [], true) ? 'X' : '' }}</span></span>
            <span class="check">FOTOCOPIA DE CÉDULA <span class="box">{{ in_array('fotocopia_cedula', $matricula->documentos ?? [], true) ? 'X' : '' }}</span></span>
            <span class="check">CERTIFICADO O DIPLOMA DE 6TO GRADO <span class="box">{{ in_array('diploma_sexto_grado', $matricula->documentos ?? [], true) ? 'X' : '' }}</span></span>
            <span class="check">FOTOCOPIA DE PARTIDA DE NACIMIENTO <span class="box">{{ in_array('partida_nacimiento', $matricula->documentos ?? [], true) ? 'X' : '' }}</span></span>
            <span class="check">CERTIFICADO O DIPLOMA DE 5TO AÑO <span class="box">{{ in_array('diploma_quinto_anio', $matricula->documentos ?? [], true) ? 'X' : '' }}</span></span>
            <span class="check">FOTOGRAFÍA <span class="box">{{ in_array('fotografia', $matricula->documentos ?? [], true) ? 'X' : '' }}</span></span>
        </div>
        <div class="notes-bar"></div><div class="continuation"></div><div class="continuation"></div>
        <div class="signatures"><div>FIRMA DEL PROTAGONISTA</div><div>FIRMA DE REGISTRO</div></div>
    </article></main>
</body>
</html>
