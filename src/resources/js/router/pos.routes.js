import VueRouter from 'vue-router';
import BadasoHomePos from "../components/BadasoHomePos.vue";
import { posDefaultRoute } from "../../utils/helpers";


export const PosRouter = new VueRouter({
  mode: "history",
  routes: [
    {
      path: posDefaultRoute(),
      name: "badaso-home-pos",
      component: BadasoHomePos,
    },
  ],
});
