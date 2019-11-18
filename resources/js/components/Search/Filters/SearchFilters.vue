<template>
  <div class="search-filters-wrapper w-full lg:w-3/12">
    <search-filters-mobile :filters="filters" :current-url="currentUrl"></search-filters-mobile>
    <search-filters-desktop :filters="filters" :current-url="currentUrl"></search-filters-desktop>
  </div>
</template>

<script>
export default {
  props: {
    filters: {
      type: Array,
      required: true
    },
    currentUrl: {
      type: String,
      required: true
    }
  }
};
</script>