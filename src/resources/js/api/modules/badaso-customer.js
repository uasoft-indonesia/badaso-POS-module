import resource from "../../../../../../core/src/resources/js/api/resource";
import QueryString from "../../../../../../core/src/resources/js/api/query-string";

let apiPrefix = process.env.MIX_API_ROUTE_PREFIX
  ? "/" + process.env.MIX_API_ROUTE_PREFIX + "/module/pos"
  : "/badaso-api/module/pos";

export default {
  browse(data = {}) {
    let ep = apiPrefix + "/v1/customer";
    let qs = QueryString(data);
    let url = ep + qs;
    return resource.get(url);
  },

  add(data) {
    return resource.post(apiPrefix + "/v1/customer/add", data);
  },

  read(data) {
    let ep = apiPrefix + "/v1/customer/read";
    let qs = QueryString(data);
    let url = ep + qs;
    return resource.get(url);
  },

  edit(data) {
    return resource.put(apiPrefix + "/v1/customer/edit", data);
  },

  delete(data) {
    let paramData = {
      data: data,
    };
    return resource.delete(apiPrefix + "/v1/customer/delete", paramData);
  },

  deleteMultiple(data) {
    let paramData = {
      data: data,
    };
    return resource.delete(
      apiPrefix + "/v1/customer/delete-multiple",
      paramData
    );
  },

  browseBin(data = {}) {
    let ep = apiPrefix + "/v1/customer/bin";
    let qs = QueryString(data);
    let url = ep + qs;
    return resource.get(url);
  },

  restore(data) {
    return resource.post(apiPrefix + "/v1/customer/restore", data);
  },

  restoreMultiple(data) {
    return resource.post(apiPrefix + "/v1/customer/restore-multiple", data);
  },

  forceDelete(data) {
    let paramData = {
      data: data,
    };
    return resource.delete(apiPrefix + "/v1/customer/force-delete", paramData);
  },

  forceDeleteMultiple(data) {
    let paramData = {
      data: data,
    };
    return resource.delete(
      apiPrefix + "/v1/customer/force-delete-multiple",
      paramData
    );
  },
};
