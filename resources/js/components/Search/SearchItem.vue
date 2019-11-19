<template>
  <div
    class="shadow p-4 w-44-percent lg:w-30-percent inline-block"
    :class="this.customClass"
    v-if="cityInBlacklist(item.address.city_name)"
  >
    <a :href="item.permalink">
      <img :src="item.thumbnail" class="mx-auto mb-5" />
      <h2 class="font-bold overflow-hidden whitespace-no-wrap">{{item.title}}</h2>
      <h2 class="text-green-600 font-bold">${{item.price}}</h2>
      <h3 class="text-gray-700">{{item.address.city_name}} - {{ item.address.state_name }}</h3>
    </a>
  </div>
</template>

<script>
export default {
  props: ["item", "customClass"],
  methods: {
    // This is supposed to be the whole objective of this project, to sort using this "advanced filter", this should be customizable in the user preferences and could be saved to be used on each query
    cityInBlacklist(city) {
      return [
        "San Isidro",
        "Vicente Lopez",
        "Vicente López",
        "Olivos"
      ].includes(city);
    }
  }
};
</script>

<style>
</style>