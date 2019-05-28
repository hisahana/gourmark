<template>
  <div class="wrapper">
    <md-toolbar class="md-transparent" md-elevation="0">
      <span class="md-title" style="flex: 1;">登録したしおり</span>
      <md-button class="md-icon-button" @click="$emit('close')">
        <md-icon>close</md-icon>
      </md-button>
    </md-toolbar>
    <md-divider></md-divider>
    <md-list>
      <div v-for="bookmark in bookmarks">
        <md-list-item @click="$emit('moveToBookmark', bookmark)">
          <div class="md-list-item-text">
            <span class="category-name">{{ bookmark.categoryName }}</span>
            <p class="bookmark-name">{{ bookmark.name }}</p>
          </div>
        </md-list-item>
        <md-divider></md-divider>
      </div>
    </md-list>
  </div>
</template>

<script>
  export default {
    name: "BookmarksView",
    props: {
      bookmarks: {
        type: Array,
        default: []
      }
    }
  }
</script>

<style scoped>
  .wrapper {
    z-index: 10;
    position: absolute;
    top:0;
    left:0;
    width: 100%;
    height: 100%;
    background-color: #fff;
  }

  .category-name {
    font-size: 10px;
  }
</style>
