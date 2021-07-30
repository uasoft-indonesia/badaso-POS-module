
import Vue from "vue";
import Vuesax from "vuesax";
import VueRouter from "vue-router";

import App from "./apps/App.vue";
import store from '../../../../core/src/resources/js/store/store'
import { PosRouter } from "./router/pos.routes";

import "vuesax/dist/vuesax.css";
import "material-icons/iconfont/material-icons.css";
import "vue-datetime/dist/vue-datetime.css";
import "../../../../core/src/resources/js/assets/scss/style.scss"


Vue.use(VueRouter);
Vue.use(Vuesax, {
  // options here
});

Vue.prototype.$isMobile =
  Math.min(window.screen.width, window.screen.height) < 768;
Vue.prototype.$scrollToTop = () => window.scrollTo(0, 0);
Vue.prototype.$constants = {
  MOBILE: "mobile",
  DESKTOP: "desktop",
};


const app = new Vue({
  el: "#app-pos",
  components: { App },
  router: PosRouter,
  store,
});
