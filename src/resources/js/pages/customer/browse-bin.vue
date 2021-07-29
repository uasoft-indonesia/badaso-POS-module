<template>
  <div>
    <badaso-breadcrumb-row>
      <template slot="action">
        <vs-button
          color="success"
          type="relief"
          v-if="
            selected.length > 0 && $helper.isAllowed('restore_pos_customer')
          "
          @click.stop
          @click="confirmRestoreMultiple"
          ><vs-icon icon="restore"></vs-icon>
          {{ $t("action.bulkRestore") }}</vs-button
        >
        <vs-button
          color="danger"
          type="relief"
          v-if="
            selected.length > 0 &&
              $helper.isAllowed('delete_permanent_pos_customer')
          "
          @click.stop
          @click="confirmDeleteMultiple"
          ><vs-icon icon="delete_sweep"></vs-icon>
          {{ $t("action.bulkDelete") }}</vs-button
        >
      </template>
    </badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('browse_pos_customer_bin')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("discounts.browseBin.title") }}</h3>
          </div>
          <div>
            <badaso-table
              multiple
              v-model="selected"
              pagination
              max-items="10"
              search
              :data="customer"
              stripe
              description
              :description-items="descriptionItems"
              :description-title="
                $t('discounts.browseBin.footer.descriptionTitle')
              "
              :description-connector="
                $t('discounts.browseBin.footer.descriptionConnector')
              "
              :description-body="
                $t('discounts.browseBin.footer.descriptionBody')
              "
            >
              <template slot="thead">
                <badaso-th sort-key="name">
                  {{ $t("customer.field.name") }}
                </badaso-th>
                <badaso-th sort-key="addressLine1">
                  {{ $t("customer.field.addressLine1") }}
                </badaso-th>
                <badaso-th sort-key="city">
                  {{ $t("customer.field.city") }}
                </badaso-th>
                <badaso-th sort-key="postalCode">
                  {{ $t("customer.field.postalCode") }}
                </badaso-th>
                <badaso-th sort-key="country">
                  {{ $t("customer.field.country") }}
                </badaso-th>
                <badaso-th sort-key="telephone">
                  {{ $t("customer.field.telephone") }}
                </badaso-th>
                <badaso-th sort-key="mobile">
                  {{ $t("customer.field.mobile") }}
                </badaso-th>
                <badaso-th sort-key="deletedAt">
                  {{ $t("customer.field.deletedAt") }}
                </badaso-th>

                <vs-th> {{ $t("discounts.browse.header.action") }} </vs-th>
              </template>

              <template slot-scope="{ data }">
                <vs-tr
                  :data="customer"
                  :key="index"
                  v-for="(customer, index) in data"
                >
                  <vs-td :data="customer.name">
                    {{ customer.name }}
                  </vs-td>
                  <vs-td :data="customer.addressLine1">
                    {{ customer.addressLine1 }}
                  </vs-td>
                  <vs-td :data="customer.city">
                    {{ customer.city }}
                  </vs-td>
                  <vs-td :data="customer.postalCode">
                    {{ customer.postalCode }}
                  </vs-td>
                  <vs-td :data="customer.country">
                    {{ customer.country }}
                  </vs-td>
                  <vs-td :data="customer.telephone">
                    {{ customer.telephone }}
                  </vs-td>
                  <vs-td :data="customer.mobile">
                    {{ customer.mobile }}
                  </vs-td>
                  <vs-td :data="customer.deletedAt">
                    {{ getDate(customer.deletedAt) }}
                  </vs-td>
                  <vs-td style="width: 1%; white-space: nowrap">
                    <badaso-dropdown vs-trigger-click>
                      <vs-button
                        size="large"
                        type="flat"
                        icon="more_vert"
                      ></vs-button>
                      <vs-dropdown-menu>
                        <badaso-dropdown-item
                          icon="restore"
                          @click="confirmRestore(customer.id)"
                          v-if="$helper.isAllowed('restore_pos_customer')"
                        >
                          Restore
                        </badaso-dropdown-item>
                        <badaso-dropdown-item
                          icon="edit"
                          @click="confirmDelete(customer.id)"
                          v-if="
                            $helper.isAllowed('delete_permanent_pos_customer')
                          "
                        >
                          Delete Permanent
                        </badaso-dropdown-item>
                      </vs-dropdown-menu>
                    </badaso-dropdown>
                  </vs-td>
                </vs-tr>
              </template>
            </badaso-table>
          </div>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>

<script>
import moment from "moment";
export default {
  name: "PosEmployeeBrowseBin",
  components: {},
  data() {
    return {
      selected: [],
      customer: [],
      descriptionItems: [10, 50, 100],
      totalItem: 0,
      filter: "",
      page: 1,
      limit: 10,
      orderField: "deletedAt",
      orderDirection: "desc",
      willDeleteId: null,
      willRestoreId: null,
    };
  },
  mounted() {
    this.getCustomerList();
  },
  methods: {
    getDate(date) {
      return moment(date).format("dddd, DD MMMM YYYY");
    },
    confirmRestore(id) {
      this.willRestoreId = id;
      this.$vs.dialog({
        type: "confirm",
        color: "success",
        title: this.$t("action.restore.title"),
        text: this.$t("action.restore.text"),
        accept: this.restoreCustomer,
        acceptText: this.$t("action.restore.accept"),
        cancelText: this.$t("action.restore.cancel"),
        cancel: () => {
          this.willRestoreId = null;
        },
      });
    },
    confirmDelete(id) {
      this.willDeleteId = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.deleteCustomer,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {
          this.willDeleteId = null;
        },
      });
    },
    confirmRestoreMultiple() {
      this.$vs.dialog({
        type: "confirm",
        color: "success",
        title: this.$t("action.restore.title"),
        text: this.$t("action.restore.text"),
        accept: this.bulkRestoreCustomer,
        acceptText: this.$t("action.restore.accept"),
        cancelText: this.$t("action.restore.cancel"),
        cancel: () => {},
      });
    },
    confirmDeleteMultiple() {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.bulkDeleteCustomer,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {},
      });
    },
    deleteCustomer() {
      this.$openLoader();
      this.$api.badasoCustomer
        .forceDelete({ id: this.willDeleteId })
        .then((response) => {
          this.$closeLoader();
          this.getCustomerList();
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    restoreCustomer() {
      this.$openLoader();
      this.$api.badasoCustomer
        .restore({ id: this.willRestoreId })
        .then((response) => {
          this.$closeLoader();
          this.getCustomerList();
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    bulkDeleteCustomer() {
      const ids = this.selected.map((item) => item.id);
      this.$openLoader();
      this.$api.badasoCustomer
        .forceDeleteMultiple({
          ids: ids.join(","),
        })
        .then((response) => {
          this.$closeLoader();
          this.getCustomerList();
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    bulkRestoreCustomer() {
      const ids = this.selected.map((item) => item.id);
      this.$openLoader();
      this.$api.badasoCustomer
        .restoreMultiple({
          ids: ids.join(","),
        })
        .then((response) => {
          this.$closeLoader();
          this.getCustomerList();
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
    getCustomerList() {
      this.$openLoader();
      this.$api.badasoCustomer
        .browseBin()
        .then((response) => {
          this.$closeLoader();
          this.selected = [];
          this.customer = response.data.customers;
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
  },
};
</script>
