<template>
  <div>
    <badaso-breadcrumb-row>
      <template slot="action">
        <vs-button
          color="warning"
          type="relief"
          :to="{ name: 'PosCustomerEdit', params: { id: $route.params.id } }"
          v-if="$helper.isAllowed('edit_discounts')"
          ><vs-icon icon="edit"></vs-icon> {{ $t("action.edit") }}</vs-button
        >
      </template>
    </badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('read_discounts')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("customer.detailTitle") }}</h3>
          </div>
          <table class="badaso-table">
            <tr>
              <th>{{ $t("customer.field.name") }}</th>
              <td>{{ customer.name }}</td>
            </tr>
            <tr>
              <th>{{ $t("customer.field.addressLine1") }}</th>
              <td>{{ customer.addressLine1 }}</td>
            </tr>
            <tr>
              <th>{{ $t("customer.field.addressLine2") }}</th>
              <td>{{ customer.addressLine2 }}</td>
            </tr>
            <tr>
              <th>{{ $t("customer.field.postalCode") }}</th>
              <td>{{ customer.postalCode }}</td>
            </tr>
            <tr>
              <th>{{ $t("customer.field.country") }}</th>
              <td>{{ customer.country }}</td>
            </tr>
            <tr>
              <th>{{ $t("customer.field.telephone") }}</th>
              <td>{{ customer.telephone }}</td>
            </tr>
            <tr>
              <th>{{ $t("customer.field.mobile") }}</th>
              <td>{{ customer.mobile }}</td>
            </tr>
            <tr>
              <th>{{ $t("customer.field.createdAt") }}</th>
              <td>{{ getDate(customer.createdAt) }}</td>
            </tr>
            <tr>
              <th>{{ $t("customer.field.updatedAt") }}</th>
              <td>{{ getDate(customer.updatedAt) }}</td>
            </tr>
            <tr>
              <th>{{ $t("customer.field.deletedAt") }}</th>
              <td>{{ customer.deletedAt ? getDate(customer.deletedAt) : 'None' }}</td>
            </tr>
          </table>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>

<script>
import moment from 'moment'
export default {
  name: "PosCustomerRead",
  components: {},
  data: () => ({
    customer: {
        name: null,
        addressLine1: null,
        addressLine2: null,
        city: null,
        postalCode: null,
        country: null,
        telephone: null,
        mobile: null,
        createdAt: null,
        updatedAt: null,
      },
  }),
  mounted() {
    this.getCustomer();
  },
  methods: {
    getDate(date) {
      return moment(date).format('dddd, DD MMMM YYYY')
    },
    getCustomer() {
      this.$openLoader();
      this.$api.badasoCustomer
        .read({ id: this.$route.params.id })
        .then((response) => {
          this.$closeLoader();
          this.customer = response.data.customer
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
