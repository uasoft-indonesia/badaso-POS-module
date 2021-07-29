<template>
  <component
    v-if="globalComponentList[defaultComponent]"
    v-bind:is="globalComponentList[defaultComponent]"
  ></component>
  <component v-else v-bind:is="defaultComponent"></component>
</template>

<script>
import ProductBrowse from "./product/browse";
import ProductBrowseBin from "./product/browse-bin";
import ProductAdd from "./product/add";
import ProductRead from "./product/read";
import ProductEdit from "./product/edit";

import ProductCategoryBrowse from "./product-category/browse";
import ProductCategoryBrowseBin from "./product-category/browse-bin";
import ProductCategoryAdd from "./product-category/add";
import ProductCategoryRead from "./product-category/read";
import ProductCategoryEdit from "./product-category/edit";

import DiscountBrowse from "./discount/browse";
import DiscountBrowseBin from "./discount/browse-bin";
import DiscountAdd from "./discount/add";
import DiscountRead from "./discount/read";
import DiscountEdit from "./discount/edit";

import OrderBrowse from "./order/browse";
import OrderRead from "./order/read";
import OrderConfirm from "./order/confirm";

import PaymentProviderBrowse from "./payment-provider/browse";
import PaymentProviderAdd from "./payment-provider/add";
import PaymentProviderRead from "./payment-provider/read";
import PaymentProviderEdit from "./payment-provider/edit";

import PosCustomerBrowse from "./customer/browse";
import PosCustomerBrowseBin from "./customer/browse-bin";
import PosCustomerAdd from "./customer/add";
import PosCustomerRead from "./customer/read";
import PosCustomerEdit from "./customer/edit";

import PosEmployeeBrowse from "./employee/browse";
import PosEmployeeBrowseBin from "./employee/browse-bin";
import PosEmployeeAdd from "./employee/add";
import PosEmployeeRead from "./employee/read";
import PosEmployeeEdit from "./employee/edit";

export default {
  components: {
    ProductBrowse,
    ProductBrowseBin,
    ProductRead,
    ProductAdd,
    ProductEdit,
    ProductCategoryBrowse,
    ProductCategoryBrowseBin,
    ProductCategoryAdd,
    ProductCategoryRead,
    ProductCategoryEdit,
    DiscountBrowse,
    DiscountBrowseBin,
    DiscountAdd,
    DiscountRead,
    DiscountEdit,
    OrderBrowse,
    OrderRead,
    OrderConfirm,
    PaymentProviderBrowse,
    PaymentProviderAdd,
    PaymentProviderRead,
    PaymentProviderEdit,

    PosCustomerBrowse,
    PosCustomerBrowseBin,
    PosCustomerAdd,
    PosCustomerRead,
    PosCustomerEdit,

    PosEmployeeBrowse,
    PosEmployeeBrowseBin,
    PosEmployeeAdd,
    PosEmployeeRead,
    PosEmployeeEdit,
  },
  name: "BlogEntryIndex",
  data: () => ({
    globalComponentList: {},
    defaultComponent: null,
  }),
  mounted() {
    const routeName = this.$route.name;
    const componentName = this.$caseConvert.kebab(routeName);
    const slug = this.$route.params ? this.$route.params.slug : "";

    this.globalComponentList = this.constructor.superOptions.components;

    this.defaultComponent = componentName;
  },
  methods: {},
};
</script>
