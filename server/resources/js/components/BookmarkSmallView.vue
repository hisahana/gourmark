<template>
  <modal class="modal" :isTransparent="true" @close="closeModal">
    <div class="modal-container">
      <p>{{ bookmark.categoryName }}</p>
      <h1>{{ bookmark.name }}</h1>
      <p style="white-space: pre-wrap">{{ bookmark.memo }}</p>
    </div>
  </modal>
</template>

<script>
  export default {
    name: "BookmarkSmallView",
    props: {
      categories: {
        type: Array
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

  h1 {
    font-size: 14pt;
  }
</style>
