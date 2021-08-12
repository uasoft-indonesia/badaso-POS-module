<template>
  <pos-layout>
    <div style="margin: 10px ;">
      <vs-row vs-type="flex">
        <vs-col
          vs-type="flex"
          vs-justify="flex-start"
          vs-align="flex-start"
          vs-w="3"
        >
          <pos-order-list-product :productOrderList="productOrderList" :syncProductOrderList="syncProductOrderList => productOrderList = syncProductOrderList" />
        </vs-col>
        <vs-col
          vs-type="flex"
          vs-justify="flex-start"
          vs-align="flex-start"
          vs-w="9"
        >
          <vs-row vs-flex="">
            <vs-card vs-w="12">
              <div slot="header">
                <post-search-product />
              </div>
            </vs-card>

            <vs-row vs-w="12">
              <vs-col
                v-for="item in productsDetails"
                :key="item.id"
                vs-w="3"
                vs-type="flex"
                vs-align="center"
                vs-justify="center"
              >
                <pos-card-product-item
                  :onClickOrder="onClickOrder"
                  :productDetail="item"
                  :mediaBaseUrl="mediaBaseUrl"
                />
              </vs-col>
            </vs-row>
          </vs-row>
        </vs-col>
      </vs-row>
    </div>
  </pos-layout>
</template>

<script>
import PosNavbar from "./PosNavbar.vue";
import PosOrderItem from "./PosOrderItemProduct.vue";
import PosLayout from "../layouts/PosLayout.vue";
import PosOrderListProduct from "./PosOrderListProduct.vue";
import PostSearchProduct from "./PostSearchProduct.vue";
import PosCardProductItem from "./PosCardProductItem.vue";
import { ProductOrderList, ProductOrder } from "../utils/product-order";

export default {
  components: {
    PosLayout,
    PosNavbar,
    PosOrderItem,
    PosOrderListProduct,
    PostSearchProduct,
    PosCardProductItem,
  },
  data() {
    return {
      mediaBaseUrl: null,
      select: 0,
      productsDetails: [],
      limit: 10,
      page: 1,
      productOrderList: new ProductOrderList(),
    };
  },
  mounted() {
    this.getProductList();
  },
  methods: {
    onClickOrder(productDetail) {
      this.$vs.notify({
        title : 'Success',
        text: "Add Product "+productDetail.name,
        color: 'success',
      });

      let { id, discountId, price, discounted } = productDetail;
      let productOrder = new ProductOrder({
        productDetailId: id,
        discountId,
        price,
        discounted,
        quantity: 1,
        productDetail
      });

      this.productOrderList.add(productOrder);
    },
    getProductList() {
      this.$api.badasoProductDetail
        .browse({
          page: this.page,
          limit: this.limit,
          relation: "product,discount",
        })
        .then((response) => {
          this.productsDetails = response.data.productDetails.data;
          this.mediaBaseUrl = response.meta.mediaBaseUrl;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
