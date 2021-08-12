export class ProductOrder {
  constructor({
    productDetail = {},
    productDetailId = null,
    discountId = null,
    price = 0,
    discounted = 0,
    quantity = 0,
  }) {
    this.productDetailId = productDetailId;
    this.discountId = discountId;
    this.price = price;
    this.discounted = discounted;
    this.quantity = quantity;
    this.productDetail = productDetail;
  }

  getTotal() {
    let total;
    if (this.discounted > 0) {
      total = this.discounted * this.quantity;
    } else {
      total = this.price * this.quantity;
    }

    return total;
  }
}

export class ProductOrderList {
  constructor(products = []) {
    this.products = products;
  }

  /**
   *
   * @param product Product
   */
  add(product = new ProductOrder()) {
    let productIndex = this.products.findIndex(
      (item, index) => item.productDetailId == product.productDetailId
    );

    if (productIndex != -1) {
      let productExist = this.products[productIndex];
      productExist.quantity += product.quantity;

      this.products[productIndex] = productExist;
    } else {
      this.products.push(product);
    }
  }
}
