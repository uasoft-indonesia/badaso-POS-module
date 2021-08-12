<template>
  <vs-collapse-item type="border">
    <div slot="header">
      <vs-row>
        <vs-col type="flex" vs-w="8" vs-align="center">
          <h3 style="justify-content: center;">
            {{ name }}
          </h3>
        </vs-col>
        <vs-col type="flex" vs-w="4" vs-align="flex-end">
          <vs-chip color="primary"> Rp {{ currencyFormatIDR(total) }} </vs-chip>
        </vs-col>
      </vs-row>
    </div>
    <div>
      <vs-list>
        <vs-list-item title="Quatity">
          <vs-input-number size="medium" v-model="quantity" />
        </vs-list-item>
        <vs-list-item
          title="Price"
          :subtitle="'Rp. ' + currencyFormatIDR(price)"
        ></vs-list-item>
        <vs-list-item
          title="Discounted"
          :subtitle="'Rp. ' + currencyFormatIDR(discounted)"
        ></vs-list-item>
        <vs-list-item
          title="Total"
          :subtitle="'Rp. ' + currencyFormatIDR(total)"
        ></vs-list-item>
      </vs-list>
    </div>
  </vs-collapse-item>
</template>
<script>
export default {
  props: {
    name: {
      type: String,
      default: "",
    },
    price: {
      type: Number,
      default: 0,
    },
    quantity: {
      type: Number,
      default: 0,
    },
    discounted: {
      type: Number,
      default: null,
    },
    total: {
      type: Number,
      default: 0,
    },
  },
  name: "PosOrderItemProduct",
  data: () => ({}),
  computed: {
  },
  methods: {
    currencyFormatIDR(number) {
      return new Intl.NumberFormat("id-ID", {
        maximumSignificantDigits: 3,
      }).format(number);
    },
  },
};
</script>
