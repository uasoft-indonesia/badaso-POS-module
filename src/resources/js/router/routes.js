import Pages from "./../pages/index.vue";

let prefix = process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  ? "/" + process.env.MIX_ADMIN_PANEL_ROUTE_PREFIX
  : "/badaso-dashboard";

export default [
  // start product
  {
    path: prefix + "/product",
    name: "ProductBrowse",
    component: Pages,
    meta: {
      title: "Browse Product",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/product/bin",
    name: "ProductBrowseBin",
    component: Pages,
    meta: {
      title: "Browse Product Bin",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/product/:id/detail",
    name: "ProductRead",
    component: Pages,
    meta: {
      title: "Detail Product",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/product/:id/edit",
    name: "ProductEdit",
    component: Pages,
    meta: {
      title: "Edit Product",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/product/add",
    name: "ProductAdd",
    component: Pages,
    meta: {
      title: "Add Product",
      useComponent: "AdminContainer",
    },
  },
  // end

  // start product category
  {
    path: prefix + "/product-category",
    name: "ProductCategoryBrowse",
    component: Pages,
    meta: {
      title: "Browse Product Category",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/product-category/bin",
    name: "ProductCategoryBrowseBin",
    component: Pages,
    meta: {
      title: "Browse Product Category Bin",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/product-category/:id/detail",
    name: "ProductCategoryRead",
    component: Pages,
    meta: {
      title: "Detail Product Category",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/product-category/:id/edit",
    name: "ProductCategoryEdit",
    component: Pages,
    meta: {
      title: "Edit Product Category",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/product-category/add",
    name: "ProductCategoryAdd",
    component: Pages,
    meta: {
      title: "Add Product Category",
      useComponent: "AdminContainer",
    },
  },
  // end

  // start discount
  {
    path: prefix + "/discount",
    name: "DiscountBrowse",
    component: Pages,
    meta: {
      title: "Browse Discount",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/discount/bin",
    name: "DiscountBrowseBin",
    component: Pages,
    meta: {
      title: "Browse Discount Bin",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/discount/:id/detail",
    name: "DiscountRead",
    component: Pages,
    meta: {
      title: "Detail Discount",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/discount/:id/edit",
    name: "DiscountEdit",
    component: Pages,
    meta: {
      title: "Edit Discount",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/discount/add",
    name: "DiscountAdd",
    component: Pages,
    meta: {
      title: "Add Discount",
      useComponent: "AdminContainer",
    },
  },
  // end discount

  //   payment provider
  {
    path: prefix + "/payment-provider",
    name: "PaymentProviderBrowse",
    component: Pages,
    meta: {
      title: "Browse Payment Provider",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/payment-provider/:id/detail",
    name: "PaymentProviderRead",
    component: Pages,
    meta: {
      title: "Detail Payment Provider",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/payment-provider/:id/edit",
    name: "PaymentProviderEdit",
    component: Pages,
    meta: {
      title: "Edit Payment Provider",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/payment-provider/add",
    name: "PaymentProviderAdd",
    component: Pages,
    meta: {
      title: "Add Payment Provider",
      useComponent: "AdminContainer",
    },
  },
  // end

  // start pos order
  {
    path: prefix + "/pos-order",
    name: "Orders",
    component: Pages,
    meta: {
      title: "Browse Orders",
    },
  },
  // end

  // start customers
  {
    path: prefix + "/pos-customer",
    name: "PosCustomerBrowse",
    component: Pages,
    meta: {
      title: "Browse Customer",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/pos-customer/bin",
    name: "PosCustomerBrowseBin",
    component: Pages,
    meta: {
      title: "Browse Customer Bin",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/pos-customer/:id/detail",
    name: "PosCustomerRead",
    component: Pages,
    meta: {
      title: "Detail Customer",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/pos-customer/:id/edit",
    name: "PosCustomerEdit",
    component: Pages,
    meta: {
      title: "Edit Customer",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/pos-customer/add",
    name: "PosCustomerAdd",
    component: Pages,
    meta: {
      title: "Add Customer",
      useComponent: "AdminContainer",
    },
  },
  // end

  // start employee
  {
    path: prefix + "/pos-employee",
    name: "PosEmployeeBrowse",
    component: Pages,
    meta: {
      title: "Browse Employee",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/pos-employee/bin",
    name: "PosEmployeeBrowseBin",
    component: Pages,
    meta: {
      title: "Browse Employee Bin",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/pos-employee/:id/detail",
    name: "PosEmployeeRead",
    component: Pages,
    meta: {
      title: "Detail Employee",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/pos-employee/:id/edit",
    name: "PosEmployeeEdit",
    component: Pages,
    meta: {
      title: "Edit Employee",
      useComponent: "AdminContainer",
    },
  },
  {
    path: prefix + "/pos-employee/add",
    name: "PosEmployeeAdd",
    component: Pages,
    meta: {
      title: "Add Employee",
      useComponent: "AdminContainer",
    },
  },
  // end
];
