<template>
  <div>
    <vs-prompt
      :title="productDetail.name"
      @close="close"
      :active="activePrompt"
      accept-text="Order"
      @accept="accept"
      @cencel="cencel"
    >
      <div>
        <vs-list>
          <vs-list>
            <vs-list-header title="Product"></vs-list-header>
            <vs-list-item
              title="Name"
              :subtitle="productDetail.product.name"
            ></vs-list-item>
            <vs-list-item
              title="Description"
              :subtitle="
                productDetail.product.desc ? productDetail.product.desc : '-'
              "
            ></vs-list-item>
            <vs-list-header title="Detail" color="success"></vs-list-header>
            <vs-list-item
              title="Name"
              :subtitle="productDetail.name"
            ></vs-list-item>
            <vs-list-item
              title="Quantity"
              :subtitle="productDetail.quantity+''"
            ></vs-list-item>
            <vs-list-item
              title="Price"
              :subtitle="'Rp. '+currencyFormat(productDetail.price)"
            ></vs-list-item>
            <vs-list-item
              title="SKU"
              :subtitle="productDetail.SKU"
            ></vs-list-item>
            <vs-list-item
              title="Discounted"
              :subtitle="'Rp. '+currencyFormat(productDetail.discounted)"
            ></vs-list-item>
          </vs-list>
        </vs-list>
      </div>
    </vs-prompt>
  </div>
</template>
<script>
export default {
  name: "PosModalProductDetail",
  props: {
    activePrompt: {
      type: Boolean,
      default: true,
    },
    productDetail: {
      type: Object,
      default: {},
    },
    close: {
      type: Function,
      default: () => {},
    },
    accept:{
      type: Function,
      default: () => {},
    },
    cencel:{
      type: Function,
      default: () => {},
    },
  },
  data() {
    return {};
  },
  methods: {
    currencyFormat(number) {
      return new Intl.NumberFormat("id-ID", {
        maximumSignificantDigits: 3,
      }).format(number);
    },
  },
};
</script>
