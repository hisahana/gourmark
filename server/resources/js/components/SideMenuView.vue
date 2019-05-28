<template>
  <div>
    <md-toolbar class="md-transparent" md-elevation="0">
      <span class="md-title">gourmark</span>
    </md-toolbar>
    <md-list>
      <md-list-item @click="openBookmarksView">
        <span class="md-list-item-text">登録したしおり</span>
      </md-list-item>
    </md-list>
  </div>
</template>

<script>
  export default {
    name: "SideMenuView",
    methods: {
      openBookmarksView() {
        this.$emit('openBookmarksView');
      }
    }
  }
</script>

<style scoped>

</style>
