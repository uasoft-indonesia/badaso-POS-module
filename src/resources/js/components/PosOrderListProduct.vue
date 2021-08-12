<template>
  <vs-card class="cardx">
    <div slot="header">
      <h3>Order Detail Product</h3>
    </div>
    <div>
      <vs-list>
        <div
          v-for="productOrder in productOrderList.products"
          :key="productOrder"
        >
          <pos-order-item
            :name="productOrder.productDetail.name"
            :price="productOrder.price"
            :quantity="productOrder.quantity"
            :discounted="productOrder.productDetail.discounted"
            :total="productOrder.getTotal()"
          />
        </div>
      </vs-list>
    </div>
    <div slot="footer">
      <vs-row vs-justify="flex-end">
        <vs-col vs-w="6">
          <vs-card>
            <vs-row>
              <vs-col>
                <h3>
                  Total
                </h3>
              </vs-col>
              <vs-col>
                <h2>
                  Rp 0
                </h2>
              </vs-col>
            </vs-row>
          </vs-card>
        </vs-col>
      </vs-row>
    </div>
  </vs-card>
</template>
<script>
import { ProductOrderList } from "../utils/product-order";
import PosOrderItem from "./PosOrderItemProduct.vue";
export default {
  components: { PosOrderItem },
  name: "PosOrderListProduct",
  props: {
    productOrderList: {
      type: ProductOrderList,
      default: new ProductOrderList(),
    },
    syncProductOrderList: {
      type: Function,
      default: (syncProductOrderList) => {},
    },
  },
  data() {
    return {
        data: 0
    };
  },
};
</script>
