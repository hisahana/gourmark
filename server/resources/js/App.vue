<template>
  <div id="app">
    <g-map
        :apiKey="this.apiKey"
        :lat="this.lat"
        :lng="this.lng"
        :markers="this.markers"
        @longClick="showAddMarker"
      >
    </g-map>
  </div>
</template>

<script>
  import Env from './environment/index';
  import Vue from 'vue'
  import Vue2TouchEvents from 'vue2-touch-events'

  Vue.use(Vue2TouchEvents);

  export default {
    name: "App",
    data () {
      return {
        apiKey: Env.API_KEY,
        lat: 0,
        lng: 0,
        markers: []
      }
    },
    mounted() {
      // GeoLocationAPIで現在位置を取得
      navigator.geolocation.getCurrentPosition((position) => {
        this.lat = position.coords.latitude;
        this.lng = position.coords.longitude;
        this.fetchMarkers();
      });
    },
    methods: {
      fetchMarkers() {
        // 現在位置付近のマーカーを取得
        // zoomも親から渡す必要がありそう
        this.markers = [
          { position: { lat: this.lat, lng: this.lng } },
          { position: { lat: 35.762448, lng: 139.533698 } },
          { position: { lat: 35.762069, lng: 139.534245 } },
          { position: { lat: 35.762033, lng: 139.533656 } },
        ]
      },
      showAddMarker(e) {
        console.log(e);
      }
    }
  }
</script>

<style scoped>
  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
  }
</style>
