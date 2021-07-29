<template>
  <div>
    <badaso-breadcrumb-row></badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('add_pos_employee')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("employee.addTitle") }}</h3>
          </div>
          <vs-row>
            <badaso-text
              v-model="employee.name"
              size="12"
              :label="$t('employee.field.name')"
              :placeholder="$t('employee.field.name')"
              :alert="errors.name"
            ></badaso-text>

            <badaso-text
              v-model="employee.addressLine1"
              size="12"
              :label="$t('employee.field.addressLine1')"
              :placeholder="$t('employee.field.addressLine1')"
              :alert="errors.addressLine1"
            ></badaso-text>

            <badaso-text
              v-model="employee.addressLine2"
              size="12"
              :label="$t('employee.field.addressLine2')"
              :placeholder="$t('employee.field.addressLine2')"
              :alert="errors.addressLine2"
            ></badaso-text>

            <badaso-text
              v-model="employee.city"
              size="6"
              :label="$t('employee.field.city')"
              :placeholder="$t('employee.field.city')"
              :alert="errors.city"
            ></badaso-text>

            <badaso-number
              v-model="employee.postalCode"
              size="6"
              :label="$t('employee.field.postalCode')"
              :placeholder="$t('employee.field.postalCode')"
              :alert="errors.postalCode"
            ></badaso-number>

            <badaso-text
              v-model="employee.country"
              size="6"
              :label="$t('employee.field.country')"
              :placeholder="$t('employee.field.country')"
              :alert="errors.country"
            ></badaso-text>

            <badaso-number
              v-model="employee.telephone"
              size="6"
              :label="$t('employee.field.telephone')"
              :placeholder="$t('employee.field.telephone')"
              :alert="errors.telephone"
            ></badaso-number>

            <badaso-number
              v-model="employee.mobile"
              size="6"
              :label="$t('employee.field.mobile')"
              :placeholder="$t('employee.field.mobile')"
              :alert="errors.mobile"
            ></badaso-number>
          </vs-row>
        </vs-card>
      </vs-col>
      <vs-col vs-lg="12">
        <vs-card class="action-card">
          <vs-row>
            <vs-col vs-lg="12">
              <vs-button color="primary" type="relief" @click="submitForm">
                <vs-icon icon="save"></vs-icon> {{ $t("employee.addButton") }}
              </vs-button>
            </vs-col>
          </vs-row>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>

<script>
export default {
  name: "PosEmployeeAdd",
  components: {},
  data() {
    return {
      errors: {},
      employee: {
        name: null,
        addressLine1: null,
        addressLine2: null,
        city: null,
        postalCode: null,
        country: null,
        telephone: null,
        mobile: null,
      },
    };
  },
  methods: {
    submitForm() {
      this.errors = {};
      try {
        this.$openLoader();
        this.$api.badasoEmployee
          .add(this.employee)
          .then((response) => {
            this.$closeLoader();
            this.$router.push({ name: "PosEmployeeBrowse" });
          })
          .catch((error) => {
            this.errors = error.errors;
            this.$closeLoader();
            this.$vs.notify({
              title: this.$t("alert.danger"),
              text: error.message,
              color: "danger",
            });
          });
      } catch (error) {
        this.errors = error.data;
        this.$vs.notify({
          title: this.$t("alert.danger"),
          text: error.message,
          color: "danger",
        });
      }
    },
  },
};
</script>
