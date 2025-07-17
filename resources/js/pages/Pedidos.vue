<template>
  <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Gestión de Pedidos</h1>
    
    <!-- Formulario para crear/editar pedidos -->
    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
      <h2 class="text-xl font-semibold mb-4">{{ modoEdicion ? 'Editar Pedido' : 'Nuevo Pedido' }}</h2>
      <form @submit.prevent="guardarPedido" class="space-y-4">
        <div>
          <label for="producto" class="block text-sm font-medium text-gray-700">Producto *</label>
          <input
            type="text"
            id="producto"
            v-model="form.producto"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required
          >
        </div>
        
        <div>
          <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad *</label>
          <input
            type="number"
            id="cantidad"
            v-model.number="form.cantidad"
            min="1"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required
          >
        </div>
        
        <div>
          <label for="observaciones" class="block text-sm font-medium text-gray-700">Observaciones</label>
          <textarea
            id="observaciones"
            v-model="form.observaciones"
            rows="3"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
          ></textarea>
        </div>
        
        <div v-if="modoEdicion">
          <label for="estado" class="block text-sm font-medium text-gray-700">Estado *</label>
          <select
            id="estado"
            v-model="form.estado"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            required
          >
            <option value="pendiente">Pendiente</option>
            <option value="en_proceso">En Proceso</option>
            <option value="completado">Completado</option>
            <option value="cancelado">Cancelado</option>
          </select>
        </div>
        
        <div class="flex space-x-4 pt-4">
          <button
            type="submit"
            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          >
            {{ modoEdicion ? 'Actualizar Pedido' : 'Crear Pedido' }}
          </button>
          
          <button
            v-if="modoEdicion"
            type="button"
            @click="cancelarEdicion"
            class="inline-flex justify-center rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
          >
            Cancelar
          </button>
        </div>
      </form>
    </div>
    
    <!-- Lista de pedidos -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Lista de Pedidos</h3>
        <button
          @click="cargarPedidos"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
          </svg>
          Actualizar
        </button>
      </div>
      
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="pedido in pedidos" :key="pedido.id" class="hover:bg-gray-50">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">{{ pedido.producto }}</div>
                <div v-if="pedido.observaciones" class="text-sm text-gray-500">{{ pedido.observaciones }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ pedido.cantidad }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span 
                  :class="{
                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full': true,
                    'bg-yellow-100 text-yellow-800': pedido.estado === 'pendiente',
                    'bg-blue-100 text-blue-800': pedido.estado === 'en_proceso',
                    'bg-green-100 text-green-800': pedido.estado === 'completado',
                    'bg-red-100 text-red-800': pedido.estado === 'cancelado'
                  }"
                >
                  {{ formatEstado(pedido.estado) }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                <button 
                  @click="editarPedido(pedido)"
                  class="text-indigo-600 hover:text-indigo-900 mr-4"
                >
                  Editar
                </button>
                <button 
                  @click="confirmarEliminar(pedido)"
                  class="text-red-600 hover:text-red-900"
                >
                  Eliminar
                </button>
              </td>
            </tr>
            <tr v-if="pedidos.length === 0">
              <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                No hay pedidos registrados
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- Modal de confirmación para eliminar -->
    <div v-if="mostrarConfirmacion" class="fixed z-10 inset-0 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Eliminar pedido</h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">
                    ¿Estás seguro de que deseas eliminar el pedido de "{{ pedidoAEliminar?.producto }}"? Esta acción no se puede deshacer.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
              type="button"
              @click="eliminarPedido"
              class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
            >
              Eliminar
            </button>
            <button
              type="button"
              @click="mostrarConfirmacion = false"
              class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
            >
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
  setup() {
    const pedidos = ref([]);
    const form = ref({
      id: null,
      producto: '',
      cantidad: 1,
      observaciones: '',
      estado: 'pendiente'
    });
    const modoEdicion = ref(false);
    const mostrarConfirmacion = ref(false);
    const pedidoAEliminar = ref(null);

    const cargarPedidos = async () => {
      try {
        const response = await axios.get('/api/pedidos');
        pedidos.value = response.data;
      } catch (error) {
        console.error('Error al cargar los pedidos:', error);
        alert('Ocurrió un error al cargar los pedidos');
      }
    };

    const guardarPedido = async () => {
      try {
        if (modoEdicion.value) {
          await axios.put(`/api/pedidos/${form.value.id}`, form.value);
        } else {
          await axios.post('/api/pedidos', form.value);
        }
        
        resetForm();
        await cargarPedidos();
        alert(`Pedido ${modoEdicion.value ? 'actualizado' : 'creado'} correctamente`);
        modoEdicion.value = false;
      } catch (error) {
        console.error('Error al guardar el pedido:', error);
        alert('Ocurrió un error al guardar el pedido');
      }
    };

    const editarPedido = (pedido) => {
      form.value = { ...pedido };
      modoEdicion.value = true;
      window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    const confirmarEliminar = (pedido) => {
      pedidoAEliminar.value = pedido;
      mostrarConfirmacion.value = true;
    };

    const eliminarPedido = async () => {
      if (!pedidoAEliminar.value) return;
      
      try {
        await axios.delete(`/api/pedidos/${pedidoAEliminar.value.id}`);
        await cargarPedidos();
        mostrarConfirmacion.value = false;
        alert('Pedido eliminado correctamente');
      } catch (error) {
        console.error('Error al eliminar el pedido:', error);
        alert('Ocurrió un error al eliminar el pedido');
      } finally {
        pedidoAEliminar.value = null;
      }
    };

    const cancelarEdicion = () => {
      resetForm();
      modoEdicion.value = false;
    };

    const resetForm = () => {
      form.value = {
        id: null,
        producto: '',
        cantidad: 1,
        observaciones: '',
        estado: 'pendiente'
      };
    };

    const formatEstado = (estado) => {
      const estados = {
        'pendiente': 'Pendiente',
        'en_proceso': 'En Proceso',
        'completado': 'Completado',
        'cancelado': 'Cancelado'
      };
      return estados[estado] || estado;
    };

    onMounted(() => {
      cargarPedidos();
    });

    return {
      pedidos,
      form,
      modoEdicion,
      mostrarConfirmacion,
      pedidoAEliminar,
      cargarPedidos,
      guardarPedido,
      editarPedido,
      confirmarEliminar,
      eliminarPedido,
      cancelarEdicion,
      formatEstado
    };
  }
};
</script>

<style scoped>
/* Estilos específicos del componente */
</style>