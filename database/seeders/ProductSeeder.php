<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $cats  = DB::table('categories')->pluck('id', 'nombre');
        $types = DB::table('product_types')->pluck('id', 'slug');
        $styles = DB::table('styles')->pluck('id', 'nombre');

        // ═══════════════════════════════════════════════════════
        // HELPERS — evitan repetir los detalles comunes
        // ═══════════════════════════════════════════════════════

        // Detalles estándar para un producto DIGITAL
        $detallesDigital = fn(string $archivos, string $formato) => [
            'archivos_incluidos' => $archivos,
            'formato'            => $formato,
            'resolucion'         => '300 DPI',
            'tamano_papel'       => 'A4 / Carta',
            'idioma'             => 'Español',
            'editable'           => str_contains($formato, 'Canva') ? 'Sí, en Canva' : 'No',
            'licencia'           => 'Uso personal (1 evento)',
            'actualizaciones'    => 'Acceso de por vida',
            'soporte'            => 'Email 24–48h',
        ];

        // Detalles estándar para un producto FÍSICO (Lanzarote)
        $detalesFisico = fn(string $material, string $medidas, string $acabado) => [
            'material'        => $material,
            'medidas'         => $medidas,
            'acabado'         => $acabado,
            'personalizacion' => 'Nombre + edad incluidos',
            'plazo_entrega'   => '2–4 días laborables en Lanzarote',
            'zona_entrega'    => 'Lanzarote (Canarias, España)',
            'embalaje'        => 'Caja protectora incluida',
            'minimo_pedido'   => '1 unidad',
        ];

        $productos = [

            // ═══════════════════════════════════════════════════
            // 🎂 CUMPLEAÑOS — DIGITALES
            // ═══════════════════════════════════════════════════

            [
                'category_id'      => $cats['Cumpleaños'],
                'product_type_id'  => $types['fiesta'],
                'style_id'         => $styles['Kawaii'],
                'nombre'           => 'Kit Cumpleaños Unicornio Deluxe',
                'descripcion'      => 'Kit completo unicornio editable en Canva. Incluye 15 piezas listas para imprimir.',
                'descripcion_larga' => 'El kit más completo para una fiesta de unicornios. Diseño kawaii en tonos pastel con detalles dorados. Incluye: invitación digital (formato stories y horizontal), toppers para cupcakes (6 diseños), etiquetas para dulceros (8 diseños), banner de feliz cumpleaños, fondo de mesa imprimible, tarjetas de agradecimiento y kit de wrappers para botellas. Todo editable en Canva sin necesidad de diseñar desde cero.',
                'precio'           => 14.99,
                'precio_original'  => 29.99,
                'tipo_archivo'     => 'PDF + Canva',
                'badge'            => 'popular',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['unicornio', 'kawaii', 'fiesta', 'niña', 'canva', 'editable'],
                'ventas_count'     => 120,
                'rating_promedio'  => 4.9,
                'resenas_count'    => 52,
                'detalles'         => $detallesDigital('15 archivos', 'PDF + Canva'),
            ],

            [
                'category_id'      => $cats['Cumpleaños'],
                'product_type_id'  => $types['fiesta'],
                'style_id'         => $styles['Dinosaurios'],
                'nombre'           => 'Kit Dinosaurios Jurásico Party',
                'descripcion'      => 'Fiesta temática dinosaurios para niños de 3 a 8 años. Incluye 12 piezas en PDF.',
                'descripcion_larga' => 'Diseño dinámico con T-Rex, Triceratops y Braquiosaurio en colores vibrantes verde y naranja. Todo imprimible en casa o copistería. Incluye: invitación editable (nombre y fecha), toppers para torta (8 modelos), etiquetas para bolsitas de dulces, banderín de cumpleaños de 2 metros, tarjetas de mesa numeradas y portafotos con marco temático. Instrucciones de impresión y montaje incluidas en PDF.',
                'precio'           => 10.99,
                'precio_original'  => 19.99,
                'tipo_archivo'     => 'PDF imprimible',
                'badge'            => 'nuevo',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['dinosaurios', 'niño', 'imprimible', 'jurásico', 'fiesta'],
                'ventas_count'     => 80,
                'rating_promedio'  => 4.7,
                'resenas_count'    => 30,
                'detalles'         => $detallesDigital('12 archivos', 'PDF imprimible'),
            ],

            [
                'category_id'      => $cats['Cumpleaños'],
                'product_type_id'  => $types['etiquetas'],
                'style_id'         => $styles['Acuarela'],
                'nombre'           => 'Toppers Princesas Acuarela Premium',
                'descripcion'      => 'Set de 12 toppers para cupcakes y torta en estilo acuarela. Alta resolución.',
                'descripcion_larga' => 'Diseños delicados en técnica acuarela con tonos rosados, lavanda y dorado. Perfectos para imprimir en papel fotográfico o cartulina gruesa. Incluye: 6 diseños de toppers redondos (5 cm), 3 diseños de toppers rectangulares para torta, 3 diseños grandes para torta principal, instrucciones de corte y montaje en palillo. Archivo PDF con marcas de corte incluidas.',
                'precio'           => 5.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'PDF imprimible',
                'badge'            => null,
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['princesas', 'toppers', 'acuarela', 'niña', 'torta'],
                'ventas_count'     => 50,
                'rating_promedio'  => 5.0,
                'resenas_count'    => 20,
                'detalles'         => $detallesDigital('12 archivos', 'PDF imprimible'),
            ],

            [
                'category_id'      => $cats['Cumpleaños'],
                'product_type_id'  => $types['fiesta'],
                'style_id'         => $styles['Espacial'],
                'nombre'           => 'Kit Espacial Galaxy Party',
                'descripcion'      => 'Fiesta galáctica con planetas, cohetes y astronautas. Editable en Canva.',
                'descripcion_larga' => 'Diseño moderno en tonos negro, azul profundo y detalles neón. Perfecto para niños amantes del espacio y la ciencia. Incluye: invitación editable con fondo galaxy, toppers en forma de planeta y cohete (10 modelos), banner "Houston, tenemos un cumpleaños", etiquetas para mesa de dulces, stickers decorativos imprimibles y fondo fotográfico para photobooth. Compatible con Canva gratuito.',
                'precio'           => 12.99,
                'precio_original'  => 18.99,
                'tipo_archivo'     => 'PDF + Canva',
                'badge'            => 'oferta',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['espacio', 'galaxy', 'astronautas', 'niño', 'canva', 'moderno'],
                'ventas_count'     => 35,
                'rating_promedio'  => 4.5,
                'resenas_count'    => 15,
                'detalles'         => $detallesDigital('14 archivos', 'PDF + Canva'),
            ],

            [
                'category_id'      => $cats['Cumpleaños'],
                'product_type_id'  => $types['invitaciones'],
                'style_id'         => $styles['Minimalista'],
                'nombre'           => 'Invitación Cumpleaños Minimalista Elegante',
                'descripcion'      => 'Invitación digital minimalista en tonos neutros. Editable al 100% en Canva.',
                'descripcion_larga' => 'Diseño limpio y sofisticado ideal para cumpleaños de adultos o fiestas con estética moderna. Disponible en formato vertical (historia Instagram) y horizontal (imprimible A5). Campos editables: nombre, edad, fecha, hora, lugar y mensaje personalizado. Incluye versión en español e inglés. Descarga en alta resolución para impresión o envío digital por WhatsApp.',
                'precio'           => 3.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'Canva',
                'badge'            => 'editable',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['invitación', 'minimalista', 'adultos', 'canva', 'editable'],
                'ventas_count'     => 65,
                'rating_promedio'  => 4.8,
                'resenas_count'    => 28,
                'detalles'         => $detallesDigital('4 archivos (ES + EN, vertical + horizontal)', 'Canva editable'),
            ],

            // ═══════════════════════════════════════════════════
            // 🎂 CUMPLEAÑOS — FÍSICOS (Lanzarote)
            // ═══════════════════════════════════════════════════

            [
                'category_id'      => $cats['Cumpleaños'],
                'product_type_id'  => $types['pinatas'],
                'style_id'         => $styles['Kawaii'],
                'nombre'           => 'Piñata Unicornio Personalizada Lanzarote',
                'descripcion'      => 'Piñata artesanal de unicornio con nombre del cumpleañero. Entrega en Lanzarote.',
                'descripcion_larga' => 'Piñata elaborada a mano con estructura de cartón resistente y decoración en papel de seda en colores pastel. Personalización incluida: nombre del niño/a en letras de foami. Tamaño estándar (50 cm de alto). Capacidad para 1.5 kg de caramelos (no incluidos). Disponible en colores: rosa pastel, lila, azul cielo y blanco. Indica el color y el nombre al realizar el pedido. Entrega a domicilio en Lanzarote en 2–4 días laborables.',
                'precio'           => 34.99,
                'precio_original'  => 44.99,
                'tipo_archivo' => 'N/A',
                'badge'            => 'popular',
                'estado'           => 'activo',
                'modalidad'        => 'fisico',

                'zona_envio'       => 'Lanzarote',
                'stock'            => 8,
                'descarga_inmediata' => false,
                'destacado'        => true,
                'tags'             => ['piñata', 'unicornio', 'personalizada', 'lanzarote', 'artesanal'],
                'ventas_count'     => 22,
                'rating_promedio'  => 4.9,
                'resenas_count'    => 18,
                'detalles'         => $detalesFisico(
                    'Cartón + papel de seda',
                    '50 cm de alto × 40 cm de ancho',
                    'Acabado artesanal, colores pastel'
                ),
            ],

            [
                'category_id'      => $cats['Cumpleaños'],
                'product_type_id'  => $types['cajas'],
                'style_id'         => $styles['Kawaii'],
                'nombre'           => 'Pack 20 Cajitas Dulcero Personalizadas',
                'descripcion'      => 'Cajitas armables para dulces con nombre y temática personalizada. Entrega Lanzarote.',
                'descripcion_larga' => 'Pack de 20 cajitas de cartón de alta calidad para repartir entre los invitados. Impresas a todo color con la temática que elijas (unicornio, dinosaurios, princesas, espacial o floral). Personalización con nombre del cumpleañero y edad. Vienen pre-cortadas y con instrucciones de montaje fácil (sin pegamento). Medidas: 8 × 8 × 10 cm. Ideales para caramelos, chocolates o pequeños regalitos. Mínimo 10 unidades por pedido.',
                'precio'           => 28.00,
                'precio_original'  => null,
                'tipo_archivo' => 'N/A',
                'badge'            => null,
                'estado'           => 'activo',
                'modalidad'        => 'fisico',
                'zona_envio'       => 'Lanzarote',
                'stock'            => 15,
                'descarga_inmediata' => false,
                'destacado'        => true,
                'tags'             => ['cajitas', 'dulceros', 'personalizadas', 'lanzarote', 'pack'],
                'ventas_count'     => 31,
                'rating_promedio'  => 4.8,
                'resenas_count'    => 24,
                'detalles'         => $detalesFisico(
                    'Cartón microcorrugado 350g',
                    '8 × 8 × 10 cm por unidad',
                    'Impresión digital 4 colores, barniz mate'
                ),
            ],

            [
                'category_id'      => $cats['Cumpleaños'],
                'product_type_id'  => $types['etiquetas'],
                'style_id'         => $styles['Infantil'],
                'nombre'           => 'Kit Etiquetas Adhesivas Personalizadas 50 uds',
                'descripcion'      => '50 etiquetas adhesivas personalizadas para bolsitas, botellas y detalles. Lanzarote.',
                'descripcion_larga' => 'Etiquetas circulares adhesivas de 5 cm de diámetro, impresas en papel autoadhesivo brillante resistente a la humedad. Personalizadas con nombre, edad y temática a elegir. Perfectas para cerrar bolsitas de chuches, personalizar botellas de agua, decorar tarros de cristal o usarlas como sellos de cierre. Se entregan en hoja cortada lista para despegar. Mínimo 50 unidades. Posibilidad de combinar varias temáticas en el mismo pedido.',
                'precio'           => 12.00,
                'precio_original'  => 16.00,
                'tipo_archivo' => 'N/A',
                'badge'            => 'oferta',
                'estado'           => 'activo',
                'modalidad'        => 'fisico',
                'zona_envio'       => 'Lanzarote',
                'stock'            => 25,
                'descarga_inmediata' => false,
                'destacado'        => false,
                'tags'             => ['etiquetas', 'adhesivas', 'personalizadas', 'lanzarote', 'bolsitas'],
                'ventas_count'     => 47,
                'rating_promedio'  => 4.7,
                'resenas_count'    => 35,
                'detalles'         => $detalesFisico(
                    'Papel autoadhesivo brillante 120g',
                    'Circular 5 cm diámetro',
                    'Impresión digital, resistente humedad'
                ),
            ],

            // ═══════════════════════════════════════════════════
            // ✨ STICKERS — DIGITALES
            // ═══════════════════════════════════════════════════

            [
                'category_id'      => $cats['Stickers'],
                'product_type_id'  => $types['papeleria'],
                'style_id'         => $styles['Kawaii'],
                'nombre'           => 'Mega Pack 100 Stickers Kawaii',
                'descripcion'      => '100 stickers kawaii variados para planner, agenda y decoración. Descarga inmediata.',
                'descripcion_larga' => 'La colección kawaii más completa del catálogo. 100 diseños únicos organizados en 10 categorías: comida kawaii (sushi, helados, frutas), animales tiernos, frases motivadoras, clima y naturaleza, decorativos geométricos, flechas y separadores, emociones y caras, corazones y estrellas, objetos de papelería y elementos de agenda (hábitos, días de la semana). Compatible con GoodNotes, Notability y cualquier app de notas digitales. También imprimibles en papel adhesivo.',
                'precio'           => 3.99,
                'precio_original'  => 7.99,
                'tipo_archivo'     => 'PDF + PNG',
                'badge'            => 'popular',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['stickers', 'kawaii', 'planner', 'agenda', 'digital', 'goodnotes'],
                'ventas_count'     => 200,
                'rating_promedio'  => 4.9,
                'resenas_count'    => 80,
                'detalles'         => $detallesDigital('100 PNG transparentes + 10 PDF imprimibles', 'PDF + PNG transparente'),
            ],

            [
                'category_id'      => $cats['Stickers'],
                'product_type_id'  => $types['papeleria'],
                'style_id'         => $styles['Minimalista'],
                'nombre'           => 'Stickers Minimal Planner Productividad',
                'descripcion'      => 'Stickers minimalistas para planificadores. Diseño limpio en blanco y negro con toques dorados.',
                'descripcion_larga' => 'Colección de 60 stickers en estética minimalista para personas que prefieren el orden sobre la decoración recargada. Incluye: etiquetas de hábitos (ejercicio, agua, lectura, meditación), marcadores de prioridad (urgente, importante, revisar), cabeceras de semana y mes, stickers de estado de ánimo, decorativos geométricos sutiles y frases cortas motivadoras. Fondo transparente en PNG. Formato A4 imprimible incluido para papel adhesivo.',
                'precio'           => 2.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'PDF + PNG',
                'badge'            => 'nuevo',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['stickers', 'minimalista', 'planner', 'productividad', 'png'],
                'ventas_count'     => 40,
                'rating_promedio'  => 4.6,
                'resenas_count'    => 12,
                'detalles'         => $detallesDigital('60 PNG transparentes + 6 PDF imprimibles', 'PDF + PNG transparente'),
            ],

            [
                'category_id'      => $cats['Stickers'],
                'product_type_id'  => $types['papeleria'],
                'style_id'         => $styles['Floral'],
                'nombre'           => 'Pack Stickers Florales Vintage',
                'descripcion'      => 'Stickers florales estilo vintage para diarios, agendas y journaling.',
                'descripcion_larga' => 'Colección de 45 stickers con ilustraciones florales en paleta vintage: rosas antiguas, lavanda, eucalipto y flores secas. Perfectos para bullet journal, diarios personales y scrapbooking digital. Incluye flores sueltas, ramas, coronas florales, marcos decorativos y letras con flores integradas. Todos con fondo transparente. El pack incluye versiones en color y en sepia para un look más vintage.',
                'precio'           => 4.49,
                'precio_original'  => 6.99,
                'tipo_archivo'     => 'PNG',
                'badge'            => null,
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['stickers', 'floral', 'vintage', 'journaling', 'bujo', 'png'],
                'ventas_count'     => 55,
                'rating_promedio'  => 4.8,
                'resenas_count'    => 22,
                'detalles'         => $detallesDigital('45 PNG + versión sepia incluida', 'PNG transparente'),
            ],

            // ═══════════════════════════════════════════════════
            // 🍼 BABY SHOWER — DIGITALES
            // ═══════════════════════════════════════════════════

            [
                'category_id'      => $cats['Baby Shower'],
                'product_type_id'  => $types['fiesta'],
                'style_id'         => $styles['Infantil'],
                'nombre'           => 'Kit Baby Shower Safari Premium',
                'descripcion'      => 'Decoración completa baby shower temática safari. 16 piezas editables en Canva.',
                'descripcion_larga' => 'Kit completo para una baby shower con temática de animales de la selva. Diseño suave y moderno con jirafas, elefantes y leones en tonos beige, verde salvia y terracota. Incluye: invitación editable (digital e imprimible), cartel de bienvenida A3, toppers para mesa dulce (10 modelos), etiquetas para botellitas de agua, tarjetas de agradecimiento, cartel "Es niño / Es niña", menú imprimible y decoración para photobooth. Todo editable en Canva.',
                'precio'           => 8.99,
                'precio_original'  => 15.99,
                'tipo_archivo'     => 'PDF + Canva',
                'badge'            => null,
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['baby shower', 'safari', 'editable', 'canva', 'niño', 'niña'],
                'ventas_count'     => 60,
                'rating_promedio'  => 4.8,
                'resenas_count'    => 25,
                'detalles'         => $detallesDigital('16 archivos', 'PDF + Canva editable'),
            ],

            [
                'category_id'      => $cats['Baby Shower'],
                'product_type_id'  => $types['invitaciones'],
                'style_id'         => $styles['Acuarela'],
                'nombre'           => 'Invitación Baby Shower Acuarela Rosada',
                'descripcion'      => 'Invitación digital baby shower en acuarela. Editable con nombre y fecha.',
                'descripcion_larga' => 'Diseño delicado en tonos rosados con ilustraciones de flores y mariposas en técnica acuarela. Ideal para baby shower de niña. Editable al 100% en Canva: nombre de los padres, nombre del bebé (si ya está elegido), fecha, hora y lugar. Disponible en formato cuadrado (WhatsApp), historia vertical (Instagram) y A5 imprimible. Tiempo de edición estimado: 5 minutos.',
                'precio'           => 2.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'Canva',
                'badge'            => 'editable',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['baby shower', 'invitación', 'acuarela', 'niña', 'canva'],
                'ventas_count'     => 38,
                'rating_promedio'  => 4.7,
                'resenas_count'    => 16,
                'detalles'         => $detallesDigital('3 formatos (cuadrado, historia, A5)', 'Canva editable'),
            ],

            // ═══════════════════════════════════════════════════
            // 💍 BODAS — DIGITALES
            // ═══════════════════════════════════════════════════

            [
                'category_id'      => $cats['Bodas'],
                'product_type_id'  => $types['invitaciones'],
                'style_id'         => $styles['Floral'],
                'nombre'           => 'Invitación Boda Floral Elegante',
                'descripcion'      => 'Invitación de boda editable con diseño floral premium. Imprimible y digital.',
                'descripcion_larga' => 'Diseño romántico con ilustraciones florales en tonos blancos, verdes y toques dorados. Perfecta para bodas al aire libre, jardines o eventos con estética natural. Incluye: invitación principal A5, tarjeta de confirmación de asistencia (RSVP), tarjeta de ubicación con mapa, menú de boda editable y programación del día. Todo editable en Canva con fuentes elegantes ya instaladas. El diseño puede adaptarse para comuniones y bautizos.',
                'precio'           => 7.99,
                'precio_original'  => 14.99,
                'tipo_archivo'     => 'PDF + Canva',
                'badge'            => 'popular',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['boda', 'invitación', 'floral', 'elegante', 'canva', 'romántico'],
                'ventas_count'     => 88,
                'rating_promedio'  => 4.9,
                'resenas_count'    => 41,
                'detalles'         => $detallesDigital('5 piezas (invitación + RSVP + mapa + menú + programa)', 'PDF + Canva editable'),
            ],

            // ═══════════════════════════════════════════════════
            // 🌸 FLORAL — DIGITALES
            // ═══════════════════════════════════════════════════

            [
                'category_id'      => $cats['Floral'],
                'product_type_id'  => $types['invitaciones'],
                'style_id'         => $styles['Floral'],
                'nombre'           => 'Invitación Floral Elegante Multiuso',
                'descripcion'      => 'Invitación editable estilo floral para cualquier evento. Canva sin cuenta premium.',
                'descripcion_larga' => 'Diseño floral versátil adaptable a cumpleaños, bodas, bautizos, comuniones y reuniones. Tonos suaves en rosa, verde menta y lila. La plantilla en Canva funciona con cuenta gratuita (sin necesidad de Canva Pro). Incluye guía de personalización paso a paso en PDF para personas sin experiencia en diseño. Descarga en alta resolución para impresión o envío por WhatsApp.',
                'precio'           => 4.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'Canva',
                'badge'            => 'editable',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['floral', 'invitación', 'multiuso', 'canva', 'editable'],
                'ventas_count'     => 25,
                'rating_promedio'  => 4.5,
                'resenas_count'    => 10,
                'detalles'         => $detallesDigital('2 formatos (A5 imprimible + digital WhatsApp)', 'Canva editable'),
            ],

            // ═══════════════════════════════════════════════════
            // 🎓 GRADUACIÓN — DIGITALES
            // ═══════════════════════════════════════════════════

            [
                'category_id'      => $cats['Graduación'],
                'product_type_id'  => $types['fiesta'],
                'style_id'         => $styles['Minimalista'],
                'nombre'           => 'Kit Graduación Minimalista Oro',
                'descripcion'      => 'Kit completo de graduación en negro y dorado. Moderno y elegante para bachillerato y universidad.',
                'descripcion_larga' => 'Diseño sofisticado en negro mate con detalles dorados. Ideal para graduaciones de bachillerato, FP, grado universitario y máster. Incluye: invitación digital y para imprimir, cartel de bienvenida, marco para foto de graduado, tarjetas de agradecimiento, toppers para torta con birrete, etiquetas para botellas de champán y kit de photobooth con props imprimibles. Totalmente editable en Canva.',
                'precio'           => 9.99,
                'precio_original'  => 17.99,
                'tipo_archivo'     => 'PDF + Canva',
                'badge'            => 'nuevo',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['graduación', 'universidad', 'bachillerato', 'negro', 'dorado', 'canva'],
                'ventas_count'     => 43,
                'rating_promedio'  => 4.8,
                'resenas_count'    => 19,
                'detalles'         => $detallesDigital('13 archivos', 'PDF + Canva editable'),
            ],

            // ═══════════════════════════════════════════════════
            // 🎄 NAVIDAD — DIGITALES
            // ═══════════════════════════════════════════════════

            [
                'category_id'      => $cats['Navidad'],
                'product_type_id'  => $types['papeleria'],
                'style_id'         => $styles['Vintage'],
                'nombre'           => 'Pack Tarjetas Navidad Vintage Imprimibles',
                'descripcion'      => 'Set de 8 tarjetas navideñas vintage para imprimir en casa. Estilo clásico.',
                'descripcion_larga' => 'Ocho diseños de tarjetas navideñas en estilo vintage con ilustraciones de Papá Noel clásico, renos, trineos y paisajes nevados. Formato de tarjeta A6 (plegable) lista para imprimir en A4 (2 tarjetas por hoja). Incluye versión con texto editable en Canva y versión solo con imagen para escribir a mano. Perfectas para enviar a familia, amigos o como tarjeta corporativa con toque personal.',
                'precio'           => 3.49,
                'precio_original'  => null,
                'tipo_archivo'     => 'PDF + Canva',
                'badge'            => 'nuevo',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['navidad', 'tarjetas', 'vintage', 'imprimible', 'clásico'],
                'ventas_count'     => 72,
                'rating_promedio'  => 4.7,
                'resenas_count'    => 29,
                'detalles'         => $detallesDigital('8 diseños en PDF + enlace Canva', 'PDF imprimible + Canva'),
            ],

            [
                'category_id'      => $cats['Navidad'],
                'product_type_id'  => $types['etiquetas'],
                'style_id'         => $styles['Vintage'],
                'nombre'           => 'Etiquetas Regalo Navidad Kraft',
                'descripcion'      => '20 etiquetas para regalos navideños estilo kraft. Imprimibles en papel normal.',
                'descripcion_larga' => 'Veinte diseños de etiquetas para regalos en estilo kraft con ilustraciones navideñas en tinta negra. Minimalistas y elegantes. Formato optimizado para imprimir en papel kraft o papel normal A4. Incluye etiquetas con espacio para "De:", "Para:" y mensaje personalizado. Diseños disponibles: árbol, reno, estrella, calcetín, regalo, muñeco de nieve, paloma y texto decorativo. El PDF incluye marcas de corte para facilitar el recortado.',
                'precio'           => 1.99,
                'precio_original'  => null,
                'tipo_archivo'     => 'PDF imprimible',
                'badge'            => null,
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => false,
                'tags'             => ['navidad', 'etiquetas', 'regalos', 'kraft', 'imprimible'],
                'ventas_count'     => 130,
                'rating_promedio'  => 4.6,
                'resenas_count'    => 54,
                'detalles'         => $detallesDigital('20 diseños en 1 PDF A4', 'PDF imprimible'),
            ],

            // ═══════════════════════════════════════════════════
            // 💕 AMOR — DIGITALES
            // ═══════════════════════════════════════════════════

            [
                'category_id'      => $cats['Amor'],
                'product_type_id'  => $types['invitaciones'],
                'style_id'         => $styles['Minimalista'],
                'nombre'           => 'Kit San Valentín Minimalista',
                'descripcion'      => 'Kit digital de San Valentín con tarjeta, sobre y etiquetas. Editable en Canva.',
                'descripcion_larga' => 'Set romántico en tonos burdeos, rosa empolvado y crema. Diseño minimalista con tipografía script. Incluye: tarjeta de amor A5 editable, sobre decorado imprimible, 6 etiquetas para regalos con frases románticas, cupones de amor editables (10 diseños), y pack de stickers digitales corazones para WhatsApp o Instagram Stories. Ideal para regalar a pareja, amigos o como detalle de empresa.',
                'precio'           => 5.49,
                'precio_original'  => 8.99,
                'tipo_archivo'     => 'PDF + Canva',
                'badge'            => 'oferta',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['san valentín', 'amor', 'pareja', 'romántico', 'canva', 'cupones'],
                'ventas_count'     => 91,
                'rating_promedio'  => 4.9,
                'resenas_count'    => 37,
                'detalles'         => $detallesDigital('18 archivos', 'PDF + Canva editable'),
            ],

            // ═══════════════════════════════════════════════════
            // 🆓 GRATIS — DIGITAL
            // ═══════════════════════════════════════════════════

            [
                'category_id'      => $cats['Stickers'],
                'product_type_id'  => $types['papeleria'],
                'style_id'         => $styles['Kawaii'],
                'nombre'           => 'Pack Gratis Bienvenida — 10 Stickers Kawaii',
                'descripcion'      => 'Pack gratuito de 10 stickers kawaii para descubrir la calidad de nuestros diseños.',
                'descripcion_larga' => 'Tu primer pack de bienvenida completamente gratis. Incluye 10 stickers kawaii seleccionados de nuestra colección más popular: helado, gato feliz, estrella, nube, corazón, flor, arcoíris, café, libro y luna. Fondo transparente en PNG. Descarga inmediata sin necesidad de crear cuenta. Si te gustan, el Mega Pack de 100 stickers está disponible por solo €3.99. Calidad garantizada: los mismos archivos que los packs de pago.',
                'precio'           => 0,
                'precio_original'  => null,
                'tipo_archivo'     => 'PNG',
                'badge'            => 'gratis',
                'estado'           => 'activo',
                'modalidad'        => 'digital',
                'zona_envio'       => null,
                'stock'            => null,
                'descarga_inmediata' => true,
                'destacado'        => true,
                'tags'             => ['gratis', 'stickers', 'kawaii', 'muestra', 'png'],
                'ventas_count'     => 300,
                'rating_promedio'  => 5.0,
                'resenas_count'    => 120,
                'detalles'         => $detallesDigital('10 PNG transparentes 300 DPI', 'PNG transparente'),
            ],


            // ═══════════════════════════════════════════════════════════════════
            // PRODUCTOS FÍSICOS — Lanzarote
            // Añade este bloque dentro del array $productos en tu ProductSeeder
            // Un producto físico por cada tipo en cada categoría relevante
            // ═══════════════════════════════════════════════════════════════════

            // ─────────────────────────────────────────────
            // 🎂 CUMPLEAÑOS — FÍSICOS
            // ─────────────────────────────────────────────

            // tipo: cajas
            [
                'category_id'       => $cats['Cumpleaños'],
                'product_type_id'   => $types['cajas'],
                'style_id'          => $styles['Kawaii'],
                'nombre'            => 'Caja Regalo Cumpleaños Personalizada Kawaii',
                'descripcion'       => 'Caja de regalo artesanal personalizada con nombre y temática kawaii. Entrega en Lanzarote.',
                'descripcion_larga' => 'Caja de cartón rígido forrada en papel especial con diseño kawaii personalizado. Incluye tapa con lazo de organza y tarjeta de felicitación con el nombre del cumpleañero. Disponible en tamaños S (15×15×10 cm), M (20×20×15 cm) y L (30×30×20 cm). Colores disponibles: rosa pastel, lila, azul cielo y menta. Relleno de papel kraft incluido. Ideal para presentar regalos de forma especial. Indica nombre, color y tamaño al hacer el pedido.',
                'precio'            => 18.99,
                'precio_original'   => 24.99,
                'tipo_archivo' => 'N/A',
                'badge'             => 'popular',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 20,
                'descarga_inmediata' => false,
                'destacado'         => true,
                'tags'              => ['caja', 'regalo', 'personalizada', 'kawaii', 'lanzarote', 'cumpleaños'],
                'ventas_count'      => 34,
                'rating_promedio'   => 4.8,
                'resenas_count'     => 21,
                'detalles'          => $detalesFisico(
                    'Cartón rígido 2mm + papel decorativo 120g',
                    'S: 15×15×10 cm / M: 20×20×15 cm / L: 30×30×20 cm',
                    'Forrada a mano, lazo organza, tarjeta incluida'
                ),
            ],

            // tipo: papeleria
            [
                'category_id'       => $cats['Cumpleaños'],
                'product_type_id'   => $types['papeleria'],
                'style_id'          => $styles['Infantil'],
                'nombre'            => 'Kit Papelería Cumpleaños Impreso Personalizado',
                'descripcion'       => 'Kit de papelería impresa para cumpleaños infantil. Banderín, invitaciones y etiquetas. Lanzarote.',
                'descripcion_larga' => 'Pack de papelería impresa y lista para usar, sin necesidad de descargar ni imprimir en casa. Incluye: 10 invitaciones impresas en cartulina 350g, 20 etiquetas adhesivas circulares personalizadas, 1 banderín "Feliz Cumpleaños" de 2 metros en tela no tejida y 10 tarjetas de agradecimiento. Personalización incluida con nombre, edad y temática a elegir (unicornio, dinosaurios, princesas, espacial o safari). Entrega en Lanzarote en 3–5 días laborables.',
                'precio'            => 32.00,
                'precio_original'   => 42.00,
                'tipo_archivo' => 'N/A',
                'badge'             => 'oferta',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 12,
                'descarga_inmediata' => false,
                'destacado'         => true,
                'tags'              => ['papelería', 'impresa', 'cumpleaños', 'kit', 'lanzarote', 'personalizada'],
                'ventas_count'      => 19,
                'rating_promedio'   => 5.0,
                'resenas_count'     => 14,
                'detalles'          => $detalesFisico(
                    'Cartulina 350g (invitaciones) + papel adhesivo brillante (etiquetas) + tela no tejida (banderín)',
                    'Invitaciones A6 / Etiquetas ø5cm / Banderín 200cm',
                    'Impresión digital 4 colores, barniz mate selectivo'
                ),
            ],

            // tipo: etiquetas
            [
                'category_id'       => $cats['Cumpleaños'],
                'product_type_id'   => $types['etiquetas'],
                'style_id'          => $styles['Kawaii'],
                'nombre'            => 'Pack 50 Etiquetas Adhesivas Cumpleaños Personalizadas',
                'descripcion'       => '50 etiquetas adhesivas circulares personalizadas para bolsitas y detalles. Entrega Lanzarote.',
                'descripcion_larga' => 'Etiquetas circulares de 5 cm en papel autoadhesivo brillante resistente a la humedad. Personalizadas con nombre, edad y temática elegida. Perfectas para cerrar bolsitas de chuches, personalizar botellas de agua o decorar tarros. Se entregan en hoja lista para despegar. Disponibles en 6 temáticas: unicornio, dinosaurios, princesas, espacial, safari y floral. Mínimo 50 unidades. Se pueden combinar hasta 2 temáticas en el mismo pedido.',
                'precio'            => 12.00,
                'precio_original'   => 16.00,
                'tipo_archivo' => 'N/A',
                'badge'             => 'oferta',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 30,
                'descarga_inmediata' => false,
                'destacado'         => false,
                'tags'              => ['etiquetas', 'adhesivas', 'personalizadas', 'cumpleaños', 'lanzarote'],
                'ventas_count'      => 47,
                'rating_promedio'   => 4.7,
                'resenas_count'     => 35,
                'detalles'          => $detalesFisico(
                    'Papel autoadhesivo brillante 120g',
                    'Circular ø5 cm',
                    'Impresión digital, resistente humedad'
                ),
            ],

            // tipo: pinatas
            [
                'category_id'       => $cats['Cumpleaños'],
                'product_type_id'   => $types['pinatas'],
                'style_id'          => $styles['Kawaii'],
                'nombre'            => 'Piñata Unicornio Artesanal Personalizada',
                'descripcion'       => 'Piñata artesanal de unicornio con nombre. Tamaño 50 cm. Entrega en Lanzarote.',
                'descripcion_larga' => 'Piñata elaborada a mano con estructura de cartón resistente y decoración en papel de seda en colores pastel. Personalización incluida: nombre del niño/a en letras de foami. Tamaño estándar 50 cm de alto. Capacidad para 1.5 kg de caramelos (no incluidos). Disponible en colores: rosa pastel, lila, azul cielo y blanco. Cuerda de colgar incluida. Indica el color preferido y el nombre al realizar el pedido. Fabricación artesanal en Lanzarote.',
                'precio'            => 34.99,
                'precio_original'   => 44.99,
                'tipo_archivo' => 'N/A',
                'badge'             => 'popular',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 8,
                'descarga_inmediata' => false,
                'destacado'         => true,
                'tags'              => ['piñata', 'unicornio', 'artesanal', 'personalizada', 'lanzarote'],
                'ventas_count'      => 22,
                'rating_promedio'   => 4.9,
                'resenas_count'     => 18,
                'detalles'          => $detalesFisico(
                    'Cartón + papel de seda multicolor',
                    '50 cm alto × 40 cm ancho',
                    'Artesanal, acabado en flecos de papel de seda'
                ),
            ],

            // tipo: invitaciones
            [
                'category_id'       => $cats['Cumpleaños'],
                'product_type_id'   => $types['invitaciones'],
                'style_id'          => $styles['Infantil'],
                'nombre'            => 'Invitaciones Impresas Cumpleaños Infantil x10',
                'descripcion'       => '10 invitaciones impresas en cartulina premium personalizadas. Listas para entregar. Lanzarote.',
                'descripcion_larga' => 'Invitaciones impresas en cartulina satinada de 350g con acabado barniz selectivo en los elementos principales. Personalizadas con: nombre del cumpleañero, edad, fecha, hora y lugar del evento. Tamaño A6 (10.5 × 14.8 cm), formato doble cara. Temáticas disponibles: unicornio, dinosaurios, princesas, espacial, safari y minimalista. Entregadas en sobre kraft incluido. Envío a domicilio en Lanzarote en 3–4 días laborables tras confirmación del diseño.',
                'precio'            => 15.00,
                'precio_original'   => null,
                'tipo_archivo' => 'N/A',
                'badge'             => null,
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 18,
                'descarga_inmediata' => false,
                'destacado'         => false,
                'tags'              => ['invitaciones', 'impresas', 'cumpleaños', 'personalizadas', 'lanzarote'],
                'ventas_count'      => 29,
                'rating_promedio'   => 4.8,
                'resenas_count'     => 20,
                'detalles'          => $detalesFisico(
                    'Cartulina satinada 350g doble cara',
                    'A6 (10.5 × 14.8 cm)',
                    'Barniz selectivo mate/brillo en elementos principales'
                ),
            ],

            // tipo: fiesta
            [
                'category_id'       => $cats['Cumpleaños'],
                'product_type_id'   => $types['fiesta'],
                'style_id'          => $styles['Infantil'],
                'nombre'            => 'Kit Decoración Fiesta Cumpleaños Completo Impreso',
                'descripcion'       => 'Kit físico completo para decorar una fiesta de cumpleaños. Todo impreso y listo. Lanzarote.',
                'descripcion_larga' => 'El kit más completo para montar una fiesta sin descargar ni imprimir nada. Todo viene listo para colocar. Incluye: banderín de tela "Feliz Cumpleaños" (2m), 10 globos de látex personalizados con nombre, 20 etiquetas adhesivas, 10 invitaciones impresas, 1 cartel central A3 con foto del cumpleañero (enviar foto por WhatsApp), 10 cajitas dulcero armadas y 1 piñata pequeña de temática elegida. Temáticas: unicornio, dinosaurios, princesas, espacial o safari. Entrega en Lanzarote 4–5 días laborables.',
                'precio'            => 79.99,
                'precio_original'   => 99.99,
                'tipo_archivo' => 'N/A',
                'badge'             => 'popular',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 5,
                'descarga_inmediata' => false,
                'destacado'         => true,
                'tags'              => ['kit', 'decoración', 'fiesta', 'completo', 'lanzarote', 'cumpleaños'],
                'ventas_count'      => 11,
                'rating_promedio'   => 5.0,
                'resenas_count'     => 9,
                'detalles'          => $detalesFisico(
                    'Varios materiales (tela, látex, cartón, papel adhesivo)',
                    'Kit completo — ver descripción para medidas por pieza',
                    'Impresión digital + fabricación artesanal parcial'
                ),
            ],

            // ─────────────────────────────────────────────
            // 🍼 BABY SHOWER — FÍSICOS
            // ─────────────────────────────────────────────

            // tipo: cajas
            [
                'category_id'       => $cats['Baby Shower'],
                'product_type_id'   => $types['cajas'],
                'style_id'          => $styles['Infantil'],
                'nombre'            => 'Caja Sorpresa Baby Shower Personalizada',
                'descripcion'       => 'Caja sorpresa artesanal para baby shower con relleno decorativo. Entrega en Lanzarote.',
                'descripcion_larga' => 'Caja de cartón rígido decorada en tonos pastel (azul o rosa según el género del bebé, o amarillo/verde si no se conoce). Personalizada con los nombres de los futuros papás y la fecha prevista. Relleno de virutas de papel y lazo de tul incluidos. Tamaño único: 25×25×20 cm. Ideal para entregar regalos para el bebé de forma especial o como decoración central de la mesa de la baby shower. Se puede rellenar con los regalos del cliente o solicitar relleno básico (+5€).',
                'precio'            => 22.99,
                'precio_original'   => null,
                'tipo_archivo' => 'N/A',
                'badge'             => null,
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 10,
                'descarga_inmediata' => false,
                'destacado'         => false,
                'tags'              => ['caja', 'baby shower', 'personalizada', 'lanzarote', 'bebé'],
                'ventas_count'      => 16,
                'rating_promedio'   => 4.9,
                'resenas_count'     => 12,
                'detalles'          => $detalesFisico(
                    'Cartón rígido 2mm + papel decorativo',
                    '25 × 25 × 20 cm',
                    'Decorada a mano, lazo tul y virutas incluidas'
                ),
            ],

            // tipo: pinatas
            [
                'category_id'       => $cats['Baby Shower'],
                'product_type_id'   => $types['pinatas'],
                'style_id'          => $styles['Infantil'],
                'nombre'            => 'Piñata Baby Shower Estrella Pastel',
                'descripcion'       => 'Piñata estrella artesanal para baby shower en tonos pastel. Personalizada. Lanzarote.',
                'descripcion_larga' => 'Piñata en forma de estrella de 5 puntas elaborada a mano en papel de seda en tonos pastel suaves. Personalizada con el nombre del bebé o "Baby Shower" en letras de foami. Tamaño: 45 cm de punta a punta. Capacidad para 1 kg de caramelos o pequeños regalitos (no incluidos). Disponible en: todo rosa, todo azul, lila y blanco, o combinación pastel multicolor. Cuerda de colgar reforzada incluida.',
                'precio'            => 29.99,
                'precio_original'   => 37.99,
                'tipo_archivo' => 'N/A',
                'badge'             => 'oferta',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 7,
                'descarga_inmediata' => false,
                'destacado'         => false,
                'tags'              => ['piñata', 'baby shower', 'estrella', 'pastel', 'lanzarote'],
                'ventas_count'      => 13,
                'rating_promedio'   => 4.8,
                'resenas_count'     => 10,
                'detalles'          => $detalesFisico(
                    'Cartón + papel de seda pastel',
                    '45 cm de punta a punta',
                    'Artesanal, flecos de papel de seda suave'
                ),
            ],

            // tipo: invitaciones
            [
                'category_id'       => $cats['Baby Shower'],
                'product_type_id'   => $types['invitaciones'],
                'style_id'          => $styles['Acuarela'],
                'nombre'            => 'Invitaciones Baby Shower Acuarela Impresas x10',
                'descripcion'       => '10 invitaciones baby shower impresas en cartulina premium. Diseño acuarela personalizado. Lanzarote.',
                'descripcion_larga' => 'Invitaciones impresas en cartulina satinada 350g con diseño en acuarela suave. Personalizadas con nombre de los papás, fecha, hora y lugar del evento, y mensaje especial. Formato A6 doble cara con sobre kraft incluido. Disponibles en versión niño (azul), niña (rosa) o neutro (verde salvia). El cliente recibe una prueba digital para aprobación antes de imprimir. Tiempo de producción: 2–3 días laborables tras aprobación.',
                'precio'            => 16.00,
                'precio_original'   => null,
                'tipo_archivo' => 'N/A',
                'badge'             => null,
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 15,
                'descarga_inmediata' => false,
                'destacado'         => false,
                'tags'              => ['invitaciones', 'baby shower', 'acuarela', 'impresas', 'lanzarote'],
                'ventas_count'      => 18,
                'rating_promedio'   => 4.9,
                'resenas_count'     => 14,
                'detalles'          => $detalesFisico(
                    'Cartulina satinada 350g',
                    'A6 (10.5 × 14.8 cm)',
                    'Impresión digital alta calidad + sobre kraft incluido'
                ),
            ],

            // ─────────────────────────────────────────────
            // 💍 BODAS — FÍSICOS
            // ─────────────────────────────────────────────

            // tipo: cajas
            [
                'category_id'       => $cats['Bodas'],
                'product_type_id'   => $types['cajas'],
                'style_id'          => $styles['Floral'],
                'nombre'            => 'Caja Detalles Boda Floral Personalizada',
                'descripcion'       => 'Caja elegante para detalles de boda con diseño floral. Personalizada con nombres y fecha. Lanzarote.',
                'descripcion_larga' => 'Caja de cartón rígido en color blanco con diseño floral impreso y nombres de los novios + fecha de la boda en dorado. Ideal como caja para detalles de boda, caja de anillos o caja de mesa de dulces. Tamaños disponibles: S (10×10×8 cm) para detalles individuales, M (20×15×10 cm) para detalle de pareja. Acabado en barniz mate con detalles brillantes en el texto dorado. Se puede personalizar con foto interior (+3€). Precio por unidad — descuento a partir de 10 unidades.',
                'precio'            => 14.99,
                'precio_original'   => 19.99,
                'tipo_archivo' => 'N/A',
                'badge'             => 'popular',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 22,
                'descarga_inmediata' => false,
                'destacado'         => true,
                'tags'              => ['caja', 'boda', 'floral', 'personalizada', 'lanzarote', 'detalles'],
                'ventas_count'      => 38,
                'rating_promedio'   => 5.0,
                'resenas_count'     => 27,
                'detalles'          => $detalesFisico(
                    'Cartón rígido 2mm blanco + impresión digital',
                    'S: 10×10×8 cm / M: 20×15×10 cm',
                    'Barniz mate con texto dorado brillante'
                ),
            ],

            // tipo: invitaciones
            [
                'category_id'       => $cats['Bodas'],
                'product_type_id'   => $types['invitaciones'],
                'style_id'          => $styles['Floral'],
                'nombre'            => 'Invitaciones Boda Floral Impresas Premium x20',
                'descripcion'       => '20 invitaciones de boda impresas en cartulina premium con diseño floral. Sobre incluido. Lanzarote.',
                'descripcion_larga' => 'Invitaciones de boda impresas en cartulina de lujo 400g con textura suave al tacto. Diseño floral con ilustraciones en tonos blancos, verdes y detalles dorados. Personalizadas con nombres de los novios, fecha, hora, lugar y código dress code. Formato A5 (14.8×21 cm) con sobre blanco de solapa triangular incluido. Se envía prueba digital para aprobación. Posibilidad de añadir tarjeta RSVP (+8€ por 20 unidades) o tarjeta de ubicación (+6€). Precio por 20 unidades — tarifas para 50, 100 y 150 unidades disponibles bajo pedido.',
                'precio'            => 48.00,
                'precio_original'   => 65.00,
                'tipo_archivo' => 'N/A',
                'badge'             => 'popular',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 6,
                'descarga_inmediata' => false,
                'destacado'         => true,
                'tags'              => ['invitaciones', 'boda', 'floral', 'impresas', 'premium', 'lanzarote'],
                'ventas_count'      => 24,
                'rating_promedio'   => 5.0,
                'resenas_count'     => 20,
                'detalles'          => $detalesFisico(
                    'Cartulina de lujo 400g textura soft touch',
                    'A5 (14.8 × 21 cm)',
                    'Impresión offset + barniz UV selectivo dorado'
                ),
            ],

            // ─────────────────────────────────────────────
            // 🎄 NAVIDAD — FÍSICOS
            // ─────────────────────────────────────────────

            // tipo: cajas
            [
                'category_id'       => $cats['Navidad'],
                'product_type_id'   => $types['cajas'],
                'style_id'          => $styles['Vintage'],
                'nombre'            => 'Caja Regalo Navidad Vintage Personalizada',
                'descripcion'       => 'Caja de regalo navideña estilo vintage con nombre. Perfecta para regalos de empresa o familia. Lanzarote.',
                'descripcion_larga' => 'Caja de cartón rígido decorada con motivos navideños en estilo vintage: ilustraciones de Papá Noel clásico, renos y paisajes nevados en tinta sobre fondo kraft. Personalizada con nombre del destinatario y mensaje de hasta 2 líneas. Tamaños: S (15×15×12 cm), M (25×20×15 cm) y L (35×25×20 cm). Lazo de cinta de terciopelo rojo incluido. Ideal para cestas navideñas, regalos de empresa o sorpresas familiares. Disponible también sin personalización para pedidos de empresa a partir de 10 unidades.',
                'precio'            => 16.99,
                'precio_original'   => null,
                'tipo_archivo' => 'N/A',
                'badge'             => 'nuevo',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 25,
                'descarga_inmediata' => false,
                'destacado'         => false,
                'tags'              => ['caja', 'navidad', 'vintage', 'regalo', 'lanzarote', 'empresa'],
                'ventas_count'      => 41,
                'rating_promedio'   => 4.7,
                'resenas_count'     => 28,
                'detalles'          => $detalesFisico(
                    'Cartón rígido 2mm + impresión en kraft',
                    'S: 15×15×12 cm / M: 25×20×15 cm / L: 35×25×20 cm',
                    'Cinta terciopelo rojo + tarjeta personalizada incluida'
                ),
            ],

            // tipo: etiquetas
            [
                'category_id'       => $cats['Navidad'],
                'product_type_id'   => $types['etiquetas'],
                'style_id'          => $styles['Vintage'],
                'nombre'            => 'Pack 30 Etiquetas Colgantes Navidad Kraft',
                'descripcion'       => '30 etiquetas colgantes de cartón kraft para regalos navideños. Con hilo de yute. Lanzarote.',
                'descripcion_larga' => 'Treinta etiquetas colgantes troqueladas en cartón kraft 300g con ilustraciones navideñas en tinta negra. Diseños incluidos (5 de cada): árbol, reno, estrella, calcetín, muñeco de nieve y trineo. Cada etiqueta tiene agujero reforzado con anilla metálica dorada e hilo de yute de 15 cm incluido. Tamaño: 6×9 cm. Espacio para escribir "De:" y "Para:" en el reverso liso. Ideales para regalos artesanales, cestas y mercadillos navideños. Se pueden personalizar con logo de empresa bajo pedido (mínimo 100 unidades).',
                'precio'            => 8.99,
                'precio_original'   => 11.99,
                'tipo_archivo' => 'N/A',
                'badge'             => 'oferta',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 40,
                'descarga_inmediata' => false,
                'destacado'         => false,
                'tags'              => ['etiquetas', 'navidad', 'kraft', 'colgantes', 'regalos', 'lanzarote'],
                'ventas_count'      => 63,
                'rating_promedio'   => 4.6,
                'resenas_count'     => 41,
                'detalles'          => $detalesFisico(
                    'Cartón kraft 300g + anilla metálica dorada',
                    '6 × 9 cm con agujero reforzado',
                    'Troquelado, impresión en tinta negra, hilo yute incluido'
                ),
            ],

            // ─────────────────────────────────────────────
            // 🌸 FLORAL — FÍSICOS
            // ─────────────────────────────────────────────

            // tipo: papeleria
            [
                'category_id'       => $cats['Floral'],
                'product_type_id'   => $types['papeleria'],
                'style_id'          => $styles['Floral'],
                'nombre'            => 'Set Papelería Floral Impresa Premium',
                'descripcion'       => 'Set de papelería floral impresa: cuaderno, marcapáginas y tarjetas. Lanzarote.',
                'descripcion_larga' => 'Set de papelería premium con diseño floral para regalar o uso personal. Incluye: 1 cuaderno A5 tapa blanda con diseño floral (80 hojas rayadas), 3 marcapáginas en cartulina 350g con ilustraciones florales distintas, 5 tarjetas de felicitación multiuso con sobre kraft y 1 bloc de notas adhesivas 7×7 cm (50 hojas) con motivo floral en cabecera. Todo en la misma paleta cromática para un regalo cohesionado. Presentado en bolsa de papel kraft con lazo incluida.',
                'precio'            => 24.99,
                'precio_original'   => 32.00,
                'tipo_archivo' => 'N/A',
                'badge'             => null,
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 14,
                'descarga_inmediata' => false,
                'destacado'         => true,
                'tags'              => ['papelería', 'floral', 'cuaderno', 'regalo', 'set', 'lanzarote'],
                'ventas_count'      => 27,
                'rating_promedio'   => 4.9,
                'resenas_count'     => 19,
                'detalles'          => $detalesFisico(
                    'Cuaderno tapa blanda + cartulina 350g + papel adhesivo',
                    'Cuaderno A5 / Marcapáginas 5×15cm / Tarjetas A6',
                    'Impresión digital + presentación en bolsa kraft'
                ),
            ],

            // ─────────────────────────────────────────────
            // 🎓 GRADUACIÓN — FÍSICOS
            // ─────────────────────────────────────────────

            // tipo: cajas
            [
                'category_id'       => $cats['Graduación'],
                'product_type_id'   => $types['cajas'],
                'style_id'          => $styles['Minimalista'],
                'nombre'            => 'Caja Regalo Graduación Personalizada Oro y Negro',
                'descripcion'       => 'Caja de regalo para graduación en negro y dorado con nombre y año de graduación. Lanzarote.',
                'descripcion_larga' => 'Caja de cartón rígido en color negro mate con texto dorado personalizado. Incluye nombre del graduado, titulación y año de graduación. Tamaño M (22×22×15 cm) ideal para libros, detalles o pequeños regalos. Relleno de papel seda negro y dorado incluido. Lazo de cinta satinada dorada. Tarjeta de felicitación en blanco para mensaje personalizado a mano incluida. Perfecta como regalo de empresa, de familia o de amigos para celebrar la graduación.',
                'precio'            => 21.99,
                'precio_original'   => 27.99,
                'tipo_archivo' => 'N/A',
                'badge'             => 'nuevo',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 16,
                'descarga_inmediata' => false,
                'destacado'         => true,
                'tags'              => ['caja', 'graduación', 'regalo', 'negro', 'dorado', 'lanzarote'],
                'ventas_count'      => 20,
                'rating_promedio'   => 4.8,
                'resenas_count'     => 14,
                'detalles'          => $detalesFisico(
                    'Cartón rígido 2mm negro mate + texto dorado laminado',
                    '22 × 22 × 15 cm',
                    'Laminado negro mate + dorado brillante en texto'
                ),
            ],

            // tipo: invitaciones
            [
                'category_id'       => $cats['Graduación'],
                'product_type_id'   => $types['invitaciones'],
                'style_id'          => $styles['Minimalista'],
                'nombre'            => 'Invitaciones Graduación Impresas Minimalistas x10',
                'descripcion'       => '10 invitaciones de graduación impresas en negro y dorado. Elegantes y personalizadas. Lanzarote.',
                'descripcion_larga' => 'Invitaciones de graduación impresas en cartulina premium 380g con diseño minimalista en negro y dorado. Personalizadas con: nombre del graduado, titulación, universidad/centro, fecha, hora y lugar de la celebración. Formato A6 doble cara con sobre negro incluido. Detalle de birrete dorado troquelado en la esquina superior. Se envía prueba digital en 24h. Producción en 2–3 días laborables tras aprobación. Precio por 10 unidades — descuento progresivo para más cantidad.',
                'precio'            => 20.00,
                'precio_original'   => null,
                'tipo_archivo' => 'N/A',
                'badge'             => null,
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 18,
                'descarga_inmediata' => false,
                'destacado'         => false,
                'tags'              => ['invitaciones', 'graduación', 'impresas', 'negro', 'dorado', 'lanzarote'],
                'ventas_count'      => 15,
                'rating_promedio'   => 4.9,
                'resenas_count'     => 11,
                'detalles'          => $detalesFisico(
                    'Cartulina premium 380g',
                    'A6 (10.5 × 14.8 cm)',
                    'Impresión digital negro + dorado laminado + troquelado birrete'
                ),
            ],

            // ─────────────────────────────────────────────
            // 💕 AMOR — FÍSICOS
            // ─────────────────────────────────────────────

            // tipo: cajas
            [
                'category_id'       => $cats['Amor'],
                'product_type_id'   => $types['cajas'],
                'style_id'          => $styles['Minimalista'],
                'nombre'            => 'Caja San Valentín Personalizada con Mensaje',
                'descripcion'       => 'Caja de regalo para San Valentín con mensaje personalizado. Rosa y dorado. Lanzarote.',
                'descripcion_larga' => 'Caja de cartón rígido en rosa empolvado con detalles dorados y corazones. Personalizada con nombres de la pareja y un mensaje de hasta 3 líneas en el interior de la tapa. Tamaño M (20×20×12 cm). Relleno de papel seda rosa y dorado incluido. Lazo de tul blanco. Ideal para regalar joyas, perfumes, chocolates o cualquier detalle especial. Se puede encargar con relleno de pétalos de rosa secos (+4€). Entrega express disponible en Lanzarote.',
                'precio'            => 19.99,
                'precio_original'   => null,
                'tipo_archivo' => 'N/A',
                'badge'             => null,
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 12,
                'descarga_inmediata' => false,
                'destacado'         => false,
                'tags'              => ['caja', 'san valentín', 'amor', 'personalizada', 'rosa', 'lanzarote'],
                'ventas_count'      => 33,
                'rating_promedio'   => 4.9,
                'resenas_count'     => 25,
                'detalles'          => $detalesFisico(
                    'Cartón rígido 2mm rosa empolvado + detalles dorados',
                    '20 × 20 × 12 cm',
                    'Laminado soft touch + dorado brillante en corazones'
                ),
            ],

            // tipo: papeleria
            [
                'category_id'       => $cats['Amor'],
                'product_type_id'   => $types['papeleria'],
                'style_id'          => $styles['Minimalista'],
                'nombre'            => 'Set Cartas de Amor Impresas Personalizadas',
                'descripcion'       => 'Set de 5 cartas de amor impresas con textos personalizados. Romántico y elegante. Lanzarote.',
                'descripcion_larga' => 'Cinco cartas de amor impresas en papel pergamino de 120g con bordes envejecidos. Cada carta tiene un texto base romántico que se personaliza con los nombres de la pareja y detalles específicos que el cliente proporciona por WhatsApp. Temas: primer encuentro, lo que más amo de ti, nuestros momentos, promesas y carta del futuro. Presentadas enrolladas con cinta de raso y lacre de cera dorado. Caja de madera decorativa opcional (+12€). Un regalo único e irrepetible.',
                'precio'            => 27.99,
                'precio_original'   => 35.00,
                'tipo_archivo' => 'N/A',
                'badge'             => 'popular',
                'estado'            => 'activo',
                'modalidad'         => 'fisico',
                'zona_envio'        => 'Lanzarote',
                'stock'             => 9,
                'descarga_inmediata' => false,
                'destacado'         => true,
                'tags'              => ['cartas', 'amor', 'personalizadas', 'romántico', 'regalo', 'lanzarote'],
                'ventas_count'      => 28,
                'rating_promedio'   => 5.0,
                'resenas_count'     => 23,
                'detalles'          => $detalesFisico(
                    'Papel pergamino 120g + lacre de cera + cinta raso',
                    'A5 (14.8 × 21 cm) enrolladas',
                    'Bordes envejecidos + lacre dorado sellado a mano'
                ),
            ],
        ];

        // ═══════════════════════════════════════════════════════
        // INSERT — solo si no existe (idempotente)
        // ═══════════════════════════════════════════════════════
        $creados = 0;
        foreach ($productos as $prod) {
            if (!Product::where('nombre', $prod['nombre'])->exists()) {
                Product::create($prod);
                $creados++;
            }
        }

        $this->command->info("✅ Productos creados: {$creados} / " . count($productos));
    }
}
