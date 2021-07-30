<template>
  <vs-collapse-item type="border">
        <div slot="header">
          <vs-row>
            <vs-col type="flex" vs-w="8" vs-align="center">
                <h3 style="justify-content: center;">
                    Tenggo
                </h3>
            </vs-col>
            <vs-col type="flex" vs-w="4" vs-align="flex-end">
              <vs-chip color="primary">
                Rp 5.000
              </vs-chip>
            </vs-col>
          </vs-row>
        </div>
        <div>
          <vs-list>
            <vs-list-item title="Quatity">
              <vs-input-number size="medium" v-model="quatity" />
            </vs-list-item>
            <vs-list-item title="Price" subtitle="Rp 1.000"></vs-list-item>
            <vs-list-item title="Discount" subtitle="-"></vs-list-item>
            <vs-list-item title="Total" subtitle="Rp 5.000"></vs-list-item>
          </vs-list>
        </div>
      </vs-collapse-item>
</template>
<script>
export default {
  name: "PosOrderItem",
  data: () => ({
    quatity: 10,
  }),
};
</script>
