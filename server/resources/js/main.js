import Vue from 'vue'
import App from './App'

const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

new Vue({
  el: '#app',
  template: '<App/>',
  components: { App },
})
