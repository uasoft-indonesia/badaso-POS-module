import Vue from "vue";
import Vuesax from "vuesax";
import { Datetime } from "vue-datetime";
import moment from "moment";

import "vuesax/dist/vuesax.css"; //Vuesax styles
import "material-icons/iconfont/material-icons.css";
import "vue-datetime/dist/vue-datetime.css";
import "../../../../core/src/resources/js/assets/scss/style.scss";

import api from "./api/index";
import store from "./store/badaso";

import PosLayout from './layouts/PosLayout.vue'
import PosNavbar from './components/PosNavbar.vue'
import PosMain from "./components/PosMain.vue";


let prefix = process.env.MIX_BLOG_POST_URL_PREFIX
  ? "/" + process.env.MIX_BLOG_POST_URL_PREFIX
  : "";

Vue.config.productionTip = false;
Vue.config.devtools = true;

Vue.use(Vuesax);
Vue.component("datetime", Datetime);

Vue.prototype.$api = api;
Vue.prototype.$moment = (date, format) => {
  return moment(date).format(format);
};

Vue.prototype.$isMobile =
  Math.min(window.screen.width, window.screen.height) < 768;
Vue.prototype.$scrollToTop = () => window.scrollTo(0, 0);
Vue.prototype.$constants = {
  MOBILE: "mobile",
  DESKTOP: "desktop",
};

Vue.component("PosLayout", PosLayout)
Vue.component("PosNavbar", PosNavbar)
Vue.component("PosMain", PosMain)

Vue.prototype.$baseUrl = "/";

const app = new Vue({
  store,
}).$mount("#pos-app");
