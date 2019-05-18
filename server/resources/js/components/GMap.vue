<template>
  <div>
    <div id="map" :style="{width: mapWidth + 'px', height: mapHeight + 'px'}">
    </div>
  </div>
</template>

<script>
  import GoogleMapsLoader from "google-maps";

  export default {
    name: "GMap",
    props: {
      apiKey: {
        type: String,
        default: ""
      },
      lat: {
        type: Number,
        default: 34.722677
      },
      lng: {
        type: Number,
        default: 135.492364
      },
      zoom: {
        type: Number,
        default: 18
      },
      markers: {
        type: Array,
        default: () => {
          return [];
        }
      }
    },
    watch: {
      lat: {
        handler() {
          this.map.setCenter({ lat: this.lat, lng: this.lng });
        }
      },
      lng: {
        handler() {
          this.map.setCenter({ lat: this.lat, lng: this.lng });
        }
      },
      markers: {
        handler() {
          this.formattedMarkers.forEach(marker => {
            marker.setMap(null);
          });
          this.formattedMarkers.splice(0, this.formattedMarkers.length);

          this.addMarker();
        }
      }
    },
    data() {
      return {
        google: null,
        map: null,
        formattedMarkers: [],
        mapWidth: 100,
        mapHeight: 100
      };
    },
    created() {
      this.mapWidth = window.innerWidth;
      this.mapHeight = window.innerHeight;
    },
    mounted() {
      GoogleMapsLoader.KEY = this.apiKey;
      GoogleMapsLoader.LANGUAGE = "ja";
      GoogleMapsLoader.VERSION = "3.37";
      GoogleMapsLoader.load(this.loadMap);
      window.addEventListener('resize', this.handleResize)
    },
    beforeDestroy() {
      window.removeEventListener('resize', this.handleResize)
    },
    methods: {
      loadMap(google) {
        this.google = google;
        this.map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: this.lat, lng: this.lng },
          zoom: this.zoom,
          disableDefaultUI: true,
          gestureHandling: "greedy"
        });
        this.addMarker();
      },
      addMarker() {
        this.markers.forEach(markerInfo => {
          let contentString = "hoge";
          let marker = new this.google.maps.Marker({
            position: markerInfo.position,
            map: this.map,
            animation: this.google.maps.Animation.DROP
          });

          let infoWindow = new this.google.maps.InfoWindow({
            content: contentString
          });

          marker.addListener("click", () => {
            infoWindow.open(this.map, marker)
          });

          this.formattedMarkers.push(marker);
        });
      },
      handleResize() {
        this.mapWidth = window.innerWidth;
        this.mapHeight = window.innerHeight;
      }
    }
  }
</script>

<style scoped>

</style>
