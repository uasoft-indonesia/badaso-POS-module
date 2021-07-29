<template>
  <div>
    <badaso-breadcrumb-row>
      <template slot="action">
        <vs-button
          color="primary"
          type="relief"
          :to="{ name: 'PosEmployeeAdd' }"
          v-if="$helper.isAllowed('add_pos_employee')"
          ><vs-icon icon="add"></vs-icon> {{ $t("action.add") }}</vs-button
        >
        <vs-button
          color="danger"
          type="relief"
          :to="{ name: 'PosEmployeeBrowseBin' }"
          v-if="$helper.isAllowed('browse_pos_employee_bin')"
          ><vs-icon icon="delete"></vs-icon> {{ $t("action.bin") }}</vs-button
        >
        <vs-button
          color="danger"
          type="relief"
          v-if="selected.length > 0 && $helper.isAllowed('delete_pos_employee')"
          @click.stop
          @click="confirmDeleteMultiple"
          ><vs-icon icon="delete_sweep"></vs-icon>
          {{ $t("action.bulkDelete") }}</vs-button
        >
      </template>
    </badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('browse_pos_employee')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("employee.browseTitle") }}</h3>
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
                $t('discounts.browse.footer.descriptionTitle')
              "
              :description-connector="
                $t('discounts.browse.footer.descriptionConnector')
              "
              :description-body="$t('discounts.browse.footer.descriptionBody')"
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
                <badaso-th sort-key="createdAt">
                  {{ $t("employee.field.createdAt") }}
                </badaso-th>
                <badaso-th sort-key="updatedAt">
                  {{ $t("employee.field.updatedAt") }}
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

                  <vs-td :data="employee.createdAt">
                    {{ getDate(employee.createdAt) }}
                  </vs-td>
                  <vs-td :data="employee.updatedAt">
                    {{ getDate(employee.updatedAt) }}
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
                            name: 'PosEmployeeRead',
                            params: { id: employee.id },
                          }"
                          v-if="$helper.isAllowed('read_pos_employee')"
                        >
                          Detail
                        </badaso-dropdown-item>
                        <badaso-dropdown-item
                          icon="edit"
                          :to="{
                            name: 'PosEmployeeEdit',
                            params: { id: employee.id },
                          }"
                          v-if="$helper.isAllowed('edit_pos_employee')"
                        >
                          Edit
                        </badaso-dropdown-item>
                        <badaso-dropdown-item
                          icon="delete"
                          @click="confirmDelete(employee.id)"
                          v-if="$helper.isAllowed('delete_pos_employee')"
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
  name: "PosEmployeeBrowse",
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
      orderField: "updated_at",
      orderDirection: "desc",
      willDeleteId: null,
    };
  },
  mounted() {
    this.getEmployeeList();
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
      this.$api.badasoEmployee
        .delete({ id: this.willDeleteId })
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
    bulkDeleteDiscounts() {
      const ids = this.selected.map((item) => item.id);
      this.$openLoader();
      this.$api.badasoEmployee
        .deleteMultiple({
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
        .browse()
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
