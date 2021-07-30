export const posDefaultRoute = (path = null) => {

    let prefix = process.env.MIX_POS_ROUTE_PREFIX
      ? "/" + process.env.MIX_POS_ROUTE_PREFIX
      : "/pos";

    if(path == null) return prefix

    return prefix + path
}
