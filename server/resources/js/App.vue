<template>
  <div id="app">
    <g-map
        :apiKey="this.apiKey"
        :lat="this.lat"
        :lng="this.lng"
        :markers="this.markers"
        @longClick="showAddMarker"
        @showBookmark="openBookmarkSmall"
      >
    </g-map>
    <md-button class="md-icon-button md-raised md-accent menu-button" @click="openSideMenu">
      <md-icon>menu</md-icon>
    </md-button>
    <md-drawer :md-active.sync="showSideMenu" md-swipeable>
      <side-menu-view
        @openBookmarksView="openBookmarks"
      >
      </side-menu-view>
    </md-drawer>
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
      @openBookmark="openBookmark"
      @close="closeBookmarkSmall"
    >
    </bookmark-small-view>
    <bookmark-view
      v-if="showBookmarkView"
      :bookmark="this.currentBookmark"
      @delete="deleteBookmark"
      @edit="openBookmarkEdit"
      @close="closeBookmark"
    >
    </bookmark-view>
    <bookmark-edit-view
      v-if="showBookmarkEditView"
      :categories="this.categories"
      :bookmark="this.currentBookmark"
      @submit="submitBookmarkEdit"
      @close="closeBookmarkEdit"
    >
    </bookmark-edit-view>
    <bookmarks-view
      v-if="showBookmarks"
      :bookmarks="this.markers"
      @moveToBookmark="moveToBookmark"
      @close="closeBookmarks"
    >
    </bookmarks-view>
  </div>
</template>

<script>
  import Env from './environment/index';
  import RegisterAsMarkerView from "./components/RegisterAsMarkerView";
  import BookmarkSmallView from "./components/BookmarkSmallView";
  import SideMenuView from "./components/SideMenuView";
  import axios from "axios";
  import BookmarksView from "./components/BookmarksView";
  import BookmarkView from "./components/BookmarkView";
  import BookmarkEditView from "./components/BookmarkEditView";

  export default {
    name: "App",
    components: {BookmarkEditView, BookmarkView, BookmarksView, SideMenuView, RegisterAsMarkerView, BookmarkSmallView},
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
        showSideMenu: false,
        showRegisterAsMarker: false,
        showBookmarkSmallView: false,
        showBookmarkView: false,
        showBookmarkEditView: false,
        showBookmarks: false,
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
        this.markers = [];
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
      openSideMenu() {
        this.showSideMenu = true;
      },
      closeSideMenu() {
        this.showSideMenu = false;
      },
      openBookmarks() {
        this.closeSideMenu();
        this.showBookmarks = true;
      },
      closeBookmarks() {
        this.showBookmarks = false;
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
      openBookmarkSmall(bookmark) {
        this.currentBookmark = bookmark;
        this.showBookmarkSmallView = true;
      },
      closeBookmarkSmall() {
        this.showBookmarkSmallView = false;
        this.currentBookmark = {};
      },
      openBookmark() {
        this.showBookmarkSmallView = false;
        this.showBookmarkView = true;
      },
      closeBookmark() {
        this.showBookmarkView = false;
        this.currentBookmark = {};
      },
      moveToBookmark(bookmark) {
        this.closeBookmarks();
        this.lat = bookmark.position.lat;
        this.lng = bookmark.position.lng;
        this.currentBookmark = bookmark;
        this.showBookmarkSmallView = true;
      },
      deleteBookmark() {
        this.showBookmarkView = false;
        axios.delete('/api/bookmarks/'+this.currentBookmark.id)
          .then((res) => {
            this.fetchMarkers();
          })
          .finally(() => {
            this.currentBookmark = {};
          });
      },
      openBookmarkEdit() {
        this.showBookmarkEditView = true;
      },
      closeBookmarkEdit() {
        this.showBookmarkEditView = false;
      },
      submitBookmarkEdit(categoryId, name, memo) {
        let bookmark = {
          'categoryId': categoryId,
          'name': name,
          'memo': memo,
        };

        axios.patch('/api/bookmarks/' + this.currentBookmark.id, bookmark)
          .then((res) => {
            this.fetchMarkers();
          });

        this.showBookmarkEditView = false;
        this.showBookmarkView = false;
        this.currentBookmark = {};
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
