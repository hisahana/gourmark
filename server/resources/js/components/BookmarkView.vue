<template>
  <div class="wrapper">
    <md-toolbar class="md-transparent" md-elevation="0">
      <span class="md-title" style="flex: 1;"></span>
      <md-button class="md-icon-button" @click="$emit('close')">
        <md-icon>close</md-icon>
      </md-button>
    </md-toolbar>
    <md-content style="padding-left: 8px; padding-right: 8px;">
      <p>{{ bookmark.categoryName }}</p>
      <h1>{{ bookmark.name }}</h1>
      <p style="white-space: pre-wrap">{{ bookmark.memo }}</p>
    </md-content>
    <div class="btn-group">
      <md-button class="md-raised md-accent btn" @click="$emit('delete')">削除</md-button>
      <md-button class="md-raised md-primary btn">編集</md-button>
    </div>
  </div>
</template>

<script>
  export default {
    name: "BookmarkView",
    props: {
      bookmark: {
        id: {
          type: Number
        },
        categoryId: {
          type: Number
        },
        categoryName: {
          type: String
        },
        name: {
          type: String
        },
        memo: {
          type: String
        }
      }
    }
  }
</script>

<style scoped>
  .wrapper {
    z-index: 11;
    position: absolute;
    top:0;
    left:0;
    width: 100%;
    height: 100%;
    background-color: #fff;
  }

  h1 {
    font-size: 18px;
  }

  .btn-group {
    position: fixed;
    bottom: 0;
    width: 100%;
    margin-bottom: 16px;
  }

  .btn {
    flex: 1;
  }

</style>
