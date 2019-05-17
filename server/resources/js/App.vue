<template>
  <div id="app">
    <g-map :apiKey="this.apiKey"></g-map>
  </div>
</template>

<script>
  import Env from './environment/index';

  export default {
    name: "App",
    data () {
      return {
        apiKey: Env.API_KEY
      }
    },
    mounted() {
    }
  }
</script>

<style scoped>
  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
  }
</style>
