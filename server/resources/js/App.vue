<template>
  <div id="app">
    <g-map
        :apiKey="this.apiKey"
        :lat="this.lat"
        :lng="this.lng"
        :markers="this.markers"
        @longClick="showAddMarker"
        @showBookmark="openBookmark"
      >
    </g-map>
    <md-button class="md-icon-button md-raised md-accent menu-button">
      <md-icon>menu</md-icon>
    </md-button>
    <register-as-marker-view
      v-if="showRegisterAsMarker"
      :categories="this.categories"
      @close="closeRegisterAsMarker"
      @register="registerAsMarker"
    >
    </register-as-marker-view>
    <bookmark-small-view
      v-if="showBookmarkSmallView"
      :categories="this.categories"
      :bookmark="this.currentBookmark"
      @close="closeBookmark"
    >
    </bookmark-small-view>
  </div>
</template>

<script>
  import Env from './environment/index';
  import RegisterAsMarkerView from "./components/RegisterAsMarkerView";
  import BookmarkSmallView from "./components/BookmarkSmallView";
  import axios from "axios";

  export default {
    name: "App",
    components: {RegisterAsMarkerView, BookmarkSmallView},
    data () {
      return {
        apiKey: Env.API_KEY,
        lat: 0,
        lng: 0,
        categories: [],
        markers: [],
        selectedLat: null,
        selectedLng: null,
        currentBookmark: {},
        showRegisterAsMarker: false,
        showBookmarkSmallView: false
      }
    },
    mounted() {
      // GeoLocationAPIで現在位置を取得
      navigator.geolocation.getCurrentPosition((position) => {
        this.lat = position.coords.latitude;
        this.lng = position.coords.longitude;
        this.getCategories();
        this.fetchMarkers();
      },(error) => {
        console.log(error);
      });
    },
    methods: {
      fetchMarkers() {
        // 現在位置付近のマーカーを取得
        axios.get('/api/bookmarks')
          .then((res) => {
            res.data.map((bookmark) => {
              console.log(bookmark);
              this.markers.push({
                id: bookmark.id,
                categoryId: bookmark.category_id,
                categoryName: bookmark.category.name,
                name: bookmark.name,
                memo: bookmark.memo,
                position: { lat: bookmark.lat, lng: bookmark.lng }
              })
            });
          });
        // zoomも親から渡す必要がありそう
        // this.markers = [
        //   { position: { lat: this.lat, lng: this.lng } },
        //   { position: { lat: 35.762448, lng: 139.533698 } },
        //   { position: { lat: 35.762069, lng: 139.534245 } },
        //   { position: { lat: 35.762033, lng: 139.533656 } },
        // ]
      },
      getCategories() {
        axios.get('/api/categories')
          .then((res) => {
            this.categories = res.data;
          });
      },
      showAddMarker(e) {
        this.openRegisterAsMarker(e.latLng.lat(), e.latLng.lng());
      },
      openRegisterAsMarker(lat, lng) {
        this.selectedLat = lat;
        this.selectedLng = lng;
        this.showRegisterAsMarker = true;
      },
      closeRegisterAsMarker() {
        this.selectedLat = null;
        this.selectedLng = null;
        this.showRegisterAsMarker = false;
      },
      registerAsMarker(categoryId, name, memo) {
        let bookmark = {
          'categoryId': categoryId,
          'name': name,
          'memo': memo,
          'lat': this.selectedLat,
          'lng': this.selectedLng
        };
        // マーカー登録API呼び出し
        axios.post('/api/bookmarks', bookmark)
          .then((res) => {
            console.log(res);
            this.fetchMarkers();
          });
        this.closeRegisterAsMarker();
      },
      openBookmark(bookmark) {
        this.currentBookmark = bookmark;
        this.showBookmarkSmallView = true;
      },
      closeBookmark() {
        this.currentBookmark = {};
        this.showBookmarkSmallView = false;
      }
    }
  }
</script>

<style scoped>
  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
  }

  .menu-button {
    position: absolute;
    top: 16px;
    left: 8px;
  }
</style>
