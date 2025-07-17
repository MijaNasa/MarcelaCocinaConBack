<template>
    <div class="min-h-screen bg-[#e8ded2]">
      <!-- Header -->
      <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
              <div class="w-10 h-10 bg-[#e8ded2] rounded-full flex items-center justify-center">
                <img src="/Imagenes/LogoPrincipal.jpg" alt="Logo" class="w-10 h-10 rounded-full">
              </div>
              <h1 class="text-2xl font-bold text-gray-800">Marcela Cocina</h1>
            </div>
            
            <!-- Mobile menu button -->
            <button 
              @click="mobileMenuOpen = !mobileMenuOpen"
              class="md:hidden p-2 rounded-md text-gray-800 hover:bg-gray-100"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      :d="mobileMenuOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'">
                </path>
              </svg>
            </button>
            
            <!-- Desktop menu -->
            <div class="hidden md:flex space-x-8">
              <button @click="scrollToSection('inicio')" class="text-gray-800 hover:text-black font-medium transition-colors">Inicio</button>
              <button @click="scrollToSection('menu')" class="text-gray-800 hover:text-black font-medium transition-colors">Menú</button>
              <button @click="scrollToSection('nosotros')" class="text-gray-800 hover:text-black font-medium transition-colors">Nosotros</button>
              <button @click="scrollToSection('contacto')" class="text-gray-800 hover:text-black font-medium transition-colors">Contacto</button>
            </div>
          </div>
          
          <!-- Mobile menu -->
          <div v-show="mobileMenuOpen" class="md:hidden mt-4 pb-4 border-t border-gray-200">
            <div class="flex flex-col space-y-3 pt-4">
              <button @click="scrollToSection('inicio')" class="text-left text-black hover:text-gray-600 font-medium">Inicio</button>
              <button @click="scrollToSection('menu')" class="text-left text-black hover:text-gray-600 font-medium">Menú</button>
              <button @click="scrollToSection('nosotros')" class="text-left text-black hover:text-gray-600 font-medium">Nosotros</button>
              <button @click="scrollToSection('contacto')" class="text-left text-black hover:text-gray-600 font-medium">Contacto</button>
            </div>
          </div>
        </nav>
      </header>
  
      <!-- Hero Section -->
      <section id="inicio" class="bg-[#e8ded2] text-black py-20">
        <div class="container mx-auto px-4 text-center">
          
          <h2 class="flex items-center justify-center mb-12">
                <img src="/Imagenes/LogoPrincipal2.jpg" alt="Logo" class="w-96 h-96 rounded-xl"> 
              </h2>
        
          <button 
            @click="scrollToMenu"
            class="bg-white text-black px-8 py-3 rounded-full font-semibold text-lg hover:bg-gray-200 transition-colors shadow-lg"
          >
            Ver Menú
          </button>
        </div>
      </section>
  
      <!-- Menu Section -->
      <section id="menu" class="py-16 bg-white">
        <div class="container mx-auto px-4">
          <h3 class="text-4xl font-bold text-center text-black mb-12">Nuestro Menú</h3>
          
          <div v-for="(items, category) in menuCategories" :key="category" class="mb-16">
            <h4 class="text-3xl font-bold text-center text-black mb-8">{{ category }}</h4>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
              <div v-for="item in items" :key="item.id"
                   class="bg-orange-50 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                <div class="h-48 bg-gradient-to-br from-orange-200 to-orange-300 flex items-center justify-center">
                  <div v-if="item.imagen" class="text-6xl w-full h-full">
                    <img :src="item.imagen" :alt="item.name" class="w-full h-full object-cover"
                         @error="handleImageError">
                  </div>
                  <div v-else class="text-6xl flex items-center justify-center w-full h-full">
                    {{ item.emoji }}
                  </div>
                </div>
                <div class="p-6">
                  <h5 class="text-xl font-bold text-black mb-2">{{ item.name }}</h5>
                  <p class="text-gray-600 mb-4">{{ item.description }}</p>
                  <div class="flex justify-between items-center">
                    <span class="text-xl font-medium text-black">{{ item.price }} precio</span>
                    <button @click="sendWhatsApp(item)" class="bg-black text-white px-4 py-2 rounded-full hover:bg-green-600 transition-colors">
                      Pedir
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- About Section -->
      <section id="nosotros" class="py-16 bg-orange-50">
        <div class="container mx-auto px-4">
          <div class="max-w-4xl mx-auto text-center">
            <h3 class="text-4xl font-bold text-black mb-8">Sobre Nosotros</h3>
            <div class="grid md:grid-cols-2 gap-12 items-center">
              <div>
                <div class="w-64 h-64 bg-gradient-to-br from-[#e8ded2] to-[#e8ded2] rounded-full mx-auto flex items-center justify-center">
                  <span class="text-8xl">👩‍🍳</span>
                </div>
              </div>
              <div class="text-left">
                <p class="text-lg text-gray-700 mb-6">
                  En Marcela Cocina, creemos que la comida casera es el corazón de todo hogar.
                  Cada plato está preparado con ingredientes frescos y mucho amor, siguiendo
                  recetas tradicionales que han pasado de generación en generación.
                </p>
                <p class="text-lg text-gray-700 mb-6">
                  Desde nuestra deliciosa tarta de sushi hasta la clásica tortilla de papas,
                  cada bocado te transportará a esos momentos especiales en familia.
                </p>
                <div class="flex flex-wrap gap-4">
                  <span class="bg-[#e8ded2] text-black px-3 py-1 rounded-full text-sm font-medium">Ingredientes Frescos</span>
                  <span class="bg-[#e8ded2] text-black px-3 py-1 rounded-full text-sm font-medium">Recetas Caseras</span>
                  <span class="bg-[#e8ded2] text-black px-3 py-1 rounded-full text-sm font-medium">Hecho con Amor</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Contact Section -->
      <section id="contacto" class="py-16 bg-white">
        <div class="container mx-auto px-4">
          <h3 class="text-4xl font-bold text-center text-black mb-12">¡Hacé tu pedido!</h3>
          
          <div class="flex justify-center items-center gap-12 max-w-4xl mx-auto">
            <div class="space-y-4">
              <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-[#e8ded2] rounded-full flex items-center justify-center">
                  <span class="text-white text-xl">📱</span>
                </div>
                <div>
                  <p class="font-semibold text-gray-800">WhatsApp</p>
                  <p class="text-gray-600">+54 9 341 519-5229</p>
                </div>
              </div>
              
              <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-[#e8ded2] rounded-full flex items-center justify-center">
                  <span class="text-white text-xl">📍</span>
                </div>
                <div>
                  <p class="font-semibold text-gray-800">Ubicación</p>
                  <p class="text-gray-600"> Rosario, Argentina</p>
                </div>
              </div>
              
              <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-[#e8ded2] rounded-full flex items-center justify-center">
                  <span class="text-white text-xl">🕒</span>
                </div>
                <div>
                  <p class="font-semibold text-gray-800">Horarios</p>
                  <p class="text-gray-600">Lun - Dom: 11:00 - 22:00</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Footer -->
      <footer class="bg-[#e8ded2] text-black py-8">
        <div class="container mx-auto px-4 text-center">
          <div class="flex items-center justify-center space-x-2 mb-4">
            <div class="w-10 h-10 rounded-full flex items-center justify-center">
              <img src="/Imagenes/LogoPrincipal.jpg" alt="Logo" class="w-10 h-10 rounded-full">
            </div>
            <h5 class="text-xl font-bold">Marcela Cocina</h5>
          </div>
          <p class="text-black mb-4">Supervisado por Rab Mendi Tawil</p>
          <div class="flex justify-center space-x-6">
          
          </div>
          <div class="mt-6 pt-6 border-t border-black">
            <p class="text-black text-sm">© 2025 Marcela Cocina. Todos los derechos reservados.</p>
          </div>
        </div>
      </footer>
      <!-- Floating WhatsApp Button -->
  <div class="fixed bottom-6 right-6 z-50">
    <a 
      href="https://wa.me/5493415195229" 
      target="_blank"
      class="bg-green-500 w-16 h-16 rounded-full flex items-center justify-center shadow-lg hover:bg-green-600 transition-colors"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="white">
        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
      </svg>
    </a>
  </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'MarcelaCocina',
    data() {
      return {
        mobileMenuOpen: false,
        menuCategories: {
          'Platos Principales': [
            {
              id: 2,
              name: 'Carne con Papas',
              description: 'Tierna carne cocida a la perfección acompañada de papas doradas y condimentos caseros.',
              price: 'Consultar',
              emoji: '🥩',
              imagen: '/Imagenes/carnePapas.jpg',
            },
            {
              id: 3,
              name: 'Tortilla de Papas',
              description: 'Clásica tortilla española con papas y huevos frescos. Un sabor tradicional irresistible.',
              price: 'Consultar',
              emoji: '🥚',
              imagen: '/Imagenes/TortillaPapa.jpg',
            },
            {
              id: 4,
              name: 'Empanadas Caseras',
              description: 'Empanadas artesanales con rellenos variados: carne, pollo.',
              price: 'Consultar',
              emoji: '🥟',
              imagen: '/Imagenes/empanadas.jpg',
            },
            {
              id: 5,
              name: 'Carne con arroz',
              description: 'Carne cocida a la perfección acompañada de arroz y condimentos caseros.',
              price: 'Consultar',
              emoji: '🍖',
              imagen: '/Imagenes/carneArroz.jpg'
            },
            {
              id: 8,
              name: 'Arroz con Verduras',
              description: 'Arroz con verduras cocido a la perfección.',
              price: 'Consultar',
              emoji: '🍚',
              imagen: '/Imagenes/ArrozConVerdu.jpg'
            },
            {
              id: 12,
              name: 'Brouchetes de pollo',
              description: 'Brouchetes de pollo cocido a la perfección.',
              price: 'Consultar',
              emoji: '🍗',
              imagen: '/Imagenes/palitosPollo.jpg'
            },
            {
              id: 13,
              name: 'Pollo con salsa',
              description: 'Pollo cocido a la perfección con salsa casera.',
              price: 'Consultar',
              emoji: '🍗',
              imagen: '/Imagenes/polloSalsa.jpg'
            },
            {
              id: 15,
              name: 'Carne a la barbacoa',
              description: 'Carne cocida a la perfección acompañada de arroz y condimentos caseros.',
              price: 'Consultar',
              emoji: '🍖',
              imagen: '/Imagenes/CarneBBQ.jpg'
            },
            {
              id: 10,
              name: 'Soufle de Champiñones',
              description: 'Delicioso soufle de champiñones con queso crema y salsa de champiñones.',
              price: 'Consultar',
              emoji: '🍄',
              imagen: '/Imagenes/HongosSoufle.jpg',
            },
          ],
          'Tartas': [
            {
              id: 1,
              name: 'Tarta de Sushi',
              description: 'Deliciosa tarta con salmón, palta y queso crema. Una fusión perfecta de sabores.',
              price: 'Consultar',
              emoji: '🍣',
              imagen: '/Imagenes/tortaSushi.jpg',
            },
            {
              id: 7,
              name: 'Tarta de Manzana',
              description: 'Tarta de manzana casera con nueces.',
              price: 'Consultar',
              emoji: '🍎',
              imagen: '/Imagenes/applePie.jpg'
            },
            {
              id: 14,
              name: 'Tarta de calabaza',
              description: 'Tarta de calabaza casera con nueces.',
              price: 'Consultar',
              emoji: '🎃',
              imagen: '/Imagenes/TartaCalabaza.jpg'
            },
            {
              id: 16,
              name: 'Tarta de Verdura',
              description: 'Tarta de verdura casera.',
              price: 'Consultar',
              emoji: '🥬',
              imagen: '/Imagenes/tartaVerdu.jpg'
            }
          ],
          'Postres': [
            {
              id: 11,
              name: 'Lemon Pie',
              description: 'Delicioso pie de limón casero.',
              price: 'Consultar',
              emoji: '🍋',
              imagen: '/Imagenes/lemonPie.jpg',
            },
            {
              id: 12,
              name: 'Torta de Chocolate',
              description: 'Delicioso pie de chocolate casero.',
              price: 'Consultar',
              emoji: '🍫',
              imagen: '/Imagenes/TortaBruce.jpg',
            },
          ]
        }
      }
    },
    methods: {
      scrollToMenu() {
        document.getElementById('menu').scrollIntoView({ 
          behavior: 'smooth' 
        });
      },
      sendWhatsApp(item) {
        const phoneNumber = '5493415195229';
        const message = `Hola, me gustaría consultar por el plato: ${item.name}`;
        window.open(`https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`, '_blank');
      },
      scrollToSection(sectionId) {
        document.getElementById(sectionId).scrollIntoView({ 
          behavior: 'smooth' 
        });
        this.mobileMenuOpen = false;
      },
      findItemByImage(imageSrc) {
        for (const category of Object.values(this.menuCategories)) {
          for (const item of category) {
            if (item.imagen && imageSrc.includes(item.imagen)) {
              return item;
            }
          }
        }
        return null;
      }
    }
  }
  </script>
  
  <style scoped>
  /* Smooth scrolling for the entire page */
  html {
    scroll-behavior: smooth;
  }
  
  /* Custom animations */
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .fade-in-up {
    animation: fadeInUp 0.6s ease-out;
  }
  </style>