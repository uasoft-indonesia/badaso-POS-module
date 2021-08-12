<template>
  <vs-row vs-type="flex">
    <vs-col vs-type="flex" vs-align="center" vs-w="4">
      <vs-input icon="search" placeholder="Search" v-model="value1" />
    </vs-col>
    <vs-col vs-type="flex" vs-align="center" vs-w="2">
      <vs-select
        placeholder="Show Product"
        class="Show Detail Product"
        multiple
        autocomplete
        v-model="select"
      >
        <!-- <vs-select-item
                        :key="index"
                        :value="item.value"
                        :text="item.text"
                        v-for="(item, index) in options"
                      /> -->
      </vs-select>
    </vs-col>
    <vs-col vs-type="flex" vs-align="center" vs-w="2">
      <vs-select
        placeholder="Category Product"
        class="Category Product"
        multiple
        autocomplete
        v-model="select"
      >
        <!-- <vs-select-item
                        :key="index"
                        :value="item.value"
                        :text="item.text"
                        v-for="(item, index) in options"
                      /> -->
      </vs-select>
    </vs-col>
    <vs-col vs-type="flex" vs-align="center" vs-w="2">
      <vs-select
        placeholder="A-Z"
        class="A-Z"
        multiple
        autocomplete
        v-model="select"
      >
        <!-- <vs-select-item
                        :key="index"
                        :value="item.value"
                        :text="item.text"
                        v-for="(item, index) in options"
                      /> -->
      </vs-select>
    </vs-col>
  </vs-row>
</template>
<script>
export default {
  name: "PosSearchProduct",
  data() {
    return {
      options: [
        { text: "Makanan", value: 1 },
        { text: "Minuman", value: 2 },
        { text: "Sabun", value: 3 },
      ],
    };
  },
};
</script>
