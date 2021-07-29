<template>
  <div>
    <badaso-breadcrumb-row>
      <template slot="action">
        <vs-button
          color="primary"
          type="relief"
          :to="{ name: 'PosCustomerAdd' }"
          v-if="$helper.isAllowed('add_pos_customer')"
          ><vs-icon icon="add"></vs-icon> {{ $t("action.add") }}</vs-button
        >
        <vs-button
          color="danger"
          type="relief"
          :to="{ name: 'PosCustomerBrowseBin' }"
          v-if="$helper.isAllowed('browse_pos_customer_bin')"
          ><vs-icon icon="delete"></vs-icon> {{ $t("action.bin") }}</vs-button
        >
        <vs-button
          color="danger"
          type="relief"
          v-if="selected.length > 0 && $helper.isAllowed('delete_pos_customer')"
          @click.stop
          @click="confirmDeleteMultiple"
          ><vs-icon icon="delete_sweep"></vs-icon>
          {{ $t("action.bulkDelete") }}</vs-button
        >
      </template>
    </badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('browse_pos_customer')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("customer.browseTitle") }}</h3>
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
                $t('discounts.browse.footer.descriptionTitle')
              "
              :description-connector="
                $t('discounts.browse.footer.descriptionConnector')
              "
              :description-body="$t('discounts.browse.footer.descriptionBody')"
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
                <badaso-th sort-key="createdAt">
                  {{ $t("customer.field.createdAt") }}
                </badaso-th>
                <badaso-th sort-key="updatedAt">
                  {{ $t("customer.field.updatedAt") }}
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

                  <vs-td :data="customer.createdAt">
                    {{ getDate(customer.createdAt) }}
                  </vs-td>
                  <vs-td :data="customer.updatedAt">
                    {{ getDate(customer.updatedAt) }}
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
                          icon="visibility"
                          :to="{
                            name: 'PosCustomerRead',
                            params: { id: customer.id },
                          }"
                          v-if="$helper.isAllowed('read_pos_customer')"
                        >
                          Detail
                        </badaso-dropdown-item>
                        <badaso-dropdown-item
                          icon="edit"
                          :to="{
                            name: 'PosCustomerEdit',
                            params: { id: customer.id },
                          }"
                          v-if="$helper.isAllowed('edit_pos_customer')"
                        >
                          Edit
                        </badaso-dropdown-item>
                        <badaso-dropdown-item
                          icon="delete"
                          @click="confirmDelete(customer.id)"
                          v-if="$helper.isAllowed('delete_pos_customer')"
                        >
                          Delete
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
  name: "PosCustomerBrowse",
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
      orderField: "updated_at",
      orderDirection: "desc",
      willDeleteId: null,
    };
  },
  mounted() {
    this.getCustomerList();
  },
  methods: {
    getDate(date) {
      return moment(date).format("DD MMMM YYYY");
    },
    confirmDelete(id) {
      this.willDeleteId = id;
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.deleteDiscount,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {
          this.willDeleteId = null;
        },
      });
    },
    confirmDeleteMultiple(id) {
      this.$vs.dialog({
        type: "confirm",
        color: "danger",
        title: this.$t("action.delete.title"),
        text: this.$t("action.delete.text"),
        accept: this.bulkDeleteDiscounts,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {},
      });
    },
    deleteDiscount() {
      this.$openLoader();
      this.$api.badasoCustomer
        .delete({ id: this.willDeleteId })
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
    bulkDeleteDiscounts() {
      const ids = this.selected.map((item) => item.id);
      this.$openLoader();
      this.$api.badasoCustomer
        .deleteMultiple({
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
        .browse()
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
