<template>
  <div>
    <badaso-breadcrumb-row>
      <template slot="action">
        <vs-button
          color="warning"
          type="relief"
          :to="{ name: 'PosEmployeeEdit', params: { id: $route.params.id } }"
          v-if="$helper.isAllowed('edit_discounts')"
          ><vs-icon icon="edit"></vs-icon> {{ $t("action.edit") }}</vs-button
        >
      </template>
    </badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('read_discounts')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("employee.detailTitle") }}</h3>
          </div>
          <table class="badaso-table">
            <tr>
              <th>{{ $t("employee.field.name") }}</th>
              <td>{{ employee.name }}</td>
            </tr>
            <tr>
              <th>{{ $t("employee.field.addressLine1") }}</th>
              <td>{{ employee.addressLine1 }}</td>
            </tr>
            <tr>
              <th>{{ $t("employee.field.addressLine2") }}</th>
              <td>{{ employee.addressLine2 }}</td>
            </tr>
            <tr>
              <th>{{ $t("employee.field.postalCode") }}</th>
              <td>{{ employee.postalCode }}</td>
            </tr>
            <tr>
              <th>{{ $t("employee.field.country") }}</th>
              <td>{{ employee.country }}</td>
            </tr>
            <tr>
              <th>{{ $t("employee.field.telephone") }}</th>
              <td>{{ employee.telephone }}</td>
            </tr>
            <tr>
              <th>{{ $t("employee.field.mobile") }}</th>
              <td>{{ employee.mobile }}</td>
            </tr>
            <tr>
              <th>{{ $t("employee.field.createdAt") }}</th>
              <td>{{ getDate(employee.createdAt) }}</td>
            </tr>
            <tr>
              <th>{{ $t("employee.field.updatedAt") }}</th>
              <td>{{ getDate(employee.updatedAt) }}</td>
            </tr>
            <tr>
              <th>{{ $t("employee.field.deletedAt") }}</th>
              <td>{{ employee.deletedAt ? getDate(employee.deletedAt) : 'None' }}</td>
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
  name: "PosEmployeeRead",
  components: {},
  data: () => ({
    employee: {
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
    this.getEmployee();
  },
  methods: {
    getDate(date) {
      return moment(date).format('dddd, DD MMMM YYYY')
    },
    getEmployee() {
      this.$openLoader();
      this.$api.badasoEmployee
        .read({ id: this.$route.params.id })
        .then((response) => {
          this.$closeLoader();
          this.employee = response.data.employee
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
