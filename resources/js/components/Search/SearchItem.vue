<template>
  <div class="shadow p-4 w-44-percent lg:w-30-percent inline-block" :class="this.customClass">
    <a :href="item.link">
      <img :src="item.img" class="mx-auto mb-5" />
      <h2 class="font-bold overflow-hidden whitespace-no-wrap">{{item.title}}</h2>
      <h2 class="text-green-600 font-bold">${{item.price}}</h2>
      <h3 class="text-gray-700">{{item.city}} - {{ item.state }}</h3>
    </a>
  </div>
</template>

<script>
export default {
  props: ["item", "customClass"]
};
</script>

<style>
</style>