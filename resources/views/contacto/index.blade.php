@extends('layouts.app')

@section('content')
    <!-- ═══ PAGE HERO ═══ -->
    <div class="page-hero">
        <div class="page-hero-inner">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Inicio</a> <span>›</span>
                <span>Contáctanos</span>
            </div>
            <h1>¡Hola! ¿En qué te <span>ayudamos</span>? 🌸</h1>
            <p>Estamos aquí para resolver todas tus dudas. Respondemos rápido, con mucho cariño.</p>
        </div>
    </div>

    <!-- ═══ CANALES RÁPIDOS ═══ -->
    <div class="canales-wrap">
        <a href="https://wa.me/573000000000" class="canal-card verde">
            <div class="canal-icon">💬</div>
            <div class="canal-name">WhatsApp</div>
            <div class="canal-desc">La forma más rápida de hablar con nosotras. Te respondemos al instante.</div>
            <span class="canal-tiempo">⚡ Respuesta en minutos</span>
        </a>
        <a href="mailto:contacto@gomita.com" class="canal-card">
            <div class="canal-icon">📧</div>
            <div class="canal-name">Email</div>
            <div class="canal-desc">Para consultas detalladas o encargos personalizados con todos los detalles.</div>
            <span class="canal-tiempo">🕐 Respuesta en 24 hs</span>
        </a>
        <a href="https://instagram.com/gomita.art" class="canal-card">
            <div class="canal-icon">📸</div>
            <div class="canal-name">Instagram</div>
            <div class="canal-desc">Siguenos y escribenos por DM. También publicamos novedades y tips allí.</div>
            <span class="canal-tiempo">🕐 Respuesta en 24 hs</span>
        </a>
    </div>
    <div class="contacto-layout">

        <!-- FORMULARIO -->
        <div class="form-card">
            <h2>✉️ Envianos un mensaje</h2>
            <p>Completá el formulario y te respondemos a la brevedad. Ninguna consulta queda sin respuesta.</p>

            <div id="form-contenido">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nombre <span class="req">*</span></label>
                        <input type="text" class="form-input" placeholder="Tu nombre">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-input" placeholder="Tu apellido">
                    </div>
                </div>

                <div class="form-group">
                    <label>Email <span class="req">*</span></label>
                    <input type="email" class="form-input" placeholder="tu@email.com">
                </div>

                <div class="form-group">
                    <label>¿Sobre qué necesitás ayuda? <span class="req">*</span></label>
                    <select class="form-select">
                        <option value="" disabled selected>Seleccioná un tema</option>
                        <option>📥 Problema con mi descarga</option>
                        <option>✏️ Ayuda para editar en Canva</option>
                        <option>🖨️ Consulta sobre impresión</option>
                        <option>🎨 Encargo de diseño personalizado</option>
                        <option>💳 Consulta sobre pagos</option>
                        <option>🔄 Solicitud de reembolso</option>
                        <option>💡 Otra consulta</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Número de pedido <span style="color:var(--text-soft);font-weight:600">(opcional)</span></label>
                    <input type="text" class="form-input" placeholder="Ej: #00123">
                </div>

                <div class="form-group">
                    <label>Tu mensaje <span class="req">*</span></label>
                    <textarea class="form-textarea"
                        placeholder="Contanos en qué podemos ayudarte. Cuanto más detallada sea tu consulta, más rápido podremos resolverla 💕"></textarea>
                </div>

                <div class="form-check">
                    <input type="checkbox" id="privacidad">
                    <label for="privacidad">Acepto la <a href="#">política de privacidad</a> y los <a
                            href="#">términos y condiciones</a> de Gomita.</label>
                </div>

                <button class="btn-enviar" onclick="enviarFormulario()">
                    💌 Enviar mensaje
                </button>
            </div>

            <!-- Mensaje de éxito (oculto hasta enviar) -->
            <div class="form-success" id="form-success">
                <div class="success-icon">🎉</div>
                <h3>¡Mensaje enviado!</h3>
                <p>Gracias por escribirnos. Te respondemos en las próximas 24 horas. Mientras tanto, chequeá nuestras
                    preguntas frecuentes, ¡puede que ya tengamos tu respuesta! 💕</p>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="info-sidebar">

            <!-- Datos de contacto -->
            <div class="info-card">
                <h3>📍 Información de contacto</h3>
                <div class="info-item">
                    <div class="ii-icon">📧</div>
                    <div class="ii-body">
                        <strong>Email</strong>
                        <span><a href="mailto:contacto@gomita.com">contacto@gomita.com</a></span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="ii-icon">💬</div>
                    <div class="ii-body">
                        <strong>WhatsApp</strong>
                        <span><a href="https://wa.me/573000000000">+57 300 000 0000</a></span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="ii-icon">📸</div>
                    <div class="ii-body">
                        <strong>Instagram</strong>
                        <span><a href="#">@gomita.art</a></span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="ii-icon">📌</div>
                    <div class="ii-body">
                        <strong>Pinterest</strong>
                        <span><a href="#">@gomitaplantillas</a></span>
                    </div>
                </div>
                <div class="info-item">
                    <div class="ii-icon">🇨🇴</div>
                    <div class="ii-body">
                        <strong>Ubicación</strong>
                        <span>Colombia · Atendemos a todo el país y el mundo</span>
                    </div>
                </div>
            </div>

            <!-- Horarios -->
            <div class="info-card">
                <h3>🕐 Horario de atención</h3>
                <div class="horario-row">
                    <span class="dia">Lunes – Viernes</span>
                    <span class="hora">9:00 – 18:00</span>
                </div>
                <div class="horario-row">
                    <span class="dia">Sábados</span>
                    <span class="hora">10:00 – 14:00</span>
                </div>
                <div class="horario-row">
                    <span class="dia">Domingos</span>
                    <span class="cerrado">Cerrado</span>
                </div>
                <div
                    style="margin-top:12px; display:flex; align-items:center; gap:6px; font-size:12px; font-weight:700; color:var(--text-soft);">
                    <span class="badge-online">● En línea ahora</span>
                    <span>Respondemos en minutos</span>
                </div>
            </div>

            <!-- Redes sociales -->
            <div class="info-card">
                <h3>🌐 Seguinos en redes</h3>
                <div class="redes-grid">
                    <a href="#" class="red-link"><span class="red-icon">📸</span> Instagram</a>
                    <a href="#" class="red-link"><span class="red-icon">📌</span> Pinterest</a>
                    <a href="#" class="red-link"><span class="red-icon">💬</span> WhatsApp</a>
                    <a href="#" class="red-link"><span class="red-icon">🎵</span> TikTok</a>
                </div>
            </div>

            <!-- FAQ rápido -->
            <div class="info-card">
                <h3>❓ Preguntas frecuentes</h3>

                <div class="faq-item">
                    <button class="faq-q" onclick="toggleFaq(this)">
                        ¿Cómo descargo mis archivos?
                        <span class="faq-arrow">▾</span>
                    </button>
                    <div class="faq-a">Tras confirmar el pago recibís un email con el link de descarga. También encontrás
                        los archivos en "Mi cuenta → Mis compras".</div>
                </div>

                <div class="faq-item">
                    <button class="faq-q" onclick="toggleFaq(this)">
                        ¿Puedo editar los diseños?
                        <span class="faq-arrow">▾</span>
                    </button>
                    <div class="faq-a">¡Sí! Los archivos editables en Canva se abren con tu cuenta gratuita. Solo hacés
                        clic en el link y personalizás nombre, colores y más.</div>
                </div>

                <div class="faq-item">
                    <button class="faq-q" onclick="toggleFaq(this)">
                        ¿Hacen diseños personalizados?
                        <span class="faq-arrow">▾</span>
                    </button>
                    <div class="faq-a">Sí, hacemos encargos especiales. Escribinos por WhatsApp o email con los detalles y
                        te enviamos un presupuesto sin compromiso.</div>
                </div>

                <div class="faq-item">
                    <button class="faq-q" onclick="toggleFaq(this)">
                        ¿Qué hago si mi descarga falla?
                        <span class="faq-arrow">▾</span>
                    </button>
                    <div class="faq-a">Escribinos con tu número de pedido y te reenviamos el link al instante. ¡Nunca te
                        quedás sin tu archivo!</div>
                </div>

            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // Formulario con feedback de éxito
        function enviarFormulario() {
            const nombre = document.querySelector('.form-input');
            if (!nombre.value.trim()) {
                nombre.style.borderColor = 'var(--pink)';
                nombre.focus();
                return;
            }
            document.getElementById('form-contenido').style.display = 'none';
            document.getElementById('form-success').style.display = 'block';
        }

        // FAQ accordion
        function toggleFaq(btn) {
            const answer = btn.nextElementSibling;
            const isOpen = answer.classList.contains('open');
            // Cerrar todos
            document.querySelectorAll('.faq-a').forEach(a => a.classList.remove('open'));
            document.querySelectorAll('.faq-q').forEach(q => q.classList.remove('open'));
            // Abrir el clickeado si estaba cerrado
            if (!isOpen) {
                answer.classList.add('open');
                btn.classList.add('open');
            }
        }
    </script>
@endpush
