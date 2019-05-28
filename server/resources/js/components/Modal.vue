<template>
  <transition name="modal">
    <div class="modal-mask" :class="isTransparent ? 'transparent' : ''">
      <div class="modal-wrapper" @click.self="$emit('close')">
        <slot/>
      </div>
    </div>
  </transition>
</template>

<script>
  export default {
    name: "Modal",
    props: {
      isTransparent: {
        type: Boolean,
        default: false
      }
    }
  }
</script>

<style scoped>
  .modal-mask {
    position: fixed;
    z-index: 10;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
  }
  .modal-mask.transparent {
    background-color: transparent;
  }
  .modal-wrapper {
    display: table-cell;
    vertical-align: middle;
  }
</style>
