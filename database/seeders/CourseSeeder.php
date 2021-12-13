<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'nombre' => 'Desarrollo seguro de aplicaciones',
                'descripcion' => 'La seguridad en los productos software constituye una propiedad determinada por la unión de múltiples factores a lo largo del proceso de desarrollo, desde su misma concepción hasta la baja del producto.
                En este ámbito, nos enfrentamos a riesgos como la inyección de código, inclusión de archivos con malware y denegación de servicio, entre otros.
                El software cada vez se construye de forma más compleja y se diseña con una mayor necesidad de componentes externos. Todo esto, ha llevado a la creación de ciclos de desarrollo de software conocidos como Secure SDLC o Seguridad en el Ciclo de Vida del Software.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'nombre' => 'Gestión de ventas con big data',
                'descripcion' => 'El análisis de datos se ha vuelto una práctica corriente en las empresas líderes, ya que les aporta información valiosa, sobre todo de sus clientes potenciales, de esta manera, pueden preparar campañas o estrategias de marketing específicas con la finalidad de fidelizar y captar nuevos clientes, pero también incrementar ventas. Uno de los puestos más demandados actualmente son perfiles profesionales que sepan aplicar técnicas y herramientas necesarias para el análisis y extracción de datos, para así ser capaces de identificar en medio de miles de datos, aquella información que sea más relevante para la empresa.
                Con esta diplomatura, los alumnos serán capaces de estructurar los datos masivos que genera una empresa en la era digital, convertirlos en dashboards informativos para una gestión Data Driven y desarrollar algoritmos predictivos que ayuden a automatizar la toma de decisiones.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'nombre' => 'Seguridad Pública',
                'descripcion' => 'Con un estudio interdisciplinario teórico-práctico, se presenta esta disciplina como un ámbito de reflexión, formación y opinión para hacer conocer a la sociedad que existe un servidor público, en materia de seguridad, profesional y comprometido con su comunidad.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'nombre' => 'Estrategia de ciberseguridad e inteligencia e cibercrimen',
                'descripcion' => 'El Diplomado en Estrategia de Ciberseguridad e Inteligencia en Cibercrimen debe saber aplicar adecuadamente elementos tecnológicos tales como técnicas criptográficas, modelos formales de seguridad, arquitectura de computadores, sistemas operativos y redes, análisis forense, procedimientos investigativos, como así también habilidades y herramientas gerenciales de planificación estratégica, gestión y tratamiento de los activos y su riesgo asociado, continuidad de las operaciones, manejo de incidentes, recursos humanos, auditoria, e incluso la adecuada comprensión de los aspectos legales y regulatorios, tanto en el ámbito nacional como internacional.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]
        ]);
    }
}
