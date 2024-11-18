<template>
    <div>
      <h1>Lista de Parqueaderos</h1>
      <ul>
        <li v-for="parking in parkings" :key="parking.id">
          {{ parking.name }} - {{ parking.price_per_hour }} /hora
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        parkings: [],
      };
    },
    mounted() {
      axios.get('/api/parkings')
        .then(response => {
          this.parkings = response.data;
        })
        .catch(error => {
          console.error(error);
        });
    },
  };
  </script>
  
  <style scoped>
  /* Agrega tus estilos aquí */
  </style>
  