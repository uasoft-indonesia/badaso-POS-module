<template>
  <pos-layout>
    <pos-navbar />
    <div style="margin: 10px;">
      <vs-col type="flex" vs-w="4">
        <vs-col type="flex" vs-justify="center" vs-align="center">
          <vs-card class="cardx">
            <div slot="header">
              <h3>Order Detail Product</h3>
            </div>
            <div>
              <vs-list>
                <div>
                  <pos-order-item />
                  <pos-order-item />
                  <pos-order-item />
                </div>
              </vs-list>
            </div>
            <div slot="footer">
              <vs-row vs-justify="flex-end">
                <vs-col vs-w="6">
                  <vs-card>
                    <vs-row>
                      <vs-col>
                        <h3>
                          Total
                        </h3>
                      </vs-col>
                      <vs-col>
                        <h2>
                          Rp 10.000
                        </h2>
                      </vs-col>
                    </vs-row>
                  </vs-card>
                </vs-col>
              </vs-row>
            </div>
          </vs-card>
          <vs-card>
            <div>
                <vs-button>Customer</vs-button>
                <vs-button>Payment</vs-button>
            </div>
          </vs-card>
        </vs-col>
      </vs-col>
      <vs-col vs-w="8">
          <vs-row>
              <vs-card>
              <div slot="header"></div>
              <div></div>
              <div slot="footer"></div>
          </vs-card>
          </vs-row>
      </vs-col>
    </div>
  </pos-layout>
</template>
<script>
import PosNavbar from "../components/PosNavbar.vue";
import PosOrderItem from "../components/PosOrderItem.vue";
import PosLayout from "../layouts/PosLayout.vue";
export default {
  components: { PosLayout, PosNavbar, PosOrderItem },
};
</script>
