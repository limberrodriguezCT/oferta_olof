<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Matrícula 2027 - Centro Tecnológico Olof Palme</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased text-gray-800 font-sans" style="background-color: #EBE9E1; background-image: linear-gradient(to right, rgba(0,56,118,.05) 1px, transparent 1px), linear-gradient(to bottom, rgba(0,56,118,.05) 1px, transparent 1px); background-size: 40px 40px;">
    <header class="bg-white shadow-md py-3 border-b-4 border-[#8cc63f]">
        <div class="max-w-6xl mx-auto px-4 flex flex-wrap justify-between items-center gap-4">
            <a href="{{ route('inicio') }}"><img src="{{ asset('img/logo-ct.png') }}" alt="Centro Tecnológico Olof Palme" class="h-14 w-auto"></a>
            <a href="{{ route('inicio') }}" class="font-bold text-[#0089D0] hover:text-[#003876]">Volver al inicio</a>
        </div>
    </header>
    <main class="max-w-6xl mx-auto px-4 py-10 md:py-14">
        <div class="text-center flex flex-col items-center gap-4 mb-10">
            <span class="bg-[#8cc63f] text-white font-bold rounded-full px-5 py-2">Oferta académica 2027</span>
            <h1 class="text-3xl md:text-5xl font-black text-[#003876]">Hoja de <span class="text-[#0089D0]">matrícula</span></h1>
            <p class="max-w-2xl text-gray-600">Complete sus datos para solicitar su matrícula en el Centro Tecnológico Olof Palme. Los campos con <span class="text-[#E91E63] font-bold">*</span> son obligatorios.</p>
        </div>
        @if(session('matricula_success'))
            <div role="status" class="bg-green-50 text-green-800 border border-green-200 rounded-2xl p-6 mb-8">{{ session('matricula_success') }}</div>
        @endif
        @if($errors->any())
            <div role="alert" class="bg-red-50 text-red-800 border border-red-200 rounded-2xl p-6 mb-8">
                <p class="font-bold">Revise los campos indicados antes de enviar.</p>
                <ul class="list-disc pl-5 mt-2">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        @if($carreras->isEmpty())
            <div role="status" class="bg-white rounded-2xl p-8 text-center shadow-lg">Aún no hay especialidades disponibles para matrícula. Comuníquese con el centro para más información.</div>
        @else
        <form method="POST" action="{{ route('matriculas.store') }}" class="flex flex-col gap-8">
            @csrf
            <div class="bg-[#003876] text-white rounded-2xl p-6 flex flex-wrap justify-between gap-4 shadow-lg">
                <p><span class="block text-blue-200 text-sm">Centro tecnológico</span><strong>Olof Palme · Estelí</strong></p>
                <p><span class="block text-blue-200 text-sm">Fecha de solicitud</span><strong>{{ now('America/Managua')->format('d/m/Y') }}</strong></p>
            </div>
            <fieldset class="bg-white rounded-2xl shadow-xl border-t-4 border-[#0089D0] p-6 md:p-8 min-w-0">
                <legend class="sr-only">Datos personales del participante</legend>
                <div class="flex items-center gap-3 mb-6"><span class="flex shrink-0 items-center justify-center h-9 w-9 rounded-full bg-blue-50 text-[#0089D0] font-black">01</span><h2 class="text-xl md:text-2xl font-extrabold text-[#003876]">Datos personales del participante</h2></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-matricula-field name="becado_anteriormente" label="¿Ha sido becado anteriormente?" type="select" :options="['1' => 'Sí', '0' => 'No']" :required="true" />
                    <x-matricula-field name="fecha_nacimiento" label="Fecha de nacimiento" type="date" :required="true" />
                    <x-matricula-field name="nacionalidad" label="Nacionalidad" type="text" :required="true" />
                    <x-matricula-field name="documento_identidad" label="Cédula, pasaporte o cédula de residencia" type="text" />
                    <x-matricula-field name="primer_nombre" label="Primer nombre" type="text" :required="true" />
                    <x-matricula-field name="segundo_nombre" label="Segundo nombre" type="text" />
                    <x-matricula-field name="primer_apellido" label="Primer apellido" type="text" :required="true" />
                    <x-matricula-field name="segundo_apellido" label="Segundo apellido" type="text" />
                    <x-matricula-field name="sexo" label="Sexo" type="select" :options="['Femenino' => 'Femenino', 'Masculino' => 'Masculino']" :required="true" />
                    <x-matricula-field name="estado_civil" label="Estado civil" type="select" :options="['Soltero/a' => 'Soltero/a', 'Casado/a' => 'Casado/a', 'Unión de hecho estable' => 'Unión de hecho estable', 'Divorciado/a' => 'Divorciado/a', 'Viudo/a' => 'Viudo/a']" />
                    <x-matricula-field name="municipio_nacimiento" label="Municipio de nacimiento" type="text" :required="true" />
                    <x-matricula-field name="etnia" label="Etnia" type="text" />
                    <x-matricula-field name="departamento_domicilio" label="Departamento domiciliar" type="text" :required="true" />
                    <x-matricula-field name="municipio_domicilio" label="Municipio domiciliar" type="text" :required="true" />
                    <x-matricula-field name="direccion_domicilio" label="Dirección domiciliar" type="textarea" :required="true" />
                    <x-matricula-field name="area" label="Área" type="select" :options="['Urbana' => 'Urbana', 'Rural' => 'Rural']" :required="true" />
                    <x-matricula-field name="comunidad" label="Comunidad" type="text" />
                    <x-matricula-field name="telefono_celular" label="Teléfono celular" type="tel" :required="true" />
                    <x-matricula-field name="telefono_domiciliar" label="Teléfono domiciliar" type="tel" />
                    <x-matricula-field name="personas_hogar" label="Número de personas en el hogar" type="number" />
                    <x-matricula-field name="correo" label="Correo electrónico" type="email" />
                    <x-matricula-field name="profesion_oficio" label="Profesión u oficio" type="text" />
                    <x-matricula-field name="nivel_academico" label="Nivel académico" type="text" :required="true" />
                    <x-matricula-field name="anio_egreso_bachillerato" label="Año de egreso de bachillerato" type="number" />
                    <x-matricula-field name="modalidad_bachillerato" label="Modalidad de bachillerato" type="select" :options="['Bachillerato en el campo' => 'Bachillerato en el campo', 'Otras modalidades' => 'Otras modalidades', 'No aplica' => 'No aplica']" />
                    <x-matricula-field name="idiomas" label="Idiomas" type="text" />
                    <x-matricula-field name="discapacidad" label="Discapacidad (si aplica)" type="text" />
                    <x-matricula-field name="tipo_sangre" label="Tipo de sangre" type="select" :options="['A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-', 'Desconocido' => 'Desconocido']" />
                </div>
            </fieldset>
            <fieldset class="bg-white rounded-2xl shadow-xl border-t-4 border-[#0089D0] p-6 md:p-8 min-w-0">
                <legend class="sr-only">Datos laborales</legend>
                <div class="flex items-center gap-3 mb-6"><span class="flex shrink-0 items-center justify-center h-9 w-9 rounded-full bg-blue-50 text-[#0089D0] font-black">02</span><h2 class="text-xl md:text-2xl font-extrabold text-[#003876]">Datos laborales</h2></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-matricula-field name="trabaja_actualmente" label="¿Trabaja actualmente?" type="select" :options="['1' => 'Sí', '0' => 'No']" :required="true" />
                    <x-matricula-field name="empresa" label="Nombre de la empresa o emprendimiento" type="text" />
                    <x-matricula-field name="departamento_trabajo" label="Departamento" type="text" />
                    <x-matricula-field name="municipio_trabajo" label="Municipio" type="text" />
                    <x-matricula-field name="direccion_trabajo" label="Dirección del trabajo" type="textarea" />
                    <x-matricula-field name="telefono_trabajo" label="Teléfono del trabajo" type="tel" />
                    <x-matricula-field name="cargo" label="Cargo" type="text" />
                </div>
            </fieldset>
            <fieldset class="bg-white rounded-2xl shadow-xl border-t-4 border-[#0089D0] p-6 md:p-8 min-w-0">
                <legend class="sr-only">En caso de emergencia notificar a</legend>
                <div class="flex items-center gap-3 mb-6"><span class="flex shrink-0 items-center justify-center h-9 w-9 rounded-full bg-blue-50 text-[#0089D0] font-black">03</span><h2 class="text-xl md:text-2xl font-extrabold text-[#003876]">En caso de emergencia notificar a</h2></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-matricula-field name="emergencia_nombre" label="Nombre de la persona" type="text" :required="true" />
                    <x-matricula-field name="emergencia_parentesco" label="Parentesco" type="text" :required="true" />
                    <x-matricula-field name="emergencia_direccion" label="Dirección" type="textarea" />
                    <x-matricula-field name="emergencia_telefono" label="Teléfono" type="tel" :required="true" />
                </div>
            </fieldset>
            <fieldset class="bg-white rounded-2xl shadow-xl border-t-4 border-[#0089D0] p-6 md:p-8 min-w-0">
                <legend class="sr-only">Datos de la especialidad o curso a matricular</legend>
                <div class="flex items-center gap-3 mb-6"><span class="flex shrink-0 items-center justify-center h-9 w-9 rounded-full bg-blue-50 text-[#0089D0] font-black">04</span><h2 class="text-xl md:text-2xl font-extrabold text-[#003876]">Datos de la especialidad o curso a matricular</h2></div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="carrera_id" class="block text-sm font-bold text-[#003876] mb-2">Carrera <span class="text-[#E91E63]">*</span></label>
                        <select id="carrera_id" name="carrera_id" required class="w-full rounded-xl border-gray-300 bg-gray-50 focus:border-[#0089D0] focus:ring-[#0089D0]" aria-describedby="carrera_id-error">
                            <option value="">Seleccione una especialidad</option>
                            @foreach($carreras as $carrera)
                                <option value="{{ $carrera->id }}" @selected((string) old('carrera_id', request('carrera_id')) === (string) $carrera->id)>{{ $carrera->nombre }} — {{ $carrera->nivel_formacion }}</option>
                            @endforeach
                        </select>
                        <p id="carrera_id-error" class="text-sm text-red-600">@error('carrera_id'){{ $message }}@enderror</p>
                    </div>
                </div>
            </fieldset>
            <div class="flex flex-col items-center gap-4 text-center">
                <p class="text-sm text-gray-600 max-w-2xl">Revise su información antes de enviarla. La recepción de este formulario está sujeta a la verificación de requisitos y confirmación del centro.</p>
                <button type="submit" class="w-full md:w-auto bg-[#E91E63] hover:bg-pink-700 text-white font-bold px-12 py-4 rounded-xl shadow-lg transition">Enviar formulario de matrícula</button>
            </div>
        </form>
        @endif
    </main>
    <footer class="bg-[#003876] text-white py-8 text-center px-4"><p class="font-extrabold text-xl">Centro Tecnológico Olof Palme, Estelí</p><p class="text-blue-200 mt-2">Educación Técnica Gratuita y de Calidad.</p></footer>
</body>
</html>
