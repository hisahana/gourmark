<template>
  <modal class="modal" @close="closeModal">
    <div class="modal-container">
      <h1>しおりをはさむ</h1>
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
      <div class="btn-group">
        <md-button class="md-raised md-primary" @click="$emit('register', selectedCategory, inputName, inputMemo)">登録</md-button>
        <md-button class="md-raised" @click="$emit('close')">キャンセル</md-button>
      </div>
    </div>
  </modal>
</template>

<script>
  export default {
    name: "RegisterAsMarkerView",
    props: {
      categories: {
        type: Array,
        default: () => {
          return [];
        }
      }
    },
    data() {
      return {
        showModal: false,
        selectedCategory: 0,
        inputName: "",
        inputMemo: ""
      }
    },
    methods: {
      closeModal() {
        this.$emit("close");
      }
    }
  }
</script>

<style scoped>
  .modal >>> .modal-wrapper {
    vertical-align: bottom;
  }

  .modal-container {
    display: flex;
    flex-flow: column;
    width: 95%;
    margin: 0 auto;
    padding: 12px;
    background-color: #fff;
    border-top-left-radius: 2px;
    border-top-right-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 33);
    transition: all .3s ease;
    word-break: break-word;
  }

  .md-layout-item {
    flex: inherit;
  }

  .btn-group {
    flex-direction: row-reverse;
  }

  h1 {
    font-size: 14pt;
  }
</style>
