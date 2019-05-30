<template>
  <div class="wrapper">
    <md-toolbar class="md-transparent" md-elevation="0">
      <span class="md-title" style="flex: 1;">しおりを編集</span>
      <md-button class="md-icon-button" @click="$emit('close')">
        <md-icon>close</md-icon>
      </md-button>
    </md-toolbar>
    <md-content style="padding-left: 8px; padding-right: 8px;">
      <div class="md-layout-item">
        <md-field>
          <label for="category">カテゴリー</label>
          <md-select v-model="selectedCategory" id="category">
            <md-option v-for="category in categories" v-bind:value="category.id" :key="category.id">
              {{ category.name }}
            </md-option>
          </md-select>
        </md-field>
      </div>
      <div class="md-layout-item">
        <md-field>
          <label for="name">お店の名前</label>
          <md-input v-model="inputName" id="name" type="text"></md-input>
        </md-field>
      </div>
      <div class="md-layout-item">
        <md-field>
          <label for="memo">メモ</label>
          <md-textarea v-model="inputMemo" id="memo"></md-textarea>
        </md-field>
      </div>
    </md-content>
    <div class="btn-group">
      <md-button class="md-raised btn" @click="$emit('close')">キャンセル</md-button>
      <md-button class="md-raised md-primary btn" @click="$emit('submit', selectedCategory, inputName, inputMemo)">更新</md-button>
    </div>
  </div>
</template>

<script>
  export default {
    name: "BookmarkEditView",
    props: {
      categories: {
        type: Array,
        default: () => {
          return [];
        }
      },
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
    },
    data() {
      return {
        selectedCategory: this.bookmark ? this.bookmark.categoryId : 0,
        inputName: this.bookmark ? this.bookmark.name : "",
        inputMemo: this.bookmark ? this.bookmark.memo : ""
      }
    }
  }
</script>

<style scoped>
  .wrapper {
    z-index: 12;
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
