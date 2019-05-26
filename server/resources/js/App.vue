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
    <register-as-marker-view
      v-if="showRegisterAsMarker"
      :categories="this.categories"
      @close="closeRegisterAsMarker"
      @register="registerAsMarker"
    >
    </register-as-marker-view>
  </div>
</template>

<script>
  import Env from './environment/index';
  import RegisterAsMarkerView from "./components/RegisterAsMarkerView";
  import axios from "axios";

  export default {
    name: "App",
    components: {RegisterAsMarkerView},
    data () {
      return {
        apiKey: Env.API_KEY,
        lat: 0,
        lng: 0,
        categories: [],
        markers: [],
        showRegisterAsMarker: false
      }
    },
    mounted() {
      // GeoLocationAPIで現在位置を取得
      navigator.geolocation.getCurrentPosition((position) => {
        this.lat = position.coords.latitude;
        this.lng = position.coords.longitude;
        this.getCategories();
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
      getCategories() {
        axios.get('/api/categories')
          .then((res) => {
            this.categories = res.data;
          });
      },
      showAddMarker(e) {
        console.log(e);
        this.openRegisterAsMarker();
      },
      openRegisterAsMarker() {
        this.showRegisterAsMarker = true;
      },
      closeRegisterAsMarker() {
        this.showRegisterAsMarker = false;
      },
      registerAsMarker(categoryId, name, memo) {
        console.log(categoryId);
        console.log(name);
        console.log(memo);
        this.showRegisterAsMarker = false;
        // マーカー登録API呼び出し
      }
    }
  }
</script>

<style scoped>
  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
  }
</style>
