export const posDefaultRoute = (path = null) => {

    let prefix = process.env.MIX_POS_ROUTE_PREFIX
      ? "/" + process.env.MIX_POS_ROUTE_PREFIX
      : "/pos";

    if(path == null) return prefix

    return prefix + path
}


export const resultDiscountPercent = (price, percentDiscount) => {
    return price - (price * (percentDiscount/100))
}

export const resultDiscountFixed = (price, fixedDiscount) => {
    return price - fixedDiscount
}

export const resultDiscount = ({discountType = 'discount', discountPercent = 0, discountFixed = 0 }, price) => {
    switch (discountType) {
        case 'discount':
            return resultDiscountPercent(price, discountPercent)
            break;

        default:
            return resultDiscountFixed(price, discountFixed)
            break;
    }
}

