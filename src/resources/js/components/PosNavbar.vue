<template>
  <div class="centerx">
    <vs-navbar
      v-model="indexActive"
      :color="colorx"
      text-color="rgb(6, 187, 211)"
      active-text-color="rgb(6, 187, 211)"
      class="myNavbar"
    >
      <div slot="title">
        <vs-navbar-title>
          Badaso Pos
        </vs-navbar-title>
      </div>

      <vs-navbar-item index="0">
        <a href="/badaso-dashboard">Dashboard</a>
      </vs-navbar-item>
      <vs-navbar-item index="1">
        <a href="#">Order</a>
      </vs-navbar-item>
      <vs-navbar-item index="2">
        <a href="#">Employee</a>
      </vs-navbar-item>
      <vs-navbar-item index="3">
        <a href="#">Customers</a>
      </vs-navbar-item>

      <vs-spacer></vs-spacer>

      <vs-button
        color-text="rgb(255, 255, 255)"
        color="rgba(255, 255, 255, 0.3)"
        type="flat"
        icon="more_horiz"
      ></vs-button>
    </vs-navbar>
  </div>
</template>

<script>
export default {
  data: () => ({
    colorx: "rgba(255,255,255,1)",
    indexActive: 1,
  }),
};
</script>
