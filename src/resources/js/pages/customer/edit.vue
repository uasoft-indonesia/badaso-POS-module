<template>
  <div>
    <badaso-breadcrumb-row></badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('add_pos_customer')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("customer.editTitle") }}</h3>
          </div>
          <vs-row>
            <badaso-text
              v-model="customer.name"
              size="12"
              :label="$t('customer.field.name')"
              :placeholder="$t('customer.field.name')"
              :alert="errors.name"
            ></badaso-text>

            <badaso-text
              v-model="customer.addressLine1"
              size="12"
              :label="$t('customer.field.addressLine1')"
              :placeholder="$t('customer.field.addressLine1')"
              :alert="errors.addressLine1"
            ></badaso-text>

            <badaso-text
              v-model="customer.addressLine2"
              size="12"
              :label="$t('customer.field.addressLine2')"
              :placeholder="$t('customer.field.addressLine2')"
              :alert="errors.addressLine2"
            ></badaso-text>

            <badaso-text
              v-model="customer.city"
              size="6"
              :label="$t('customer.field.city')"
              :placeholder="$t('customer.field.city')"
              :alert="errors.city"
            ></badaso-text>

            <badaso-number
              v-model="customer.postalCode"
              size="6"
              :label="$t('customer.field.postalCode')"
              :placeholder="$t('customer.field.postalCode')"
              :alert="errors.postalCode"
            ></badaso-number>

            <badaso-text
              v-model="customer.country"
              size="6"
              :label="$t('customer.field.country')"
              :placeholder="$t('customer.field.country')"
              :alert="errors.country"
            ></badaso-text>

            <badaso-number
              v-model="customer.telephone"
              size="6"
              :label="$t('customer.field.telephone')"
              :placeholder="$t('customer.field.telephone')"
              :alert="errors.telephone"
            ></badaso-number>

            <badaso-number
              v-model="customer.mobile"
              size="6"
              :label="$t('customer.field.mobile')"
              :placeholder="$t('customer.field.mobile')"
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
                <vs-icon icon="save"></vs-icon> {{ $t("customer.addButton") }}
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
  name: "PosCustomerEdit",
  components: {},
  data() {
    return {
      errors: {},
      customer: {
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
  mounted(){
      this.getCustomer()
  },
  methods: {
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
    submitForm() {
      this.errors = {};
      try {
        this.$openLoader();
        this.$api.badasoCustomer
          .edit(this.customer)
          .then((response) => {
            this.$closeLoader();
            this.$router.push({ name: "PosCustomerBrowse" });
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
