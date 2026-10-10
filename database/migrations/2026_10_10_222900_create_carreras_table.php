public function up(): void
{
    Schema::create('carreras', function (Blueprint $table) {
        $table->id();
        $table->string('nombre'); // Ej: Técnico Especialista en Entrenamiento Físico
        $table->string('nivel_formacion'); // Ej: Técnico Especialista, Técnico General
        $table->text('perfil_profesional');
        $table->text('cargos_ocupaciones');
        $table->string('duracion');
        $table->text('ambito_profesional');
        $table->text('requisitos'); // Para almacenar los requisitos específicos de la segunda imagen
        $table->string('imagen_ruta')->nullable();
        $table->string('video_url')->nullable(); // Enlace del video en YouTube
        $table->year('anio_academico'); // Escalabilidad (Ej: 2027, 2028)
        $table->timestamps();
    });
}