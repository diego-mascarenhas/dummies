# 🛠️ Dummies - Herramientas de Desarrollo y Testing

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-blue.svg)](https://www.php.net/)
[![Status](https://img.shields.io/badge/Status-Activo-green.svg)](https://github.com/diego-mascarenhas/dummies)

> Repositorio de herramientas útiles para desarrollo, testing y debugging de aplicaciones web.

## 📁 Contenido del Repositorio

### 📧 PHPMailer Testing Tool
Una herramienta web completa para probar configuraciones de envío de emails usando PHPMailer, con soporte para múltiples proveedores SMTP y servidores personalizados.

**Ubicación:** `PHPMailer-6.10.0/`

---

## 📧 PHPMailer Testing Tool

### ✨ Características

- 🚀 **Interfaz web intuitiva** para probar envío de emails
- 🔧 **Múltiples configuraciones SMTP** preconfiguradas:
  - Gmail (Puerto 587 STARTTLS / Puerto 465 SSL)
  - Outlook (Puerto 587 STARTTLS)
  - Yahoo (Puerto 587 STARTTLS)
  - **Servidor SMTP personalizado** con configuración flexible
- 🔍 **Debug detallado** con output en tiempo real
- 🎨 **Interfaz moderna** y responsive
- ⚡ **Validación automática** de campos y configuraciones
- 🛡️ **Manejo seguro** de credenciales y errores

### 📋 Requisitos

- **PHP:** 7.4 o superior
- **Extensiones PHP requeridas:**
  - `mbstring`
  - `openssl`
  - `socket` (para SMTP)
- **Servidor web:** Apache, Nginx o similar
- **Credenciales SMTP** válidas para testing

### 🚀 Instalación y Uso

#### 1. Clonar el repositorio
```bash
git clone https://github.com/diego-mascarenhas/dummies.git
cd dummies/PHPMailer-6.10.0
```

#### 2. Configurar el servidor web
Asegúrate de que tu servidor web apunte al directorio `PHPMailer-6.10.0/` o configura un virtual host.

#### 3. Abrir en el navegador
```
http://localhost/PHPMailer-6.10.0/
```

#### 4. Configurar credenciales
Edita las variables en `index.php` (líneas 42-44):
```php
$userEmail = 'tu-email@ejemplo.com';
$userPassword = 'tu-password-o-app-password';
$destinationEmail = 'destino@ejemplo.com';
```

### 🔧 Configuraciones SMTP Soportadas

| Proveedor | Servidor | Puerto | Encriptación | Notas |
|-----------|----------|---------|--------------|-------|
| **Gmail** | smtp.gmail.com | 587 | STARTTLS | Requiere App Password |
| **Gmail** | smtp.gmail.com | 465 | SSL/TLS | Requiere App Password |
| **Outlook** | smtp-mail.outlook.com | 587 | STARTTLS | Puede requerir 2FA |
| **Yahoo** | smtp.mail.yahoo.com | 587 | STARTTLS | Requiere App Password |
| **Personalizado** | Tu servidor | 587/465/25 | STARTTLS/SSL/Ninguna | Configurable |

### 🎯 Cómo usar el servidor personalizado

1. **Selecciona** "Servidor SMTP Personalizado" en el dropdown
2. **Ingresa** los datos de tu servidor:
   - **Servidor SMTP:** `mail.tudominio.com` (o IP del servidor)
   - **Encriptación:** 
     - `STARTTLS (Puerto 587)` - Recomendado
     - `SSL/TLS (Puerto 465)` - Para servidores que requieren SSL
     - `Sin encriptación (Puerto 25)` - Solo para testing local
3. **Completa** las credenciales de tu servidor
4. **Haz clic** en "Probar Envío de Email"

### 📱 Configuración para Gmail

Para usar Gmail necesitas crear una **App Password**:

1. Ve a tu cuenta de Google → Seguridad
2. Habilita la verificación en 2 pasos
3. Genera una "Contraseña de aplicación"
4. Usa esta contraseña en lugar de tu contraseña normal

### 🔍 Debug y Troubleshooting

La herramienta incluye **debug detallado** que muestra:
- ✅ Conexión al servidor SMTP
- 🔐 Proceso de autenticación
- 📤 Envío del mensaje
- ❌ Errores específicos con soluciones

**Errores comunes:**
- **Connection timed out:** Verifica firewall y puertos
- **Authentication failed:** Revisa credenciales y App Passwords
- **SSL/TLS errors:** Prueba diferentes puertos y tipos de encriptación

### 🛠️ Estructura del Proyecto

```
PHPMailer-6.10.0/
├── index.php              # Herramienta de testing principal
├── src/                   # Clases de PHPMailer
│   ├── PHPMailer.php
│   ├── SMTP.php
│   └── Exception.php
├── language/              # Traducciones de errores
├── README.md             # Documentación original de PHPMailer
└── LICENSE               # Licencia LGPL 2.1
```

### 🎨 Características de la Interfaz

- **🎯 Formulario intuitivo** con validación en tiempo real
- **🔄 Configuración dinámica** que se adapta al proveedor seleccionado
- **📊 Resultados visuales** con códigos de color (éxito/error)
- **📋 Debug expandible** para análisis técnico detallado
- **💡 Tips contextuales** para cada configuración
- **📱 Design responsive** para móviles y tablets

### 🔐 Seguridad

- ✅ **Validación de inputs** para prevenir inyecciones
- ✅ **Escape de HTML** en todos los outputs
- ✅ **Manejo seguro** de credenciales
- ⚠️ **Nota:** No usar en producción con credenciales reales

---

## 🤝 Contribuir

¡Las contribuciones son bienvenidas! Si tienes ideas para nuevas herramientas o mejoras:

1. **Fork** el proyecto
2. **Crea** una rama para tu feature (`git checkout -b feature/nueva-herramienta`)
3. **Commit** tus cambios (`git commit -m 'Añade nueva herramienta'`)
4. **Push** a la rama (`git push origin feature/nueva-herramienta`)
5. **Abre** un Pull Request

### 💡 Ideas para contribuir

- 🛠️ Nuevas herramientas de testing (APIs, bases de datos, etc.)
- 🎨 Mejoras en la interfaz de usuario
- 📝 Documentación adicional
- 🐛 Reportes de bugs y fixes
- 🌐 Traducciones a otros idiomas

## 📞 Soporte

Si encuentras algún problema o necesitas ayuda:

- 📁 **Issues:** [GitHub Issues](https://github.com/diego-mascarenhas/dummies/issues)
- 💼 **LinkedIn:** [Diego Mascarenhas](https://www.linkedin.com/in/diego-mascarenhas/)
- 📚 **Wiki:** [Documentación extendida](https://github.com/diego-mascarenhas/dummies/wiki)

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para detalles.

### Componentes de terceros

- **PHPMailer:** LGPL 2.1 License - [Ver detalles](PHPMailer-6.10.0/LICENSE)

---

## 🎯 Próximas Herramientas

- 🗄️ **Database Connection Tester** - Probar conexiones a diferentes bases de datos
- 🌐 **API Response Checker** - Testing de endpoints y APIs
- 🔒 **SSL Certificate Validator** - Verificación de certificados SSL
- 📊 **Performance Monitor** - Análisis de rendimiento web
- 🎨 **Color Palette Generator** - Generador de paletas de colores

---

<div align="center">

**⭐ Si te resulta útil, no olvides darle una estrella al repo ⭐**

---

*Desarrollado por [DAMG](https://www.linkedin.com/in/diego-mascarenhas/)*

</div> 