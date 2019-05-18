<template>
  <div id="app">
    <g-map
      :apiKey="this.apiKey"
      :lat="this.lat"
      :lng="this.lng"
    >
    </g-map>
  </div>
</template>

<script>
  import Env from './environment/index';

  export default {
    name: "App",
    data () {
      return {
        apiKey: Env.API_KEY,
        lat: 0,
        lng: 0
      }
    },
    mounted() {
      // GeoLocationAPIで現在位置を取得
      navigator.geolocation.getCurrentPosition((position) => {
        this.lat = position.coords.latitude;
        this.lng = position.coords.longitude;
      });
    }
  }
</script>

<style scoped>
  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
  }
</style>
