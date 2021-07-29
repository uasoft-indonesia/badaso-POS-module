<template>
  <div>
    <badaso-breadcrumb-row>
      <template slot="action">
        <vs-button
          color="success"
          type="relief"
          v-if="
            selected.length > 0 && $helper.isAllowed('restore_pos_employee')
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
              $helper.isAllowed('delete_permanent_pos_employee')
          "
          @click.stop
          @click="confirmDeleteMultiple"
          ><vs-icon icon="delete_sweep"></vs-icon>
          {{ $t("action.bulkDelete") }}</vs-button
        >
      </template>
    </badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('browse_pos_employee_bin')">
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
              :data="employee"
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
                  {{ $t("employee.field.name") }}
                </badaso-th>
                <badaso-th sort-key="addressLine1">
                  {{ $t("employee.field.addressLine1") }}
                </badaso-th>
                <badaso-th sort-key="city">
                  {{ $t("employee.field.city") }}
                </badaso-th>
                <badaso-th sort-key="postalCode">
                  {{ $t("employee.field.postalCode") }}
                </badaso-th>
                <badaso-th sort-key="country">
                  {{ $t("employee.field.country") }}
                </badaso-th>
                <badaso-th sort-key="telephone">
                  {{ $t("employee.field.telephone") }}
                </badaso-th>
                <badaso-th sort-key="mobile">
                  {{ $t("employee.field.mobile") }}
                </badaso-th>
                <badaso-th sort-key="deletedAt">
                  {{ $t("employee.field.deletedAt") }}
                </badaso-th>

                <vs-th> {{ $t("discounts.browse.header.action") }} </vs-th>
              </template>

              <template slot-scope="{ data }">
                <vs-tr
                  :data="employee"
                  :key="index"
                  v-for="(employee, index) in data"
                >
                  <vs-td :data="employee.name">
                    {{ employee.name }}
                  </vs-td>
                  <vs-td :data="employee.addressLine1">
                    {{ employee.addressLine1 }}
                  </vs-td>
                  <vs-td :data="employee.city">
                    {{ employee.city }}
                  </vs-td>
                  <vs-td :data="employee.postalCode">
                    {{ employee.postalCode }}
                  </vs-td>
                  <vs-td :data="employee.country">
                    {{ employee.country }}
                  </vs-td>
                  <vs-td :data="employee.telephone">
                    {{ employee.telephone }}
                  </vs-td>
                  <vs-td :data="employee.mobile">
                    {{ employee.mobile }}
                  </vs-td>
                  <vs-td :data="employee.deletedAt">
                    {{ getDate(employee.deletedAt) }}
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
                          @click="confirmRestore(employee.id)"
                          v-if="$helper.isAllowed('restore_pos_employee')"
                        >
                          Restore
                        </badaso-dropdown-item>
                        <badaso-dropdown-item
                          icon="edit"
                          @click="confirmDelete(employee.id)"
                          v-if="
                            $helper.isAllowed('delete_permanent_pos_employee')
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
      employee: [],
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
    this.getEmployeeList();
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
        accept: this.restoreEmployee,
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
        accept: this.deleteEmployee,
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
        accept: this.bulkRestoreEmployee,
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
        accept: this.bulkDeleteEmployee,
        acceptText: this.$t("action.delete.accept"),
        cancelText: this.$t("action.delete.cancel"),
        cancel: () => {},
      });
    },
    deleteEmployee() {
      this.$openLoader();
      this.$api.badasoEmployee
        .forceDelete({ id: this.willDeleteId })
        .then((response) => {
          this.$closeLoader();
          this.getEmployeeList();
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
    restoreEmployee() {
      this.$openLoader();
      this.$api.badasoEmployee
        .restore({ id: this.willRestoreId })
        .then((response) => {
          this.$closeLoader();
          this.getEmployeeList();
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
    bulkDeleteEmployee() {
      const ids = this.selected.map((item) => item.id);
      this.$openLoader();
      this.$api.badasoEmployee
        .forceDeleteMultiple({
          ids: ids.join(","),
        })
        .then((response) => {
          this.$closeLoader();
          this.getEmployeeList();
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
    bulkRestoreEmployee() {
      const ids = this.selected.map((item) => item.id);
      this.$openLoader();
      this.$api.badasoEmployee
        .restoreMultiple({
          ids: ids.join(","),
        })
        .then((response) => {
          this.$closeLoader();
          this.getEmployeeList();
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
    getEmployeeList() {
      this.$openLoader();
      this.$api.badasoEmployee
        .browseBin()
        .then((response) => {
          this.$closeLoader();
          this.selected = [];
          this.employee = response.data.employee;
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
