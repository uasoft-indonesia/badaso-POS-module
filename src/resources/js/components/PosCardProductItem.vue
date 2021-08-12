<template>
  <vs-card>
    <pos-modal-product-detail :productDetail="productDetail" :activePrompt="activePrompt" :close="onClose" :accept="() => onClickOrder(productDetail)" />
    <div slot="header">
      <vs-row vs-type="flex">
        <vs-col vs-w="7">
          <h3>{{ productDetail.name }}</h3>
          <h5>{{ productDetail.product.name }}</h5>
        </vs-col>
        <vs-col vs-align="start-end" vs-justify="start-end" vs-w="5">
          <vs-tooltip text="Order">
            <vs-button
              type="border"
              style="margin-left: 1px ;"
              color="success"
              icon="shopping_bag"
              @click="onClickOrder(productDetail)"
            ></vs-button>
          </vs-tooltip>

          <vs-tooltip text="Shopping">
            <vs-button
              type="border"
              style="margin-left: 1px ;"
              color="primary"
              icon="visibility"
              @click="showDetailProduct(true)"
            ></vs-button>
          </vs-tooltip>
        </vs-col>
      </vs-row>
    </div>
    <div slot="media">
      <img :src="productDetail.productImage" />
    </div>
    <div>
      <vs-row vs-type="flex">
        <vs-col>
          <vs-row>
            <h5 v-if="productDetail.discounted > 0">Rp. {{ currencyFormat(productDetail.price) }}</h5>
          </vs-row>
          <vs-row vs-type="flex">
            <h2>
              Rp.
              {{ currencyFormat(productDetail.discounted == 0 ? productDetail.price : productDetail.discounted) }}
            </h2>
          </vs-row>
        </vs-col>
        <vs-col> </vs-col>
      </vs-row>
    </div>
  </vs-card>
</template>
<script>
import PosModalProductDetail from "./PosModalProductDetail.vue";

export default {
  components: { PosModalProductDetail },
  name: "PosCardProductItem",
  props: {
    productDetail : {
        type: Object,
        default: {},
    },
    mediaBaseUrl : {
        type: String,
        default: "",
    },
    onClickOrder:{
        type: Function,
        default: (productDetail) => {}
    }
  },
  data(){
      return {
          activePrompt : false,
      }
  },
  methods: {
    onClose(){
        this.activePrompt = false
    },
    showDetailProduct(status){
        this.activePrompt = status
    },
    currencyFormat(number) {
      return new Intl.NumberFormat("id-ID", {
        maximumSignificantDigits: 3,
      }).format(number);
    },
    dialogShowProduct() {
      this.$vs.dialog({
        color: "primary",
        title: `Dialog`,
        text:
          "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
        accept: () => {},
      });
    },
  },
};
</script>
